<?php

namespace App\Http\Controllers;

use App\Http\Traits\Utils;
use App\Services\ImportCarsService;
use App\Services\ImportKmService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ImportKmController extends Controller
{
    use Utils;

    public function index()
    {
        return view('import.import-km')->with('csv_errors', null);
    }


    public function export()
    {
        $template = 'km';
        $filePath = "templates/{$template}_template.csv";
        if (!Storage::exists($filePath)) {
            abort(404, 'Template non trovato.');
        }
        $fileName = "{$template}_template.csv";
        $headers = ['Content-Type' => 'text/csv'];
        return Storage::download($filePath, $fileName, $headers);
    }


    public function importKm(
        ImportKmService $importKmService,
        Request $request
    ) {
        try {
            $request->validate([
                'km_csv_file' => 'required|extensions:csv',
            ]);
            $fullPath = storage_path('app/private/'.$request->file('km_csv_file')->store('csv_uploads'));
            $stream = fopen($fullPath, 'r');
            if (!$stream) {
                return back()->withErrors(['km_csv_file' => 'Impossibile aprire il file CSV.']);
            }
            $rowNumber = 0;
            $errors = [];
            $inserted = 0;
            $expectedHeaders = [];
            DB::beginTransaction();
            while (($row = fgetcsv($stream, 0, ';')) !== false) {
                if ($rowNumber === 0) {
                    $expectedHeaders = array_map(fn($val) => $this->cleanValue($val, true), $row);
                    $rowNumber++;
                    continue;
                }
                $rowNumber++;
                $row = array_combine($expectedHeaders, array_map(fn($val) => $this->cleanValue($val), $row));
                // logica di importazione
                if (!$importKmService->insert($row)) {
                    $errors[] = $row;
                }
                $inserted++;
            }
            fclose($stream);
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }

            // Preparazione del messaggio di ritorno
            $msg = "Import completato. Aggiornate {$inserted} vetture.";
            $redirect = redirect('cars');
            if (!empty($errors)) {
                $msg .= "Ci sono errori in alcune righe.";
                $redirect = Redirect::back();
            }
            DB::commit();
            return $redirect
                ->with('success', $msg)
                ->with('csv_errors', $errors);
        } catch (\Throwable $e) {
            DB::rollBack();
            return Redirect::back()
                ->withInput()
                ->with('toast_error', 'Errore nell\'importazione del file: '.$e->getMessage());

        }

    }


}
