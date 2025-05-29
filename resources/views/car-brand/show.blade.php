@extends('layouts.app')

@section('template_title')
    {{ $carBrand->name ?? __('Show') . " " . __('Car Brand') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left d-flex align-items-center">
                            <!-- Logo placeholder -->
                            <div class="brand-logo d-flex align-items-center justify-content-center bg-primary text-white rounded-circle me-3" style="width: 50px; height: 50px;">
                                <i class="fas fa-car fa-lg"></i>
                            </div>
                            <span class="card-title">{{ __('Show') }} Car Brand: {{ $carBrand->name }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('car-brands.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <div class="row">
                            <div class="col-md-8">
                                
                                <div class="form-group mb-3">
                                    <strong>Nome Marca:</strong>
                                    <h4 class="text-primary">{{ $carBrand->name }}</h4>
                                </div>
                                
                                @if($carBrand->description)
                                <div class="form-group mb-3">
                                    <strong>Descrizione:</strong>
                                    <p class="lead">{{ $carBrand->description }}</p>
                                </div>
                                @endif
                                
                                @if($carBrand->note)
                                <div class="form-group mb-3">
                                    <strong>Note:</strong>
                                    <div class="border p-3 bg-light rounded">
                                        {!! nl2br(e($carBrand->note)) !!}
                                    </div>
                                </div>
                                @endif
                            </div>
                            
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Informazioni Sistema</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group mb-2">
                                            <strong>ID:</strong>
                                            <span class="badge badge-secondary">#{{ $carBrand->id }}</span>
                                        </div>
                                        
                                        <div class="form-group mb-2">
                                            <strong>Creato:</strong>
                                            <br><small>{{ $carBrand->created_at->format('d/m/Y H:i') }}</small>
                                        </div>
                                        
                                        <div class="form-group mb-2">
                                            <strong>Aggiornato:</strong>
                                            <br><small>{{ $carBrand->updated_at->format('d/m/Y H:i') }}</small>
                                        </div>
                                        
                                        <div class="form-group mb-2">
                                            <strong>Veicoli associati:</strong>
                                            <span class="badge badge-{{ $carBrand->cars->count() > 0 ? 'success' : 'secondary' }} badge-lg">
                                                {{ $carBrand->cars->count() ?? 0 }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Statistiche aggiuntive -->
                                @if($carBrand->cars->count() > 0)
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h6 class="mb-0">Statistiche Flotta</h6>
                                    </div>
                                    <div class="card-body">
                                        @php
                                            $totalKm = $carBrand->cars->sum('km');
                                            $avgKm = $carBrand->cars->avg('km');
                                            $typesCount = $carBrand->cars->groupBy('car_type_id')->count();
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
                                            <strong>Tipologie diverse:</strong>
                                            <br><span class="text-info">{{ $typesCount }}</span>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                
                                <div class="mt-3">
                                    <a href="{{ route('car-brands.edit', $carBrand->id) }}" class="btn btn-success btn-sm">
                                        <i class="fa fa-edit"></i> Modifica
                                    </a>
                                    
                                    <form action="{{ route('car-brands.destroy', $carBrand->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Sei sicuro di voler eliminare questa marca? Tutti i veicoli associati perderanno il riferimento alla marca.')">
                                            <i class="fa fa-trash"></i> Elimina
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        @if($carBrand->cars && $carBrand->cars->count() > 0)
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <h5>
                                    <i class="fas fa-car me-2"></i>
                                    Veicoli {{ $carBrand->name }} in flotta:
                                </h5>
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Nome</th>
                                                <th>Modello</th>
                                                <th>Tipo</th>
                                                <th>Colore</th>
                                                <th>Km</th>
                                                <th>Azioni</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($carBrand->cars->take(10) as $car)
                                            <tr>
                                                <td><strong>{{ $car->name }}</strong></td>
                                                <td>{{ $car->model ?? 'N/A' }}</td>
                                                <td>
                                                    @if($car->carType)
                                                    <span class="badge badge-outline-secondary">{{ $car->carType->name }}</span>
                                                    @else
                                                    <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($car->color)
                                                    <span class="badge" style="background-color: {{ strtolower($car->color) }}; color: white;">
                                                        {{ $car->color }}
                                                    </span>
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
                                    @if($carBrand->cars->count() > 10)
                                    <div class="text-center">
                                        <p class="text-muted">... e altri {{ $carBrand->cars->count() - 10 }} veicoli</p>
                                        <a href="{{ route('cars.index') }}?brand={{ $carBrand->id }}" class="btn btn-outline-primary btn-sm">
                                            Vedi tutti i veicoli {{ $carBrand->name }}
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
                                    Nessun veicolo ancora associato a questa marca.
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