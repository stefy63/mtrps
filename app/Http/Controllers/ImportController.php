<?php

namespace App\Http\Controllers;

use App\Http\Traits\Utils;
use App\Services\ImportCarsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImportController extends Controller
{
    use Utils;

    public function index(Request $request)
    {
        switch ($request->type) {
            case 'cars':
                return view('import.import-cars');
            default:
                return response()->json(['message' => 'Type not found'], 404);
        }
    }

    public function export(string $template)
    {
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
    )
    {
        $request->validate([
            'cars_csv_file' => 'required|extensions:csv',
        ]);
        $path = $request->file('cars_csv_file')->store('csv_uploads');
        $fullPath = storage_path('app/private/'.$path);
        $stream = fopen($fullPath, 'r');
        if (!$stream) {
            return back()->withErrors(['cars_csv_file' => 'Impossibile aprire il file CSV.']);
        }
        $rowNumber = 0;
        $errors = [];
        $inserted = 0;
        $expectedHeaders = [];
        while (($row = fgetcsv($stream, 0, ';')) !== false) {
            if ($rowNumber === 0) {
                $expectedHeaders = array_map(fn($val) => $this->cleanValue($val, true), $row);
                $rowNumber++;
                continue;
            }
            $rowNumber++;
            $row = array_combine($expectedHeaders, array_map(fn($val) => $this->cleanValue($val), $row));
//            dd($row);
            // logica di importazione
            $importCarsService->insert($row);
            $inserted++;
        }
        fclose($stream);
        Storage::delete($path);

        // Preparazione del messaggio di ritorno
        $msg = "Import completato. Inserite righe: {$inserted}.";
        if (!empty($errors)) {
            $msg .= " Ci sono errori in alcune righe.";
        }

        return back()
            ->with('success', $msg)
            ->with('csv_errors', $errors);
    }


}
