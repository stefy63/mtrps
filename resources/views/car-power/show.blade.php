@extends('layouts.app')

@section('template_title')
    {{ $carPower->name ?? __('Show') . " " . __('Car Power') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left d-flex align-items-center">
                            @php
                                $powerName = strtolower($carPower->name);
                                if (str_contains($powerName, 'benzina')) {
                                    $icon = 'fas fa-gas-pump text-warning';
                                    $bgColor = 'bg-warning';
                                } elseif (str_contains($powerName, 'diesel') || str_contains($powerName, 'gasolio')) {
                                    $icon = 'fas fa-oil-can text-dark';
                                    $bgColor = 'bg-secondary';
                                } elseif (str_contains($powerName, 'elettric')) {
                                    $icon = 'fas fa-bolt text-primary';
                                    $bgColor = 'bg-primary';
                                } elseif (str_contains($powerName, 'ibrido') || str_contains($powerName, 'hybrid')) {
                                    $icon = 'fas fa-leaf text-success';
                                    $bgColor = 'bg-success';
                                } elseif (str_contains($powerName, 'gpl')) {
                                    $icon = 'fas fa-fire text-info';
                                    $bgColor = 'bg-info';
                                } elseif (str_contains($powerName, 'metano') || str_contains($powerName, 'cng')) {
                                    $icon = 'fas fa-wind text-success';
                                    $bgColor = 'bg-success';
                                } elseif (str_contains($powerName, 'idrogeno')) {
                                    $icon = 'fas fa-atom text-primary';
                                    $bgColor = 'bg-primary';
                                } else {
                                    $icon = 'fas fa-cog text-muted';
                                    $bgColor = 'bg-light';
                                }
                            @endphp
                            
                            <!-- Icona alimentazione -->
                            <div class="power-icon d-flex align-items-center justify-content-center {{ $bgColor }} bg-opacity-10 rounded-circle me-3" style="width: 60px; height: 60px;">
                                <i class="{{ $icon }} fa-2x"></i>
                            </div>
                            <span class="card-title">{{ __('Show') }} Car Power: {{ $carPower->name }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('car-powers.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <div class="row">
                            <div class="col-md-8">
                                
                                <div class="form-group mb-3">
                                    <strong>Nome Alimentazione:</strong>
                                    <h4 class="text-primary">{{ $carPower->name }}</h4>
                                </div>
                                
                                @if($carPower->description)
                                <div class="form-group mb-3">
                                    <strong>Descrizione:</strong>
                                    <p class="lead">{{ $carPower->description }}</p>
                                </div>
                                @endif
                                
                                <!-- Caratteristiche ambientali -->
                                <div class="form-group mb-3">
                                    <strong>Impatto Ambientale:</strong>
                                    <br>
                                    @php
                                        if (str_contains($powerName, 'elettric')) {
                                            $envClass = 'success';
                                            $envText = 'Eco-friendly - Zero emissioni locali';
                                            $envIcon = 'fas fa-leaf';
                                        } elseif (str_contains($powerName, 'ibrido') || str_contains($powerName, 'hybrid')) {
                                            $envClass = 'warning';
                                            $envText = 'Medio impatto - Emissioni ridotte';
                                            $envIcon = 'fas fa-balance-scale';
                                        } elseif (str_contains($powerName, 'gpl') || str_contains($powerName, 'metano') || str_contains($powerName, 'cng')) {
                                            $envClass = 'info';
                                            $envText = 'Basso impatto - Gas naturale';
                                            $envIcon = 'fas fa-wind';
                                        } elseif (str_contains($powerName, 'idrogeno')) {
                                            $envClass = 'primary';
                                            $envText = 'Futuro sostenibile - Solo vapor d\'acqua';
                                            $envIcon = 'fas fa-atom';
                                        } else {
                                            $envClass = 'danger';
                                            $envText = 'Alto impatto - Combustibili fossili';
                                            $envIcon = 'fas fa-smog';
                                        }
                                    @endphp
                                    
                                    <span class="badge badge-{{ $envClass }} badge-lg">
                                        <i class="{{ $envIcon }} me-1"></i>
                                        {{ $envText }}
                                    </span>
                                </div>
                                
                                <!-- Caratteristiche tecniche -->
                                <div class="form-group mb-3">
                                    <strong>Caratteristiche:</strong>
                                    <div class="row mt-2">
                                        @if (str_contains($powerName, 'elettric'))
                                        <div class="col-md-6">
                                            <ul class="list-unstyled">
                                                <li><i class="fas fa-check text-success"></i> Silenzioso</li>
                                                <li><i class="fas fa-check text-success"></i> Coppia istantanea</li>
                                                <li><i class="fas fa-check text-success"></i> Manutenzione ridotta</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <ul class="list-unstyled">
                                                <li><i class="fas fa-exclamation-triangle text-warning"></i> Autonomia limitata</li>
                                                <li><i class="fas fa-exclamation-triangle text-warning"></i> Tempi di ricarica</li>
                                                <li><i class="fas fa-exclamation-triangle text-warning"></i> Costo iniziale elevato</li>
                                            </ul>
                                        </div>
                                        @elseif (str_contains($powerName, 'diesel'))
                                        <div class="col-md-6">
                                            <ul class="list-unstyled">
                                                <li><i class="fas fa-check text-success"></i> Consumi ridotti</li>
                                                <li><i class="fas fa-check text-success"></i> Coppia elevata</li>
                                                <li><i class="fas fa-check text-success"></i> Durata motore</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <ul class="list-unstyled">
                                                <li><i class="fas fa-times text-danger"></i> Emissioni NOx</li>
                                                <li><i class="fas fa-times text-danger"></i> Particolato</li>
                                                <li><i class="fas fa-times text-danger"></i> Rumorosità</li>
                                            </ul>
                                        </div>
                                        @elseif (str_contains($powerName, 'benzina'))
                                        <div class="col-md-6">
                                            <ul class="list-unstyled">
                                                <li><i class="fas fa-check text-success"></i> Prestazioni elevate</li>
                                                <li><i class="fas fa-check text-success"></i> Silenziosità</li>
                                                <li><i class="fas fa-check text-success"></i> Costo veicolo contenuto</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <ul class="list-unstyled">
                                                <li><i class="fas fa-times text-danger"></i> Consumi elevati</li>
                                                <li><i class="fas fa-times text-danger"></i> Emissioni CO2</li>
                                                <li><i class="fas fa-times text-danger"></i> Costo carburante</li>
                                            </ul>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Informazioni Sistema</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group mb-2">
                                            <strong>ID:</strong>
                                            <span class="badge badge-secondary">#{{ $carPower->id }}</span>
                                        </div>
                                        
                                        <div class="form-group mb-2">
                                            <strong>Creato:</strong>
                                            <br><small>{{ $carPower->created_at->format('d/m/Y H:i') }}</small>
                                        </div>
                                        
                                        <div class="form-group mb-2">
                                            <strong>Aggiornato:</strong>
                                            <br><small>{{ $carPower->updated_at->format('d/m/Y H:i') }}</small>
                                        </div>
                                        
                                        <div class="form-group mb-2">
                                            <strong>Veicoli associati:</strong>
                                            <span class="badge badge-{{ $carPower->cars->count() > 0 ? 'success' : 'secondary' }} badge-lg">
                                                {{ $carPower->cars->count() ?? 0 }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Statistiche flotta per alimentazione -->
                                @if($carPower->cars->count() > 0)
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h6 class="mb-0">Statistiche Flotta</h6>
                                    </div>
                                    <div class="card-body">
                                        @php
                                            $totalKm = $carPower->cars->sum('km');
                                            $avgKm = $carPower->cars->avg('km');
                                            $brandsCount = $carPower->cars->groupBy('car_brand_id')->count();
                                            $typesCount = $carPower->cars->groupBy('car_type_id')->count();
                                        @endphp
                                        
                                        <div class="form-group mb-2">
                                            <strong>Km totali:</strong>
                                            <br><span class="text-info">{{ number_format($totalKm) }} km</span>
                                        </div>
                                        
                                        <div class="form-group mb-2">
                                            <strong>Km medi:</strong>
                                            <br><span class="text-info">{{ number_format($avgKm) }} km</span>
                                        </div>
                                        
                                        <div class="form-group mb-2">
                                            <strong>Marche diverse:</strong>
                                            <br><span class="text-info">{{ $brandsCount }}</span>
                                        </div>
                                        
                                        <div class="form-group mb-2">
                                            <strong>Tipologie diverse:</strong>
                                            <br><span class="text-info">{{ $typesCount }}</span>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                
                                <div class="mt-3">
                                    <a href="{{ route('car-powers.edit', $carPower->id) }}" class="btn btn-success btn-sm">
                                        <i class="fa fa-edit"></i> Modifica
                                    </a>
                                    
                                    <form action="{{ route('car-powers.destroy', $carPower->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Sei sicuro di voler eliminare questa alimentazione? Tutti i veicoli associati perderanno il riferimento all\'alimentazione.')">
                                            <i class="fa fa-trash"></i> Elimina
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        @if($carPower->cars && $carPower->cars->count() > 0)
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <h5>
                                    <i class="{{ $icon }} me-2"></i>
                                    Veicoli con alimentazione {{ $carPower->name }}:
                                </h5>
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Nome</th>
                                                <th>Marca</th>
                                                <th>Modello</th>
                                                <th>Tipo</th>
                                                <th>Km</th>
                                                <th>Azioni</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($carPower->cars->take(10) as $car)
                                            <tr>
                                                <td><strong>{{ $car->name }}</strong></td>
                                                <td>{{ $car->carBrand?->name ?? 'N/A' }}</td>
                                                <td>{{ $car->model ?? 'N/A' }}</td>
                                                <td>
                                                    @if($car->carType)
                                                    <span class="badge badge-outline-secondary">{{ $car->carType->name }}</span>
                                                    @else
                                                    <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($car->km)
                                                    {{ number_format($car->km) }} km
                                                    @else
                                                    <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('cars.show', $car->id) }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-sm btn-outline-success">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @if($carPower->cars->count() > 10)
                                    <div class="text-center">
                                        <p class="text-muted">... e altri {{ $carPower->cars->count() - 10 }} veicoli</p>
                                        <a href="{{ route('cars.index') }}?power={{ $carPower->id }}" class="btn btn-outline-primary btn-sm">
                                            Vedi tutti i veicoli {{ $carPower->name }}
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Nessun veicolo ancora associato a questa alimentazione.
                                    <a href="{{ route('cars.create') }}" class="btn btn-sm btn-primary ms-2">
                                        Aggiungi primo veicolo
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection