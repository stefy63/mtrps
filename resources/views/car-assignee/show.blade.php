@extends('layouts.app')

@section('template_title')
    {{ $carAssignee->name ?? __('Show') . " " . __('Car Assignee') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left d-flex align-items-center">
                            @php
                                $assigneeName = strtolower($carAssignee->name);
                                if (str_contains($assigneeName, 'direttore') || str_contains($assigneeName, 'dirigente') || str_contains($assigneeName, 'capo')) {
                                    $icon = 'fas fa-user-tie text-primary';
                                    $bgColor = 'bg-primary';
                                    $badge = 'Dirigente';
                                    $badgeClass = 'primary';
                                } elseif (str_contains($assigneeName, 'commissario') || str_contains($assigneeName, 'ispettore') || str_contains($assigneeName, 'sovrintendente') || str_contains($assigneeName, 'capitano')) {
                                    $icon = 'fas fa-shield-alt text-danger';
                                    $bgColor = 'bg-danger';
                                    $badge = 'Forze dell\'Ordine';
                                    $badgeClass = 'danger';
                                } elseif (str_contains($assigneeName, 'ufficio') || str_contains($assigneeName, 'servizio') || str_contains($assigneeName, 'reparto')) {
                                    $icon = 'fas fa-building text-info';
                                    $bgColor = 'bg-info';
                                    $badge = 'Ufficio/Servizio';
                                    $badgeClass = 'info';
                                } else {
                                    $icon = 'fas fa-user text-secondary';
                                    $bgColor = 'bg-secondary';
                                    $badge = 'Assegnatario';
                                    $badgeClass = 'secondary';
                                }
                                
                                // Stato assegnazione
                                $now = now();
                                $dateFrom = \Carbon\Carbon::parse($carAssignee->date_from);
                                $dateTo = $carAssignee->date_to ? \Carbon\Carbon::parse($carAssignee->date_to) : null;
                                
                                if ($now < $dateFrom) {
                                    $status = 'future';
                                    $statusText = 'Futura';
                                    $statusClass = 'warning';
                                    $statusIcon = 'clock';
                                } elseif ($dateTo && $now > $dateTo) {
                                    $status = 'expired';
                                    $statusText = 'Scaduta';
                                    $statusClass = 'danger';
                                    $statusIcon = 'times-circle';
                                } else {
                                    $status = 'active';
                                    $statusText = 'Attiva';
                                    $statusClass = 'success';
                                    $statusIcon = 'check-circle';
                                }
                            @endphp
                            
                            <!-- Icona assegnatario -->
                            <div class="assignee-icon d-flex align-items-center justify-content-center {{ $bgColor }} bg-opacity-10 rounded-circle me-3" style="width: 70px; height: 70px;">
                                <i class="{{ $icon }} fa-2x"></i>
                            </div>
                            <div>
                                <span class="card-title">Assegnazione: {{ $carAssignee->name }}</span>
                                <br>
                                <span class="badge badge-{{ $badgeClass }}">{{ $badge }}</span>
                                <span class="badge badge-{{ $statusClass }} ms-1">
                                    <i class="fas fa-{{ $statusIcon }}"></i> {{ $statusText }}
                                </span>
                            </div>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('car-assignees.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <div class="row">
                            <div class="col-md-8">
                                
                                <div class="form-group mb-3">
                                    <strong>Nome Assegnatario:</strong>
                                    <h4 class="text-primary">{{ $carAssignee->name }}</h4>
                                </div>
                                
                                @if($carAssignee->description)
                                <div class="form-group mb-3">
                                    <strong>Ruolo/Descrizione:</strong>
                                    <p class="lead">{{ $carAssignee->description }}</p>
                                </div>
                                @endif
                                
                                <!-- Informazioni Veicolo -->
                                @if($carAssignee->car)
                                <div class="form-group mb-3">
                                    <strong>Veicolo Assegnato:</strong>
                                    <div class="card mt-2">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h5 class="card-title">
                                                        <a href="{{ route('cars.show', $carAssignee->car->id) }}" class="text-decoration-none">
                                                            {{ $carAssignee->car->name }}
                                                        </a>
                                                    </h5>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p class="card-text">
                                                                <strong>Marca:</strong> {{ $carAssignee->car->carBrand?->name ?? 'N/A' }}<br>
                                                                <strong>Modello:</strong> {{ $carAssignee->car->model ?? 'N/A' }}<br>
                                                                <strong>Tipo:</strong> {{ $carAssignee->car->carType?->name ?? 'N/A' }}
                                                            </p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p class="card-text">
                                                                <strong>Alimentazione:</strong> {{ $carAssignee->car->carPower?->name ?? 'N/A' }}<br>
                                                                <strong>Colore:</strong> {{ $carAssignee->car->color ?? 'N/A' }}<br>
                                                                <strong>Km:</strong> {{ $carAssignee->car->km ? number_format($carAssignee->car->km) . ' km' : 'N/A' }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    @if($carAssignee->car->carOwner)
                                                    <p class="card-text">
                                                        <strong>Proprietario:</strong> {{ $carAssignee->car->carOwner->name }}
                                                    </p>
                                                    @endif
                                                </div>
                                                <div class="col-md-4 text-center">
                                                    @if($carAssignee->car->carPlates->count() > 0)
                                                    <div class="plate-display mb-2">
                                                        <span class="plate plate-civil">
                                                            {{ $carAssignee->car->carPlates->first()->name }}
                                                        </span>
                                                    </div>
                                                    @endif
                                                    <a href="{{ route('cars.show', $carAssignee->car->id) }}" class="btn btn-outline-primary btn-sm">
                                                        <i class="fas fa-car"></i> Vedi Veicolo
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                
                                <!-- Periodo Assegnazione -->
                                <div class="form-group mb-3">
                                    <strong>Periodo di Assegnazione:</strong>
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <i class="fas fa-play-circle text-success fa-2x"></i>
                                                    <h6 class="mt-2">Data Inizio</h6>
                                                    <p class="h5">{{ $dateFrom->format('d/m/Y') }}</p>
                                                    <small class="text-muted">{{ $dateFrom->diffForHumans() }}</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    @if($carAssignee->date_to)
                                                        <i class="fas fa-stop-circle text-danger fa-2x"></i>
                                                        <h6 class="mt-2">Data Fine</h6>
                                                        <p class="h5">{{ $dateTo->format('d/m/Y') }}</p>
                                                        <small class="text-muted">{{ $dateTo->diffForHumans() }}</small>
                                                    @else
                                                        <i class="fas fa-infinity text-primary fa-2x"></i>
                                                        <h6 class="mt-2">Data Fine</h6>
                                                        <p class="h5 text-primary">In corso</p>
                                                        <small class="text-muted">Assegnazione a tempo indeterminato</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Uffici Assegnatari -->
                                @if($carAssignee->assigneeOffices && $carAssignee->assigneeOffices->count() > 0)
                                <div class="form-group mb-3">
                                    <strong>Uffici Assegnatari:</strong>
                                    <div class="row mt-2">
                                        @foreach($carAssignee->assigneeOffices as $office)
                                        <div class="col-md-6 mb-2">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h6 class="card-title">
                                                        <i class="fas fa-building text-info"></i> {{ $office->name }}
                                                    </h6>
                                                    @if($office->description)
                                                    <p class="card-text">{{ $office->description }}</p>
                                                    @endif
                                                    @if($office->note)
                                                    <small class="text-muted">{{ $office->note }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                                
                                @if($carAssignee->note)
                                <div class="form-group mb-3">
                                    <strong>Note:</strong>
                                    <div class="border p-3 bg-light rounded">
                                        {!! nl2br(e($carAssignee->note)) !!}
                                    </div>
                                </div>
                                @endif
                            </div>
                            
                            <div class="col-md-4">
                                <!-- Stato Assegnazione -->
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Stato Assegnazione</h6>
                                    </div>
                                    <div class="card-body text-center">
                                        <i class="fas fa-{{ $statusIcon }} text-{{ $statusClass }} fa-3x"></i>
                                        <h4 class="mt-2 text-{{ $statusClass }}">{{ $statusText }}</h4>
                                        @if($status == 'active')
                                        <p class="text-muted">L'assegnazione è attualmente valida e attiva</p>
                                        @elseif($status == 'future')
                                        <p class="text-muted">L'assegnazione entrerà in vigore il {{ $dateFrom->format('d/m/Y') }}</p>
                                        @else
                                        <p class="text-muted">L'assegnazione è scaduta il {{ $dateTo->format('d/m/Y') }}</p>
                                        @endif
                                    </div>
                                </div>
                                
                                <!-- Statistiche Assegnazione -->
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h6 class="mb-0">Statistiche</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group mb-2">
                                            <strong>ID Assegnazione:</strong>
                                            <span class="badge badge-secondary">#{{ $carAssignee->id }}</span>
                                        </div>
                                        
                                        @php
                                            if ($dateTo) {
                                                $duration = $dateFrom->diffInDays($dateTo);
                                                $durationText = $duration . ' giorni totali';
                                            } else {
                                                $duration = $dateFrom->diffInDays($now);
                                                $durationText = $duration . ' giorni (in corso)';
                                            }
                                        @endphp
                                        
                                        <div class="form-group mb-2">
                                            <strong>Durata:</strong>
                                            <br><span class="text-info">{{ $durationText }}</span>
                                        </div>
                                        
                                        <div class="form-group mb-2">
                                            <strong>Uffici collegati:</strong>
                                            <br><span class="text-info">{{ $carAssignee->assigneeOffices->count() }}</span>
                                        </div>
                                        
                                        <div class="form-group mb-2">
                                            <strong>Creato:</strong>
                                            <br><small>{{ $carAssignee->created_at->format('d/m/Y H:i') }}</small>
                                        </div>
                                        
                                        <div class="form-group mb-2">
                                            <strong>Aggiornato:</strong>
                                            <br><small>{{ $carAssignee->updated_at->format('d/m/Y H:i') }}</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-3">
                                    <a href="{{ route('car-assignees.edit', $carAssignee->id) }}" class="btn btn-success btn-sm">
                                        <i class="fa fa-edit"></i> Modifica
                                    </a>
                                    
                                    @if($carAssignee->car)
                                    <a href="{{ route('cars.show', $carAssignee->car->id) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-car"></i> Vedi Veicolo
                                    </a>
                                    @endif
                                    
                                    <form action="{{ route('car-assignees.destroy', $carAssignee->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Sei sicuro di voler eliminare questa assegnazione?')">
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
        padding: 6px 12px;
        font-family: 'Courier New', monospace;
        font-weight: bold;
        font-size: 14px;
        border: 2px solid;
        border-radius: 4px;
        text-align: center;
        letter-spacing: 1px;
    }
    
    .plate-civil {
        background-color: #ffffff;
        color: #000000;
        border-color: #000000;
    }
    </style>
@endsection