@extends('layouts.app')

@section('title', 'Importa Kilometri')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Importazione Kilometri vetture</h4>
                        <p class="text-muted">
                            Qui puoi scaricare il template CSV predefinito e caricare un file CSV per l'importazione.
                            Assicurati che il file rispetti la struttura richiesta.
                        </p>

                        <!-- Bottone per scaricare il template -->
                        <a href="{{ route('export.template-km', ['template' => 'cars']) }}"
                           class="btn btn-success mb-4">
                            <i class="bi bi-download"></i> Scarica Template CSV
                        </a>

                        <!-- Form per caricare il CSV -->
                        <form id="postForm" action="{{ route('imports.km') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="km_csv_file" class="form-label">Seleziona file CSV</label>
                                <input type="file" name="km_csv_file" id="km_csv_file" class="form-control"
                                       accept=".csv" required>
                                @error('km_csv_file')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-submit">
                                <i class="bi bi-upload"></i> Carica File
                            </button>
                        </form>
                    </div>
                    @if($err = Session::get('csv_errors'))
                        <div>
                            <ul>
                                @foreach($err as $e)
                                    <li><b>Targa:</b> {{$e['Targa']}} - <b>Km: </b> {{$e['Km']}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $('form').on( "submit", function (e) {
            $('.bi-upload').hide();
            $(".btn-submit").prepend('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
            $(".btn-submit").attr("disabled", 'disabled');
        })
    </script>
@endpush
