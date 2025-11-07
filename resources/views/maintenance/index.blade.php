@extends('layouts.app')

@section('template_title')
    Manutenzioni
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                <i class="bi bi-wrench"></i> {{ __('Manutenzioni') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('maintenances.create') }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus"></i> {{ __('Nuova Manutenzione') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {{-- Filtri --}}
                        <div class="row mb-3">
                            <div class="col-12">
                                <x-input-search-button
                                        action="{{ route('maintenances.index') }}"
                                        search="{{old('search', $search)}}"
                                        name="closed"
                                        label="Chiuse"
                                        check="{{old('closed', $closed)}}"
                                />
                            </div>
                        </div>
                        @if(count($maintenances) > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="thead">
                                    <tr>
                                        <th class="col-1">Stato</th>
                                        <th class="col-2">Veicolo</th>
                                        <th class="col-1">Targa</th>
                                        <th class="col-1">Tipo Manutenzione</th>
                                        <th class="col-1">Data Inizio</th>
                                        <th class="col-1">Data Fine</th>
                                        <th class="col-2">Officina</th>
                                        <th class="col-1">Mail</th>
                                        <th class="col-1">Telefono</th>
                                        <th class="col-1"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($maintenances as $maintenance)
                                        @php
                                            $isActive = !$maintenance->date_to || $maintenance->date_to >= now();
                                        @endphp
                                        <tr>
                                            <td>
                                                @if($isActive)
                                                    <span class="badge bg-warning text-dark w-75">
                                                            <i class="bi bi-clock"></i> In corso
                                                        </span>
                                                @else
                                                    <span class="badge bg-success">
                                                            <i class="bi bi-check-circle"></i> Completata
                                                        </span>
                                                @endif
                                            </td>
                                            <td class="text-truncate">
                                                <a href="{{route('cars.show', $maintenance->car_id)}}"
                                                   class="text-decoration-none">
                                                    <strong>{{ $maintenance->car?->carType->name }}</strong>
                                                    @if($maintenance->car?->carBrand)
                                                        <br>
                                                        <small class="text-muted">{{ $maintenance->car?->carBrand->name }}</small>
                                                    @endif
                                                </a>
                                            </td>
                                            <td>
                                                @if($maintenance->car?->carPlates->count() > 0)
                                                    <span class="badge bg-primary w-75">
                                                        {{ $maintenance->car?->carPlates()->whereType('POLIZIA')->first()?->name }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                <strong>{{ $maintenance->maintenanceTypes?->name ?? '' }}</strong>
                                            </td>
                                            <td>
                                                <small>{{ \Carbon\Carbon::parse($maintenance->date_from)->format('d/m/Y') }}</small>
                                            </td>
                                            <td>
                                                @if($maintenance->date_to)
                                                    <small>{{ \Carbon\Carbon::parse($maintenance->date_to)->format('d/m/Y') }}</small>
                                                @else
                                                    <span class="text-muted">In corso</span>
                                                @endif
                                            </td>
                                            <td class="text-truncate">
                                                <span data-bs-toggle="tooltip">

                                                <a href="{{route('maintenance-garages.show', $maintenance->garage_id)}}"
                                                   class="text-decoration-none">
                                                    {{ $maintenance->maintenanceGarages?->name ?? '' }}
                                                    @if($maintenance->maintenanceGarages?->address)
                                                        <br>
                                                        <small class="text-muted">{{ $maintenance->maintenanceGarages?->address }}</small>
                                                    @endif
                                                </a>
                                                </span>
                                            </td>
                                            <td class="text-truncate">
                                                @if($maintenance->maintenanceGarages?->mail)
                                                    <small data-bs-toggle="tooltip"
                                                           title="{{ $maintenance->maintenanceGarages?->mail }}">
                                                        {{$maintenance->maintenanceGarages?->mail }}
                                                    </small><br>
                                                @endif
                                                @if($maintenance->maintenanceGarages?->pec)
                                                    <small data-bs-toggle="tooltip"
                                                           title="{{ $maintenance->maintenanceGarages?->pec }}">
                                                        {{$maintenance->maintenanceGarages?->pec }}
                                                    </small><br>
                                                @endif
                                            </td>
                                            <td style="font-size: 10px">
                                                @if($maintenance->maintenanceGarages?->phone1)
                                                    <small data-bs-toggle="tooltip"
                                                           title="{{ $maintenance->maintenanceGarages?->phone1 }}">
                                                        {{$maintenance->maintenanceGarages?->phone1 }}
                                                    </small><br>
                                                @endif
                                                @if($maintenance->maintenanceGarages?->phone2)
                                                    <small data-bs-toggle="tooltip"
                                                           title="{{ $maintenance->maintenanceGarages?->phone2 }}">
                                                        {{$maintenance->maintenanceGarages?->phone2 }}
                                                    </small><br>
                                                @endif
                                                @if($maintenance->maintenanceGarages?->phone3)
                                                    <small data-bs-toggle="tooltip"
                                                           title="{{ $maintenance->maintenanceGarages?->phone3 }}">
                                                        {{$maintenance->maintenanceGarages?->phone3 }}
                                                    </small>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                @if($isActive)
                                                    <x-action-table-button :item="$maintenance" :label="'Manutenzione'"
                                                                           itemRoute="maintenances"/>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle"></i> Nessuna manutenzione registrata.
                                <a href="{{ route('maintenances.create') }}" class="alert-link">Registra la prima
                                    manutenzione</a>
                            </div>
                        @endif
                    </div>
                </div>

                @if($maintenances->hasPages())
                    <div class="mt-3">
                        {!! $maintenances->withQueryString()->links() !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Inizializza i tooltip
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    </script>
@endpush
