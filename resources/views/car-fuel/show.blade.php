@extends('layouts.app')

@section('template_title')
    {{ $carFuel->name ?? __('Dettagli Rifornimento') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="card-title">
                                <i class="bi bi-fuel-pump"></i> {{ __('Dettagli Rifornimento') }}
                            </span>
                            <div>
                                <a class="btn btn-sm btn-warning" href="{{ route('car-fuels.edit', $carFuel->id) }}">
                                    <i class="bi bi-pencil"></i> {{ __('Modifica') }}
                                </a>
                                <a class="btn btn-sm btn-primary" href="{{ route('car-fuels.index') }}">
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
                                        <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informazioni Rifornimento</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <strong>Tipo Rifornimento:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                <h5 class="mb-0">{{ $carFuel->name }}</h5>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <strong>Data Rifornimento:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                <i class="bi bi-calendar"></i> {{ $carFuel->date_from->format('d/m/Y') }}
                                                @if($carFuel->date_to)
                                                    <br><small class="text-muted">fino al {{ $carFuel->date_to->format('d/m/Y') }}</small>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <strong>Veicolo:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                <i class="bi bi-car-front"></i> {{ $carFuel->car->name }}
                                                @if($carFuel->car->carBrand)
                                                    <br><small class="text-muted">{{ $carFuel->car->carBrand->name }}</small>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <strong>Targa:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                @if($carFuel->car->carPlates->count() > 0)
                                                    <span class="badge bg-primary">{{ $carFuel->car->carPlates->first()->name }}</span>
                                                @else
                                                    <span class="text-muted">Nessuna targa attiva</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <strong>Alimentazione:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                @if($carFuel->car->carPower)
                                                    @php
                                                        $powerType = strtolower($carFuel->car->carPower->name);
                                                        $badgeClass = 'secondary';
                                                        $icon = 'fuel-pump';

                                                        if (str_contains($powerType, 'benzina')) {
                                                            $badgeClass = 'success';
                                                            $icon = 'droplet';
                                                        } elseif (str_contains($powerType, 'diesel') || str_contains($powerType, 'gasolio')) {
                                                            $badgeClass = 'dark';
                                                            $icon = 'droplet-fill';
                                                        } elseif (str_contains($powerType, 'elettric')) {
                                                            $badgeClass = 'info';
                                                            $icon = 'lightning-charge';
                                                        } elseif (str_contains($powerType, 'ibrid')) {
                                                            $badgeClass = 'warning';
                                                            $icon = 'battery-charging';
                                                        } elseif (str_contains($powerType, 'gpl')) {
                                                            $badgeClass = 'primary';
                                                            $icon = 'fire';
                                                        } elseif (str_contains($powerType, 'metano')) {
                                                            $badgeClass = 'secondary';
                                                            $icon = 'wind';
                                                        }
                                                    @endphp
                                                    <span class="badge bg-{{ $badgeClass }}">
                                                        <i class="bi bi-{{ $icon }}"></i> {{ $carFuel->car->carPower->name }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">Non specificata</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <strong>Dettagli:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                {{ $carFuel->description ?? 'Nessun dettaglio' }}
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <strong>Registrato da:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                <i class="bi bi-person"></i> {{ $carFuel->user ? $carFuel->user->name : 'Utente non specificato' }}
                                            </div>
                                        </div>

                                        @if($carFuel->note)
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <strong>Note:</strong>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="alert alert-light">
                                                        {{ $carFuel->note }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <hr>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <small class="text-muted">
                                                    <i class="bi bi-clock"></i> Creato il: {{ $carFuel->created_at->format('d/m/Y H:i') }}
                                                </small>
                                            </div>
                                            <div class="col-md-6 text-end">
                                                <small class="text-muted">
                                                    <i class="bi bi-clock-history"></i> Aggiornato il: {{ $carFuel->updated_at->format('d/m/Y H:i') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- Informazioni Veicolo -->
                                <div class="card mb-3">
                                    <div class="card-header bg-secondary text-white">
                                        <h5 class="mb-0"><i class="bi bi-car-front"></i> Info Veicolo</h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="mb-2"><strong>Nome:</strong> {{ $carFuel->car->name }}</p>
                                        @if($carFuel->car->model)
                                            <p class="mb-2"><strong>Modello:</strong> {{ $carFuel->car->model }}</p>
                                        @endif
                                        @if($carFuel->car->km)
                                            <p class="mb-2"><strong>Km attuali:</strong> {{ number_format($carFuel->car->km, 0, ',', '.') }}</p>
                                        @endif
                                        @if($carFuel->car->tank)
                                            <p class="mb-2"><strong>Capacità serbatoio:</strong> {{ $carFuel->car->tank }} litri</p>
                                        @endif
                                    </div>
                                </div>

                                <!-- Rifornimenti Precedenti -->
                                @if($previousFuels->count() > 0)
                                    <div class="card">
                                        <div class="card-header bg-info text-white">
                                            <h5 class="mb-0"><i class="bi bi-clock-history"></i> Rifornimenti Precedenti</h5>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-unstyled mb-0">
                                                @foreach($previousFuels as $fuel)
                                                    <li class="mb-2">
                                                        <small>
                                                            <strong>{{ $fuel->date_from->format('d/m/Y') }}</strong><br>
                                                            {{ $fuel->name }}
                                                            @if($fuel->description)
                                                                <br><span class="text-muted">{{ $fuel->description }}</span>
                                                            @endif
                                                        </small>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <a href="{{ route('car-fuels.index', ['car_id' => $carFuel->car_id]) }}" class="btn btn-sm btn-info mt-2">
                                                <i class="bi bi-list"></i> Vedi tutti
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
