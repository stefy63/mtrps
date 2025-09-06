@extends('layouts.app')

@section('template_title')
    {{ $maintenance->name ?? __('Dettagli Manutenzione') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="card-title">
                                <i class="bi bi-wrench"></i> {{ __('Dettagli Manutenzione') }}
                            </span>
                            <div>
                                <a class="btn btn-sm btn-warning" href="{{ route('maintenances.edit', $maintenance->id) }}">
                                    <i class="bi bi-pencil"></i> {{ __('Modifica') }}
                                </a>
                                <a class="btn btn-sm btn-primary" href="{{ route('maintenances.index') }}">
                                    <i class="bi bi-arrow-left"></i> {{ __('Torna alla Lista') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <!-- Informazioni Principali -->
                                <div class="card mb-3">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informazioni Manutenzione</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <strong>Stato:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                @php
                                                    $isActive = !$maintenance->date_to || $maintenance->date_to >= now();
                                                @endphp
                                                @if($isActive)
                                                    <span class="badge bg-warning text-dark">
                                                        <i class="bi bi-clock"></i> In corso
                                                    </span>
                                                @else
                                                    <span class="badge bg-success">
                                                        <i class="bi bi-check-circle"></i> Completata
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <strong>Tipo Manutenzione:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                <h5 class="mb-0">{{ $maintenance->name }}</h5>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <strong>Veicolo:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                <i class="bi bi-car-front"></i> {{ $maintenance->car->name }}
                                                @if($maintenance->car->carBrand)
                                                    <br><small class="text-muted">{{ $maintenance->car->carBrand->name }}</small>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <strong>Targa:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                @if($maintenance->car->carPlates->count() > 0)
                                                    <span class="badge bg-primary">{{ $maintenance->car->carPlates->first()->name }}</span>
                                                @else
                                                    <span class="text-muted">Nessuna targa attiva</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <strong>Periodo:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                <i class="bi bi-calendar"></i> {{ $maintenance->date_from->format('d/m/Y') }}
                                                @if($maintenance->date_to)
                                                    - {{ $maintenance->date_to->format('d/m/Y') }}
                                                    @php
                                                        $duration = $maintenance->date_from->diffInDays($maintenance->date_to) + 1;
                                                    @endphp
                                                    <br><small class="text-muted">Durata: {{ $duration }} {{ $duration == 1 ? 'giorno' : 'giorni' }}</small>
                                                @else
                                                    <br><small class="text-muted">Ancora in corso</small>
                                                @endif
                                            </div>
                                        </div>

                                        @if($maintenance->description)
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <strong>Descrizione:</strong>
                                                </div>
                                                <div class="col-md-8">
                                                    {{ $maintenance->description }}
                                                </div>
                                            </div>
                                        @endif

                                        @if($maintenance->note)
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <strong>Note:</strong>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="alert alert-light">
                                                        {{ $maintenance->note }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <hr>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <small class="text-muted">
                                                    <i class="bi bi-clock"></i> Creato il: {{ $maintenance->created_at->format('d/m/Y H:i') }}
                                                </small>
                                            </div>
                                            <div class="col-md-6 text-end">
                                                <small class="text-muted">
                                                    <i class="bi bi-clock-history"></i> Aggiornato il: {{ $maintenance->updated_at->format('d/m/Y H:i') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Officine Collegate -->
                                @if($maintenance->maintenanceGarages->count() > 0)
                                    <div class="card mb-3">
                                        <div class="card-header bg-secondary text-white">
                                            <h5 class="mb-0"><i class="bi bi-building"></i> Officine</h5>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-group">
                                                @foreach($maintenance->maintenanceGarages as $garage)
                                                    <li class="list-group-item">
                                                        <strong>{{ $garage->name }}</strong>
                                                        @if($garage->piva)
                                                            <br><small>P.IVA: {{ $garage->piva }}</small>
                                                        @endif
                                                        @if($garage->description)
                                                            <br><small class="text-muted">{{ $garage->description }}</small>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif

                                <!-- Tipi di Intervento -->
                                @if($maintenance->maintenanceTypes->count() > 0)
                                    <div class="card">
                                        <div class="card-header bg-info text-white">
                                            <h5 class="mb-0"><i class="bi bi-tools"></i> Tipi di Intervento</h5>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-group">
                                                @foreach($maintenance->maintenanceTypes as $type)
                                                    <li class="list-group-item">
                                                        <strong>{{ $type->name }}</strong>
                                                        @if($type->description)
                                                            <br><small class="text-muted">{{ $type->description }}</small>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="col-md-4">
                                <!-- Azioni Rapide -->
                                <div class="card mb-3">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="mb-0"><i class="bi bi-lightning"></i> Azioni Rapide</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-grid gap-2">
                                            <a href="{{ route('maintenance-garages.create', ['maintenance_id' => $maintenance->id]) }}" class="btn btn-outline-primary">
                                                <i class="bi bi-building-add"></i> Aggiungi Officina
                                            </a>
                                            <a href="{{ route('maintenance-types.create', ['maintenance_id' => $maintenance->id]) }}" class="btn btn-outline-info">
                                                <i class="bi bi-tools"></i> Aggiungi Tipo Intervento
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Informazioni Veicolo -->
                                <div class="card mb-3">
                                    <div class="card-header bg-secondary text-white">
                                        <h5 class="mb-0"><i class="bi bi-car-front"></i> Info Veicolo</h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="mb-2"><strong>Nome:</strong> {{ $maintenance->car->name }}</p>
                                        @if($maintenance->car->model)
                                            <p class="mb-2"><strong>Modello:</strong> {{ $maintenance->car->model }}</p>
                                        @endif
                                        @if($maintenance->car->km)
                                            <p class="mb-2"><strong>Km attuali:</strong> {{ number_format($maintenance->car->km, 0, ',', '.') }}</p>
                                        @endif
                                    </div>
                                </div>

                                <!-- Manutenzioni Precedenti -->
                                @if($previousMaintenances->count() > 0)
                                    <div class="card">
                                        <div class="card-header bg-info text-white">
                                            <h5 class="mb-0"><i class="bi bi-clock-history"></i> Manutenzioni Precedenti</h5>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-unstyled mb-0">
                                                @foreach($previousMaintenances as $prev)
                                                    <li class="mb-2">
                                                        <small>
                                                            <strong>{{ $prev->date_from->format('d/m/Y') }}</strong>
                                                            @if($prev->date_to)
                                                                - {{ $prev->date_to->format('d/m/Y') }}
                                                            @endif
                                                            <br>{{ $prev->name }}
                                                        </small>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <a href="{{ route('maintenances.index', ['car_id' => $maintenance->car_id]) }}" class="btn btn-sm btn-info mt-2">
                                                <i class="bi bi-list"></i> Vedi tutte
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
