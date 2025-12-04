@extends('layouts.app')

@section('template_title')
    {{ $carPlate->name ?? __('Show') . " " . __('Car Plate') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"
                         style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left d-flex align-items-center">
                            @php
                                $plateClass = '';
                                switch($carPlate->type) {
                                    case 'POLIZIA':
                                        $plateClass = 'plate-police';
                                        $typeIcon = 'fas fa-shield-alt text-primary';
                                        break;
                                    case 'CIVILE':
                                        $plateClass = 'plate-civil';
                                        $typeIcon = 'fas fa-user text-success';
                                        break;
                                    default:
                                        $plateClass = 'plate-other';
                                        $typeIcon = 'fas fa-question text-secondary';
                                }
                            @endphp

                                    <!-- Targa grande -->
                            <div class="me-3">
                                <div class="plate {{ $plateClass }}" style="font-size: 24px; padding: 12px 20px;">
                                    {{ $carPlate->name }}
                                </div>
                            </div>
                            <div>
                                <span class="card-title">Dettagli Targa: {{ $carPlate->name }}</span>
                                <br><small class="text-muted"><i class="{{ $typeIcon }}"></i> {{ $carPlate->type }}
                                </small>
                            </div>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm"
                               href="{{ route('car-plates.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>


                     <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-detail-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-detail" type="button" role="tab" aria-controls="nav-detail"
                                    aria-selected="true">Dettaglio
                            </button>
                            <button class="nav-link" id="nav-history-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-history" type="button" role="tab"
                                    aria-controls="nav-history" aria-selected="false">Storico
                            </button>
                        </div>
                    </nav>



                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane h-100 fade show active" id="nav-detail" role="tabpanel"
                            aria-labelledby="nav-detail-tab">
                            <div class="card-body bg-white" >
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="form-group mb-3">
                                    <strong>Numero Targa:</strong>
                                    <h4 class="text-primary" style="font-family: monospace;">{{ $carPlate->name }}</h4>
                                </div>

                                <div class="form-group mb-3">
                                    <strong>Tipo Targa:</strong>
                                    @switch($carPlate->type)
                                        @case('POLIZIA')
                                            <span class="badge badge-primary badge-lg">
                                                <i class="fas fa-shield-alt"></i> POLIZIA - Forze dell'Ordine
                                            </span>
                                            <p class="mt-2 text-muted">Targa riservata a veicoli delle Forze
                                                dell'Ordine, Polizia di Stato, Carabinieri, Guardia di Finanza e altre
                                                forze di polizia.</p>
                                            @break
                                        @case('CIVILE')
                                            <span class="badge badge-success badge-lg">
                                                <i class="fas fa-user"></i> CIVILE - Standard
                                            </span>
                                            <p class="mt-2 text-muted">Targa civile standard per veicoli privati e
                                                commerciali secondo il formato italiano vigente.</p>
                                            @break
                                        @default
                                            <span class="badge badge-secondary badge-lg">
                                                <i class="fas fa-question"></i> ALTRO - Tipo speciale
                                            </span>
                                            <p class="mt-2 text-muted">Targa di tipo speciale, diplomatica, temporanea o
                                                con formato non standard.</p>
                                    @endswitch
                                </div>

                                @if(count($carPlate->cars) > 0)
                                    <div class="form-group mb-3">
                                        <strong>Veicolo Assegnato:</strong>
                                        <div class="card mt-2">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <a href="{{ route('cars.show', $carPlate->cars[0]?->id) }}"
                                                       class="text-decoration-none">
                                                        {{ $carPlate->cars[0]?->full_name }}
                                                    </a>
                                                </h5>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <p class="card-text">
                                                            <strong>Vettura:</strong> {{ $carPlate->cars[0]?->full_name ?? 'N/A' }}
                                                            <br>
                                                            @if($carPlate->cars[0]->carOwner)
                                                                <strong>Proprietario:</strong> {{ $carPlate->cars[0]?->carOwner->name }}
                                                            @endif
                                                            @if($carPlate->cars[0]?->carOffices)
                                                                <br>
                                                                <strong>Assegnato
                                                                    a:</strong> {{ $carPlate->cars[0]?->carOffices()->first()->full_name }}
                                                            @endif
                                                        </p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p class="card-text">
                                                            <strong>Alimentazione:</strong> {{ $carPlate->cars[0]?->carPower?->name ?? 'N/A' }}
                                                            <br>
                                                            <strong>Colore:</strong> {{ $carPlate->cars[0]?->color ?? 'N/A' }}
                                                            @if(count($carPlate->cars[0]?->carPlates) > 1 )
                                                                <br>
                                                                <strong>Altre Targhe:</strong>
                                                                @foreach($carPlate->cars[0]?->carPlates as $pl)
                                                                    @if($pl->id !== $carPlate->id)
                                                                        [{{ $pl->type ?? '' }} -
                                                                        {{ $pl->name ?? '' }}]
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="form-group mb-3">
                                    <strong>Periodo di Validità:</strong>
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <div class="card" style="height: -webkit-fill-available;">
                                                <div class="card-body text-center h-100">
                                                    <i class="fas fa-play-circle text-success fa-2x"></i>
                                                    <h6 class="mt-2">Data Inizio</h6>
                                                    <p class="h5">{{ $carPlate->cars->first()?->pivot->date_from?->format('d/m/Y') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card" style="height: -webkit-fill-available;">
                                                <div class="card-body text-center">
                                                    @if($carPlate->cars->first()?->pivot->date_to)
                                                        <i class="fas fa-stop-circle text-danger fa-2x"></i>
                                                        <h6 class="mt-2">Data Fine</h6>
                                                        <p class="h5">{{ $carPlate->cars->first()?->pivot->date_to?->format('d/m/Y') }}</p>
                                                        <small class="text-muted">{{ \Carbon\Carbon::parse($carPlate->cars[0]?->pivot->date_to)->diffForHumans() }}</small>
                                                    @else
                                                        <i class="fas fa-infinity text-primary fa-2x"></i>
                                                        <h6 class="mt-2">Data Fine</h6>
                                                        <p class="h5 text-primary">In corso</p>
                                                        <small class="text-muted">Targa attualmente attiva</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if($carPlate->note)
                                    <div class="form-group mb-3">
                                        <strong>Note:</strong>
                                        <div class="border p-3 bg-light rounded mt-2">
                                            {!! nl2br(e($carPlate->note)) !!}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                        </div>
                        <div class="tab-pane h-100 fade" id="nav-history" role="tabpanel"
                            aria-labelledby="nav-history-tab">
                            <table class="table table-striped table-bordered">
                                <head>
                                    <tr>
                                        <th>Vettura</th>
                                        <th>Proprietario</th>
                                        <th>Assegnatario</th>
                                        <th>Periodo</th>
                                    </tr>
                                </head>
                                <tbody>
                                    @foreach ($hisotryPlate->cars as $car)
                                        <tr>
                                            <td>
                                                <a href="{{ route('cars.show', $car->id) }}">
                                                    {{ $car->full_name }}
                                                </a>
                                            </td>
                                            <td>{{ $car->carOwner?->name }}</td>
                                            <td class="text-muted">
                                                <small>{{ $car->carOffices?->first()?->full_name }}</small> <br>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <small>Dal: {{ $car?->pivot->date_from?->format('d/m/Y') }}</small>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <small>Al: {{ $car?->pivot->date_to?->format('d/m/Y') }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
        </div>
    </section>

    <style>
        .plate {
            display: inline-block;
            padding: 8px 16px;
            font-family: 'Courier New', monospace;
            font-weight: bold;
            border: 3px solid;
            border-radius: 6px;
            text-align: center;
            letter-spacing: 2px;
        }

        .plate-civil {
            background-color: #ffffff;
            color: #000000;
            border-color: #000000;
        }

        .plate-police {
            background-color: #1e3a8a;
            color: #ffffff;
            border-color: #ffffff;
        }

        .plate-other {
            background-color: #f3f4f6;
            color: #374151;
            border-color: #6b7280;
        }
    </style>
@endsection