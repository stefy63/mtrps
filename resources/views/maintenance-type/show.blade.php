@extends('layouts.app')

@section('template_title')
    {{ $maintenanceType->name ?? __('Dettagli Tipo Intervento') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="card-title">
                                <i class="bi bi-tools"></i> {{ __('Dettagli Tipo Intervento') }}
                            </span>
                            <div>
                                <a class="btn btn-sm btn-warning" href="{{ route('maintenance-types.edit', $maintenanceType->id) }}">
                                    <i class="bi bi-pencil"></i> {{ __('Modifica') }}
                                </a>
                                <a class="btn btn-sm btn-primary" href="{{ route('maintenance-types.index') }}">
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
                                        <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informazioni Intervento</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <strong>Tipo Intervento:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                <h5 class="mb-0">{{ $maintenanceType->name }}</h5>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <strong>Categoria:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                @php
                                                    $category = 'Altro';
                                                    $categoryIcon = 'wrench';
                                                    $categoryColor = 'secondary';

                                                    $name = strtolower($maintenanceType->name);

                                                    if (str_contains($name, 'olio') || str_contains($name, 'motore') || str_contains($name, 'filtro') || str_contains($name, 'candel')) {
                                                        $category = 'Motore';
                                                        $categoryIcon = 'gear';
                                                        $categoryColor = 'primary';
                                                    } elseif (str_contains($name, 'freni') || str_contains($name, 'pastigli') || str_contains($name, 'disco')) {
                                                        $category = 'Freni';
                                                        $categoryIcon = 'sign-stop';
                                                        $categoryColor = 'danger';
                                                    } elseif (str_contains($name, 'sospensi') || str_contains($name, 'ammortiz')) {
                                                        $category = 'Sospensioni';
                                                        $categoryIcon = 'arrows-expand';
                                                        $categoryColor = 'warning';
                                                    } elseif (str_contains($name, 'elettr') || str_contains($name, 'batteria') || str_contains($name, 'luci')) {
                                                        $category = 'Elettrico';
                                                        $categoryIcon = 'lightning';
                                                        $categoryColor = 'info';
                                                    } elseif (str_contains($name, 'pneumatic') || str_contains($name, 'gomm')) {
                                                        $category = 'Pneumatici';
                                                        $categoryIcon = 'circle';
                                                        $categoryColor = 'dark';
                                                    } elseif (str_contains($name, 'clima') || str_contains($name, 'aria')) {
                                                        $category = 'Climatizzazione';
                                                        $categoryIcon = 'snow';
                                                        $categoryColor = 'info';
                                                    } elseif (str_contains($name, 'carroz') || str_contains($name, 'vernic')) {
                                                        $category = 'Carrozzeria';
                                                        $categoryIcon = 'palette';
                                                        $categoryColor = 'success';
                                                    }
                                                @endphp
                                                <span class="badge bg-{{ $categoryColor }}">
                                                    <i class="bi bi-{{ $categoryIcon }}"></i> {{ $category }}
                                                </span>
                                            </div>
                                        </div>

                                        @if($maintenanceType->description)
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <strong>Descrizione:</strong>
                                                </div>
                                                <div class="col-md-8">
                                                    {{ $maintenanceType->description }}
                                                </div>
                                            </div>
                                        @endif

                                        @if($maintenanceType->note)
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <strong>Note:</strong>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="alert alert-light">
                                                        {{ $maintenanceType->note }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <hr>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <small class="text-muted">
                                                    <i class="bi bi-clock"></i> Creato il: {{ $maintenanceType->created_at->format('d/m/Y H:i') }}
                                                </small>
                                            </div>
                                            <div class="col-md-6 text-end">
                                                <small class="text-muted">
                                                    <i class="bi bi-clock-history"></i> Aggiornato il: {{ $maintenanceType->updated_at->format('d/m/Y H:i') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- Info Manutenzione -->
                                <div class="card mb-3">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="mb-0"><i class="bi bi-wrench"></i> Manutenzione</h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="mb-2">
                                            <strong>Tipo:</strong> {{ $maintenanceType->maintenance->name }}
                                        </p>
                                        <p class="mb-2">
                                            <strong>Veicolo:</strong> {{ $maintenanceType->maintenance->car->name }}
                                            @if($maintenanceType->maintenance->car->carPlates->count() > 0)
                                                <br><span class="badge bg-primary">{{ $maintenanceType->maintenance->car->carPlates->first()->name }}</span>
                                            @endif
                                        </p>
                                        <p class="mb-2">
                                            <strong>Periodo:</strong><br>
                                            {{ $maintenanceType->maintenance->date_from->format('d/m/Y') }}
                                            @if($maintenanceType->maintenance->date_to)
                                                - {{ $maintenanceType->maintenance->date_to->format('d/m/Y') }}
                                            @else
                                                (In corso)
                                            @endif
                                        </p>
                                        <div class="d-grid">
                                            <a href="{{ route('maintenances.show', $maintenanceType->maintenance->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-eye"></i> Vedi Manutenzione
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Officine Collegate -->
                                @if($maintenanceType->maintenance->maintenanceGarages->count() > 0)
                                    <div class="card">
                                        <div class="card-header bg-secondary text-white">
                                            <h5 class="mb-0"><i class="bi bi-building"></i> Officine</h5>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-unstyled mb-0">
                                                @foreach($maintenanceType->maintenance->maintenanceGarages as $garage)
                                                    <li class="mb-2">
                                                        <strong>{{ $garage->name }}</strong>
                                                        @if($garage->piva)
                                                            <br><small class="text-muted">P.IVA: {{ $garage->piva }}</small>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
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
