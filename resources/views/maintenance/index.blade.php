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
                                <button class="btn btn-sm btn-outline-secondary me-2" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#filterCollapse">
                                    <i class="bi bi-funnel"></i> Filtri
                                </button>
                                <a href="{{ route('maintenances.create') }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus"></i> {{ __('Nuova Manutenzione') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Filtri collassabili -->
                    <div class="collapse" id="filterCollapse">
                        <div class="card-body bg-light">
                            <form method="GET" action="{{ route('maintenances.index') }}" class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label">Veicolo</label>
                                    <select name="car_id" class="form-select">
                                        <option value="">Tutti i veicoli</option>
                                        @foreach($cars as $car)
                                            <option value="{{ $car->id }}" {{ request('car_id') == $car->id ? 'selected' : '' }}>
                                                {{ $car->name }}
                                                @if($car->carPlates->count() > 0)
                                                    - {{ $car->carPlates->first()->name }}
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Stato</label>
                                    <select name="status" class="form-select">
                                        <option value="">Tutti gli stati</option>
                                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>In
                                            corso
                                        </option>
                                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>
                                            Completate
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Data dal</label>
                                    <input type="date" name="date_from" class="form-control"
                                           value="{{ request('date_from') }}">
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Data al</label>
                                    <input type="date" name="date_to" class="form-control"
                                           value="{{ request('date_to') }}">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Cerca</label>
                                    <input type="text" name="search" class="form-control" placeholder="Cerca..."
                                           value="{{ request('search') }}">
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-search"></i> Applica Filtri
                                    </button>
                                    <a href="{{ route('maintenances.index') }}" class="btn btn-secondary">
                                        <i class="bi bi-x-circle"></i> Cancella
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card-body">
                        @if(count($maintenances) > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="thead">
                                    <tr>
                                        <th>Stato</th>
                                        <th>Veicolo</th>
                                        <th>Targa</th>
                                        <th>Tipo Manutenzione</th>
                                        <th>Data Inizio</th>
                                        <th>Data Fine</th>
                                        <th>Durata</th>
                                        <th>Officina</th>
                                        <th>Telefono</th>
                                        <th width="120"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($maintenances as $maintenance)
                                        @php
                                            $isActive = !$maintenance->date_to || $maintenance->date_to >= now();
                                            $duration = $maintenance->date_to
                                                ? $maintenance->date_from->diff($maintenance->date_to)->days
                                                : $maintenance->date_from->diff(now())->days;
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
                                            <td>
                                                <strong>{{ $maintenance->car->carType->name }}</strong>
                                                @if($maintenance->car->carBrand)
                                                    <br><small
                                                            class="text-muted">{{ $maintenance->car->carBrand->name }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                @if($maintenance->car->carPlates->count() > 0)
                                                    <span class="badge bg-primary w-75">{{ $maintenance->car->carPlates->first()->name }}</span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                <strong>{{ $maintenance->maintenanceTypes->name }}</strong>
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
                                            <td>
                                                <span class="badge bg-secondary">
                                                    {{ $duration }} {{ $duration == 1 ? 'giorno' : 'giorni' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-info w-100">
                                                    {{ $maintenance->maintenanceGarages->name }}
                                                </span>
                                            </td>
                                            <td>
{{--                                                @if($maintenance->note)--}}
                                                    <small data-bs-toggle="tooltip" title="{{ $maintenance->phone }}">
                                                        {{$maintenance->phone }}
                                                    </small>
{{--                                                @else--}}
{{--                                                    <span class="text-muted">-</span>--}}
{{--                                                @endif--}}
                                            </td>
                                            <td class="text-end">
                                                <x-action-table-button :item="$maintenance" :label="'Manutenzione'"  itemRoute="maintenances" />
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
