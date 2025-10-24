@extends('layouts.app')

@section('template_title')
    {{ $carOwner->name ?? __('Visualizza') . " " . __('Proprietario') }}
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

                            <div>
                                <span class="card-title">{{ __('Visualizza') }} proprietario: {{ $carOwner->name }}</span>
                            </div>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm"
                               href="{{ route('car-owners.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <div class="row">
                            <div class="col-md-8">

                                <div class="form-group mb-3">
                                    <strong>Nome Proprietario:</strong>
                                    <h4 class="text-primary text-bold">{{ $carOwner->name }}</h4>
                                </div>

                                @if($carOwner->description)
                                    <div class="form-group mb-3">
                                        <strong>Descrizione:</strong>
                                        <p class="lead">{{ $carOwner->description }}</p>
                                    </div>
                                @endif

                                @if($carOwner->phone)
                                    <div class="form-group mb-3">
                                        <strong>Telefono:</strong>
                                        <p class="lead">{{ $carOwner->phone }}</p>
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
                                                <th>Modello</th>
                                                <th>Tipo</th>
                                                <th>Alimentazione</th>
                                                <th>Azioni</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($carOwner->cars->take(20) as $car)
                                                <tr>
                                                    <td>
                                                        <span class="badge bg-info">{{ $car->carPlates->first()->name }}</span>
                                                    </td>
                                                    <td><strong>{{ $car->full_name }}</strong></td>
                                                    <td>
                                                        @if($car->carType)
                                                            <span class="badge bg-secondary w-50">{{ $car->carType->name }}</span>
                                                        @else
                                                            <span class="text-muted">N/A</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($car->carPower)
                                                            <span class="badge bg-primary w-50">{{ $car->carPower->name }}</span>
                                                        @else
                                                            <span class="text-muted">N/A</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="{{ route('cars.show', $car->id) }}"
                                                           class="btn btn-sm btn-outline-primary">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <a href="{{ route('cars.edit', $car->id) }}"
                                                           class="btn btn-sm btn-outline-success">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        @if($carOwner->cars->count() > 15)
                                            <div class="text-center">
                                                <p class="text-muted">... e altri {{ $carOwner->cars->count() - 15 }}
                                                    veicoli</p>
                                                <a href="{{ route('cars.index') }}?owner={{ $carOwner->id }}"
                                                   class="btn btn-outline-primary btn-sm">
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