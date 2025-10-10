@extends('layouts.app')

@section('title', 'Importa CSV')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Importazione file CSV</h4>
                        <p class="text-muted">
                            Qui puoi scaricare il template CSV predefinito e caricare un file CSV per l'importazione.
                            Assicurati che il file rispetti la struttura richiesta.
                        </p>

                        <!-- Bottone per scaricare il template -->
                        <a href="{{ route('export.template', ['template' => 'cars']) }}" class="btn btn-success mb-4">
                            <i class="bi bi-download"></i> Scarica Template CSV
                        </a>

                        <!-- Form per caricare il CSV -->
                        <form action="{{ route('imports.cars') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="cars_csv_file" class="form-label">Seleziona file CSV</label>
                                <input type="file" name="cars_csv_file" id="cars_csv_file" class="form-control"
                                       accept=".csv" required>
                                @error('cars_csv_file')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-upload"></i> Carica File
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
