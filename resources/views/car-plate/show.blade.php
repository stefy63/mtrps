@extends('layouts.app')

@section('template_title')
    {{ $carPlate->name ?? __('Show') . " " . __('Car Plate') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left d-flex align-items-center">
                            @php
                                $plateClass = '';
                                switch($carPlate->type) {
                                    case 'POL':
                                        $plateClass = 'plate-police';
                                        $typeIcon = 'fas fa-shield-alt text-primary';
                                        break;
                                    case 'CIV':
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
                                <br><small class="text-muted"><i class="{{ $typeIcon }}"></i> {{ $carPlate->type }}</small>
                            </div>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('car-plates.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <div class="row">
                            <div class="col-md-8">
                                
                                <div class="form-group mb-3">
                                    <strong>Numero Targa:</strong>
                                    <h4 class="text-primary" style="font-family: monospace;">{{ $carPlate->name }}</h4>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <strong>Tipo Targa:</strong>
                                    @switch($carPlate->type)
                                        @case('POL')
                                            <span class="badge badge-primary badge-lg">
                                                <i class="fas fa-shield-alt"></i> POLIZIA - Forze dell'Ordine
                                            </span>
                                            <p class="mt-2 text-muted">Targa riservata a veicoli delle Forze dell'Ordine, Polizia di Stato, Carabinieri, Guardia di Finanza e altre forze di polizia.</p>
                                            @break
                                        @case('CIV')
                                            <span class="badge badge-success badge-lg">
                                                <i class="fas fa-user"></i> CIVILE - Standard
                                            </span>
                                            <p class="mt-2 text-muted">Targa civile standard per veicoli privati e commerciali secondo il formato italiano vigente.</p>
                                            @break
                                        @default
                                            <span class="badge badge-secondary badge-lg">
                                                <i class="fas fa-question"></i> ALTRO - Tipo speciale
                                            </span>
                                            <p class="mt-2 text-muted">Targa di tipo speciale, diplomatica, temporanea o con formato non standard.</p>
                                    @endswitch
                                </div>
                                
                                @if($carPlate->car)
                                <div class="form-group mb-3">
                                    <strong>Veicolo Assegnato:</strong>
                                    <div class="card mt-2">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <a href="{{ route('cars.show', $carPlate->car->id) }}" class="text-decoration-none">
                                                    {{ $carPlate->car->name }}
                                                </a>
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="card-text">
                                                        <strong>Marca:</strong> {{ $carPlate->car->carBrand?->name ?? 'N/A' }}<br>
                                                        <strong>Modello:</strong> {{ $carPlate->car->model ?? 'N/A' }}<br>
                                                        <strong>Tipo:</strong> {{ $carPlate->car->carType?->name ?? 'N/A' }}
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="card-text">
                                                        <strong>Alimentazione:</strong> {{ $carPlate->car->carPower?->name ?? 'N/A' }}<br>
                                                        <strong>Colore:</strong> {{ $carPlate->car->color ?? 'N/A' }}<br>
                                                        <strong>Km:</strong> {{ $carPlate->car->km ? number_format($carPlate->car->km) . ' km' : 'N/A' }}
                                                    </p>
                                                </div>
                                            </div>
                                            @if($carPlate->car->carOwner)
                                            <p class="card-text">
                                                <strong>Proprietario:</strong> {{ $carPlate->car->carOwner->name }}
                                            </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endif
                                
                                <div class="form-group mb-3">
                                    <strong>Periodo di Validità:</strong>
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <i class="fas fa-play-circle text-success fa-2x"></i>
                                                    <h6 class="mt-2">Data Inizio</h6>
                                                    <p class="h5">{{ \Carbon\Carbon::parse($carPlate->date_from)->format('d/m/Y') }}</p>
                                                    <small class="text-muted">{{ \Carbon\Carbon::parse($carPlate->date_from)->diffForHumans() }}</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    @if($carPlate->date_to)
                                                        <i class="fas fa-stop-circle text-danger fa-2x"></i>
                                                        <h6 class="mt-2">Data Fine</h6>
                                                        <p class="h5">{{ \Carbon\Carbon::parse($carPlate->date_to)->format('d/m/Y') }}</p>
                                                        <small class="text-muted">{{ \Carbon\Carbon::parse($carPlate->date_to)->diffForHumans() }}</small>
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
                            
                            <div class="col-md-4">
                                <!-- Stato targa -->
                                @php
                                    $now = now();
                                    $dateFrom = \Carbon\Carbon::parse($carPlate->date_from);
                                    $dateTo = $carPlate->date_to ? \Carbon\Carbon::parse($carPlate->date_to) : null;
                                    
                                    if ($now < $dateFrom) {
                                        $status = 'future';
                                        $statusText = 'Futura';
                                        $statusClass = 'warning';
                                        $statusIcon = 'clock';
                                        $statusDescription = 'La targa entrerà in vigore il ' . $dateFrom->format('d/m/Y');
                                    } elseif ($dateTo && $now > $dateTo) {
                                        $status = 'expired';
                                        $statusText = 'Scaduta';
                                        $statusClass = 'danger';
                                        $statusIcon = 'times-circle';
                                        $statusDescription = 'La targa è scaduta il ' . $dateTo->format('d/m/Y');
                                    } else {
                                        $status = 'active';
                                        $statusText = 'Attiva';
                                        $statusClass = 'success';
                                        $statusIcon = 'check-circle';
                                        $statusDescription = 'La targa è attualmente valida e attiva';
                                    }
                                @endphp
                                
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Stato Targa</h6>
                                    </div>
                                    <div class="card-body text-center">
                                        <i class="fas fa-{{ $statusIcon }} text-{{ $statusClass }} fa-3x"></i>
                                        <h4 class="mt-2 text-{{ $statusClass }}">{{ $statusText }}</h4>
                                        <p class="text-muted">{{ $statusDescription }}</p>
                                    </div>
                                </div>
                                
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h6 class="mb-0">Informazioni Sistema</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group mb-2">
                                            <strong>ID:</strong>
                                            <span class="badge badge-secondary">#{{ $carPlate->id }}</span>
                                        </div>
                                        
                                        <div class="form-group mb-2">
                                            <strong>Creato:</strong>
                                            <br><small>{{ $carPlate->created_at->format('d/m/Y H:i') }}</small>
                                        </div>
                                        
                                        <div class="form-group mb-2">
                                            <strong>Aggiornato:</strong>
                                            <br><small>{{ $carPlate->updated_at->format('d/m/Y H:i') }}</small>
                                        </div>
                                        
                                        @if($carPlate->date_to)
                                        @php
                                            $duration = $dateFrom->diffInDays($dateTo);
                                        @endphp
                                        <div class="form-group mb-2">
                                            <strong>Durata:</strong>
                                            <br><span class="text-info">{{ $duration }} giorni</span>
                                        </div>
                                        @else
                                        @php
                                            $activeDays = $dateFrom->diffInDays($now);
                                        @endphp
                                        <div class="form-group mb-2">
                                            <strong>Attiva da:</strong>
                                            <br><span class="text-info">{{ $activeDays }} giorni</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="mt-3">
                                    <a href="{{ route('car-plates.edit', $carPlate->id) }}" class="btn btn-success btn-sm">
                                        <i class="fa fa-edit"></i> Modifica
                                    </a>
                                    
                                    @if($carPlate->car)
                                    <a href="{{ route('cars.show', $carPlate->car->id) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-car"></i> Vedi Veicolo
                                    </a>
                                    @endif
                                    
                                    <form action="{{ route('car-plates.destroy', $carPlate->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Sei sicuro di voler eliminare questa targa?')">
                                            <i class="fa fa-trash"></i> Elimina
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

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