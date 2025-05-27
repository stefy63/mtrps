@extends('layouts.app')

@section('template_title')
    {{ $carOwner->name ?? __('Show') . " " . __('Car Owner') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left d-flex align-items-center">
                            @php
                                $ownerName = strtolower($carOwner->name);
                                if (str_contains($ownerName, 'stato') || str_contains($ownerName, 'ministero') || str_contains($ownerName, 'governo') || str_contains($ownerName, 'agenzia')) {
                                    $icon = 'fas fa-landmark text-primary';
                                    $bgColor = 'bg-primary';
                                    $badge = 'Ente Statale';
                                    $badgeClass = 'primary';
                                } elseif (str_contains($ownerName, 'comune') || str_contains($ownerName, 'provincia') || str_contains($ownerName, 'regione') || str_contains($ownerName, 'città')) {
                                    $icon = 'fas fa-city text-info';
                                    $bgColor = 'bg-info';
                                    $badge = 'Ente Locale';
                                    $badgeClass = 'info';
                                } elseif (str_contains($ownerName, 'polizia') || str_contains($ownerName, 'carabinieri') || str_contains($ownerName, 'guardia') || str_contains($ownerName, 'arma')) {
                                    $icon = 'fas fa-shield-alt text-danger';
                                    $bgColor = 'bg-danger';
                                    $badge = 'Forze dell\'Ordine';
                                    $badgeClass = 'danger';
                                } elseif (str_contains($ownerName, 'azienda') || str_contains($ownerName, 'spa') || str_contains($ownerName, 'srl') || str_contains($ownerName, 'società')) {
                                    $icon = 'fas fa-building text-success';
                                    $bgColor = 'bg-success';
                                    $badge = 'Ente Privato';
                                    $badgeClass = 'success';
                                } else {
                                    $icon = 'fas fa-user text-secondary';
                                    $bgColor = 'bg-secondary';
                                    $badge = 'Generico';
                                    $badgeClass = 'secondary';
                                }
                            @endphp
                            
                            <!-- Icona proprietario -->
                            <div class="owner-icon d-flex align-items-center justify-content-center {{ $bgColor }} bg-opacity-10 rounded-circle me-3" style="width: 70px; height: 70px;">
                                <i class="{{ $icon }} fa-2x"></i>
                            </div>
                            <div>
                                <span class="card-title">{{ __('Show') }} Car Owner: {{ $carOwner->name }}</span>
                                <br><span class="badge badge-{{ $badgeClass }}">{{ $badge }}</span>
                            </div>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('car-owners.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <div class="row">
                            <div class="col-md-8">
                                
                                <div class="form-group mb-3">
                                    <strong>Nome Proprietario:</strong>
                                    <h4 class="text-primary">{{ $carOwner->name }}</h4>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <strong>Tipologia:</strong>
                                    <span class="badge badge-{{ $badgeClass }} badge-lg">
                                        <i class="{{ $icon }}"></i> {{ $badge }}
                                    </span>
                                </div>
                                
                                @if($carOwner->description)
                                <div class="form-group mb-3">
                                    <strong>Descrizione:</strong>
                                    <p class="lead">{{ $carOwner->description }}</p>
                                </div>
                                @endif
                                
                                @if($carOwner->note)
                                <div class="form-group mb-3">
                                    <strong>Note:</strong>
                                    <div class="border p-3 bg-light rounded">
                                        {!! nl2br(e($carOwner->note)) !!}
                                    </div>
                                </div>
                                @endif
                                
                                <!-- Caratteristiche per tipo di ente -->
                                <div class="form-group mb-3">
                                    <strong>Caratteristiche:</strong>
                                    <div class="row mt-2">
                                        @if (str_contains($ownerName, 'stato') || str_contains($ownerName, 'ministero'))
                                        <div class="col-md-6">
                                            <ul class="list-unstyled">
                                                <li><i class="fas fa-check text-success"></i> Ente pubblico statale</li>
                                                <li><i class="fas fa-check text-success"></i> Finanziamento statale</li>
                                                <li><i class="fas fa-check text-success"></i> Competenze nazionali</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <ul class="list-unstyled">
                                                <li><i class="fas fa-info text-info"></i> Soggetto a controlli centrali</li>
                                                <li><i class="fas fa-info text-info"></i> Procedure di gara nazionali</li>
                                                <li><i class="fas fa-info text-info"></i> Reporting ministeriale</li>
                                            </ul>
                                        </div>
                                        @elseif (str_contains($ownerName, 'comune') || str_contains($ownerName, 'provincia'))
                                        <div class="col-md-6">
                                            <ul class="list-unstyled">
                                                <li><i class="fas fa-check text-success"></i> Ente territoriale</li>
                                                <li><i class="fas fa-check text-success"></i> Autonomia locale</li>
                                                <li><i class="fas fa-check text-success"></i> Servizi al cittadino</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <ul class="list-unstyled">
                                                <li><i class="fas fa-info text-info"></i> Bilancio comunale/provinciale</li>
                                                <li><i class="fas fa-info text-info"></i> Gare locali</li>
                                                <li><i class="fas fa-info text-info"></i> Controllo regionale</li>
                                            </ul>
                                        </div>
                                        @elseif (str_contains($ownerName, 'polizia') || str_contains($ownerName, 'carabinieri'))
                                        <div class="col-md-6">
                                            <ul class="list-unstyled">
                                                <li><i class="fas fa-shield text-primary"></i> Forza dell'ordine</li>
                                                <li><i class="fas fa-shield text-primary"></i> Veicoli operativi</li>
                                                <li><i class="fas fa-shield text-primary"></i> Dotazioni speciali</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <ul class="list-unstyled">
                                                <li><i class="fas fa-exclamation-triangle text-warning"></i> Normative speciali</li>
                                                <li><i class="fas fa-exclamation-triangle text-warning"></i> Manutenzione prioritaria</li>
                                                <li><i class="fas fa-exclamation-triangle text-warning"></i> Sicurezza elevata</li>
                                            </ul>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Statistiche Flotta</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group mb-2">
                                            <strong>Veicoli Totali:</strong>
                                            <span class="badge badge-{{ $carOwner->cars->count() > 0 ? 'success' : 'secondary' }} badge-lg">
                                                <i class="fas fa-car"></i> {{ $carOwner->cars->count() }}
                                            </span>
                                        </div>
                                        
                                        @if($carOwner->cars->count() > 0)
                                        @php
                                            $totalKm = $carOwner->cars->sum('km');
                                            $avgKm = $carOwner->cars->avg('km');
                                            $brandsCount = $carOwner->cars->groupBy('car_brand_id')->count();
                                            $typesCount = $carOwner->cars->groupBy('car_type_id')->count();
                                            $powersCount = $carOwner->cars->groupBy('car_power_id')->count();
                                            $estimatedValue = $carOwner->cars->count() * 25000; // €25k medio
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
                                        
                                        <div class="form-group mb-2">
                                            <strong>Alimentazioni diverse:</strong>
                                            <br><span class="text-info">{{ $powersCount }}</span>
                                        </div>
                                        
                                        <div class="form-group mb-2">
                                            <strong>Valore stimato:</strong>
                                            <br><span class="text-success"><i class="fas fa-euro-sign"></i> {{ number_format($estimatedValue, 0, ',', '.') }}</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h6 class="mb-0">Informazioni Sistema</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group mb-2">
                                            <strong>ID:</strong>
                                            <span class="badge badge-secondary">#{{ $carOwner->id }}</span>
                                        </div>
                                        
                                        <div class="form-group mb-2">
                                            <strong>Creato:</strong>
                                            <br><small>{{ $carOwner->created_at->format('d/m/Y H:i') }}</small>
                                        </div>
                                        
                                        <div class="form-group mb-2">
                                            <strong>Aggiornato:</strong>
                                            <br><small>{{ $carOwner->updated_at->format('d/m/Y H:i') }}</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-3">
                                    <a href="{{ route('car-owners.edit', $carOwner->id) }}" class="btn btn-success btn-sm">
                                        <i class="fa fa-edit"></i> Modifica
                                    </a>
                                    
                                    @if($carOwner->cars->count() == 0)
                                    <form action="{{ route('car-owners.destroy', $carOwner->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Sei sicuro di voler eliminare questo proprietario?')">
                                            <i class="fa fa-trash"></i> Elimina
                                        </button>
                                    </form>
                                    @else
                                    <button class="btn btn-danger btn-sm" disabled title="Impossibile eliminare: ci sono veicoli associati">
                                        <i class="fa fa-trash"></i> Elimina
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        @if($carOwner->cars && $carOwner->cars->count() > 0)
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <h5>
                                    <i class="{{ $icon }} me-2"></i>
                                    Veicoli di proprietà di {{ $carOwner->name }}:
                                </h5>
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Targa</th>
                                                <th>Nome</th>
                                                <th>Marca</th>
                                                <th>Modello</th>
                                                <th>Tipo</th>
                                                <th>Alimentazione</th>
                                                <th>Km</th>
                                                <th>Azioni</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($carOwner->cars->take(15) as $car)
                                            <tr>
                                                <td>
                                                    @if($car->carPlates->count() > 0)
                                                    <span class="badge badge-info">{{ $car->carPlates->first()->name }}</span>
                                                    @else
                                                    <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>
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
                                                    @if($car->carPower)
                                                    <span class="badge badge-outline-primary">{{ $car->carPower->name }}</span>
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
                                    @if($carOwner->cars->count() > 15)
                                    <div class="text-center">
                                        <p class="text-muted">... e altri {{ $carOwner->cars->count() - 15 }} veicoli</p>
                                        <a href="{{ route('cars.index') }}?owner={{ $carOwner->id }}" class="btn btn-outline-primary btn-sm">
                                            Vedi tutti i veicoli di {{ $carOwner->name }}
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
                                    Nessun veicolo ancora assegnato a questo proprietario.
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