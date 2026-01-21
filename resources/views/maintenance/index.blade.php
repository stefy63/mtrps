@extends('layouts.app')

@section('template_title')
    Manutenzioni
@endsection

@section('content')
    <div class="container-fluid">


        {{-- Statistiche Header --}}
        <div class="row mb-4" x-data>
            <div class="col-12">
                    <div class="row g-2">
                        <div class="col-md-2 col-sm-6">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Totale Manutenzioni
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ number_format($stats['total']) }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-truck fs-2 text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-6">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Totali in ditta
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ number_format($stats['totalInGarage']) }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-clock-history fs-2 text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-6">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Totali in officina
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ number_format($stats['totalInHome']) }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-arrow-right-circle fs-2 text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="card border-left-warning shadow h-100">
                            <div class="ps-2 card-title text-xs font-weight-bold text-warning text-uppercase">
                                Manutenzioni aperte
                            </div>
                            <div class="card-body p-1 h-100">
                                <div class="row no-gutters align-items-center">
                                    <div class="col m-0">
                                        <div class="mb-0 font-weight-bold ">
                                            <table class="table table-sm table-borderless m-0">
                                                <thead>
                                                    <tr class="text-center small text-warning">
                                                        <th class="text-warning">Oggi</th>
                                                        <th class="text-warning">Settimana</th>
                                                        <th class="text-warning">Mese</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="h5 text-center text-gray-800">
                                                        <td>{{ number_format($stats['totalOpen_today']) }}</td>
                                                        <td>{{ number_format($stats['totalOpen_week']) }}</td>
                                                        <td>{{ number_format($stats['totalOpen_month']) }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-arrow-right-circle fs-2 text-gray-300 me-2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="card border-left-dark shadow h-100">
                            <div class="ps-2 card-title text-xs font-weight-bold text-dark text-uppercase">
                                Manutenzioni chiuse
                            </div>
                            <div class="card-body p-1 h-100">
                                <div class="row no-gutters align-items-center">
                                    <div class="col m-0">
                                        <div class="mb-0 font-weight-bold text-gray-800">
                                            <table class="table table-sm table-borderless m-0">
                                                <thead>
                                                    <tr class="text-center small text-dark">
                                                        <th class="text-dark">Oggi</th>
                                                        <th class="text-dark">Settimana</th>
                                                        <th class="text-dark">Mese</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="h5 text-center text-gray-800">
                                                        <td>{{ number_format($stats['totalClosed_today']) }}</td>
                                                        <td>{{ number_format($stats['totalClosed_week']) }}</td>
                                                        <td>{{ number_format($stats['totalClosed_month']) }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-check-circle fs-2 text-gray-300 me-2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            {{-- </form> --}}
        </div>




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
                                        name="inprogress"
                                        label="Chiuse"
                                        check="{{old('inprogress', $inprogress)}}"
                                        enableCheck="true"
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
                                        {{-- <th class="col-1">Targa</th> --}}
                                        <th class="col-2">Tipo Manutenzione</th>
                                        <th class="col-1">Data Inizio</th>
                                        <th class="col-1">Data Fine</th>
                                        <th class="col-2">Officina</th>
                                        <th class="col-2">Assegnatario</th>
                                        {{-- <th class="col-1">Telefono</th> --}}
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
                                                    <span class="badge bg-warning text-dark w-100">
                                                            <i class="bi bi-clock"></i> In corso
                                                        </span>
                                                @else
                                                    <span class="badge bg-success">
                                                            <i class="bi bi-check-circle"></i> Completata
                                                        </span>
                                                @endif
                                            </td>
                                            <td>
                                                <div>
                                                    <a href="{{route('cars.show', $maintenance->car_id)}}"
                                                       class="text-decoration-none">
                                                        <strong>{{ $maintenance->car?->full_name }}</strong>
                                                    </a>
                                                    @if($maintenance->car?->carPlates->first())
                                                        <br>
                                                        <small class="text-muted">
                                                            <i class="bi bi-credit-card"></i> {{ $maintenance->car?->carPlates()->whereType('POLIZIA')->first()->name }}
                                                        </small>
                                                    @endif
                                                </div>
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
                                                <span data-bs-toggle="tooltip">

                                                <a href="{{route('offices.show', $maintenance->car?->carOffices?->first()?->id)}}"
                                                   class="text-decoration-none">
                                                    {{ $maintenance->car?->carOffices?->first()?->ente ?? '' }}
                                                    @if($maintenance->car?->carOffices?->first()?->name)
                                                        <br>
                                                        <small class="text-muted">{{ $maintenance->car?->carOffices?->first()?->name }}</small>
                                                    @endif
                                                </a>
                                                </span>
                                            </td>

                                            <td class="text-end">
                                                @if($isActive)
                                                    <x-action-table-button :item="$maintenance" :label="'Manutenzione'"
                                                                           itemRoute="maintenances"/>
                                                @else
                                                    <a data-bs-toggle="tooltip" title="Visualizza dati Manutenzione" class="ms-2"
                                                       href="{{ route('maintenances.show', $maintenance->id) }}"><i
                                                            class="bi bi-search"></i></a>
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