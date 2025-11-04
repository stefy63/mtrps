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
                            <span class="card-title">{{ __('Visualizza ') }} marca vettura: {{ $carBrand->name }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('car-brands.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                
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
                                                <th>Tipo</th>
                                                <th>Colore</th>
                                                <th>Km</th>
                                                <th class="text-center">Azioni</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($carBrand->cars->take(10) as $car)
                                            <tr>
                                                <td><strong>{{ $car->full_name }}</strong></td>
                                                <td>
                                                    @if($car->carType->name)
                                                    <span class="badge bg-secondary w-75">{{ $car->carType->name }}</span>
                                                    @else
                                                    <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($car->color)
                                                    <span class="badge bg-primary w-75" style="background-color: {{ strtolower($car->color) }}; color: white;">
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
                                                <td class="text-end">
                                                    <a href="{{ route('cars.show', $car->id) }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-sm btn-outline-success">
                                                        <i class="bi bi-pencil"></i>
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