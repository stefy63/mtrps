<?php

namespace App\Http\Controllers;

use App\Http\Traits\Utils;
use App\Services\ImportCarsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ImportCarsController extends Controller
{
    use Utils;

    public function index()
    {
        return view('import.import-cars');
    }

    public function export()
    {
        $template = 'cars';
        $filePath = "templates/{$template}_template.csv";
        if (!Storage::exists($filePath)) {
            abort(404, 'Template non trovato.');
        }
        $fileName = "{$template}_template.csv";
        $headers = ['Content-Type' => 'text/csv'];
        return Storage::download($filePath, $fileName, $headers);
    }

    public function importCars(
        ImportCarsService $importCarsService,
        Request $request
    ) {
        try {
            $request->validate([
                'cars_csv_file' => 'required|extensions:csv',
            ]);
            $fullPath = storage_path('app/private/'.$request->file('cars_csv_file')->store('csv_uploads'));
            $stream = fopen($fullPath, 'r');
            if (!$stream) {
                return back()->withErrors(['cars_csv_file' => 'Impossibile aprire il file CSV.']);
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
                $importCarsService->insert($row);
                $inserted++;
            }
            fclose($stream);
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }

            // Preparazione del messaggio di ritorno
            $msg = "Import completato. Inserite righe: {$inserted}.";
            if (!empty($errors)) {
                $msg .= " Ci sono errori in alcune righe.";
            }
            DB::commit();
            return redirect('cars')
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
