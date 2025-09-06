@extends('layouts.app')

@section('template_title')
    CIG - Codici Identificativi Gara
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                <i class="bi bi-file-earmark-text"></i> {{ __('CIG - Codici Identificativi Gara') }}
                            </span>

                            <div class="float-right">
                                <button class="btn btn-sm btn-outline-secondary me-2" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse">
                                    <i class="bi bi-funnel"></i> Filtri
                                </button>
                                <a href="{{ route('cigs.create') }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus"></i> {{ __('Nuovo CIG') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Totali -->
                    <div class="card-header bg-light">
                        <div class="row text-center">
                            <div class="col-md-3">
                                <h6 class="mb-0">Totale CIG</h6>
                                <h4 class="mb-0 text-primary">{{ $totals['count'] }}</h4>
                            </div>
                            <div class="col-md-3">
                                <h6 class="mb-0">Imponibile Totale</h6>
                                <h4 class="mb-0 text-success">€ {{ number_format($totals['taxable'], 2, ',', '.') }}</h4>
                            </div>
                            <div class="col-md-3">
                                <h6 class="mb-0">IVA Totale</h6>
                                <h4 class="mb-0 text-info">€ {{ number_format($totals['vat'], 2, ',', '.') }}</h4>
                            </div>
                            <div class="col-md-3">
                                <h6 class="mb-0">Totale Complessivo</h6>
                                <h4 class="mb-0 text-danger">€ {{ number_format($totals['total'], 2, ',', '.') }}</h4>
                            </div>
                        </div>
                    </div>

                    <!-- Filtri collassabili -->
                    <div class="collapse" id="filterCollapse">
                        <div class="card-body bg-light">
                            <form method="GET" action="{{ route('cigs.index') }}" class="row g-3">
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

                                <div class="col-md-3">
                                    <label class="form-label">Officina</label>
                                    <select name="maintenance_garage_id" class="form-select">
                                        <option value="">Tutte le officine</option>
                                        @foreach($garages as $garage)
                                            <option value="{{ $garage->id }}" {{ request('maintenance_garage_id') == $garage->id ? 'selected' : '' }}>
                                                {{ $garage->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Anno</label>
                                    <select name="year" class="form-select">
                                        <option value="">Tutti gli anni</option>
                                        @foreach($years as $year)
                                            <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Cerca</label>
                                    <input type="text" name="search" class="form-control" placeholder="CIG, CE, descrizione..." value="{{ request('search') }}">
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-search"></i> Applica Filtri
                                    </button>
                                    <a href="{{ route('cigs.index') }}" class="btn btn-secondary">
                                        <i class="bi bi-x-circle"></i> Cancella
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card-body">
                        @if(count($cigs) > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="thead">
                                        <tr>
                                            <th>CIG</th>
                                            <th>Data</th>
                                            <th>Veicolo</th>
                                            <th>Officina</th>
                                            <th>Descrizione</th>
                                            <th>Importi</th>
                                            <th>RUP</th>
                                            <th>Documenti</th>
                                            <th width="120"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cigs as $cig)
                                            <tr>
                                                <td>
                                                    <strong class="text-primary">{{ $cig->cig }}</strong>
                                                    @if($cig->ce)
                                                        <br><small class="text-muted">CE: {{ $cig->ce }}</small>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($cig->date)
                                                        {{ $cig->date->format('d/m/Y') }}
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <small>{{ $cig->car->name }}</small>
                                                    @if($cig->car->carPlates->count() > 0)
                                                        <br><span class="badge bg-primary">{{ $cig->car->carPlates->first()->name }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <small>{{ $cig->maintenanceGarage->name }}</small>
                                                    @if($cig->maintenanceGarage->piva)
                                                        <br><small class="text-muted">P.IVA: {{ $cig->maintenanceGarage->piva }}</small>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($cig->description)
                                                        <small>{{ Str::limit($cig->description, 50) }}</small>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($cig->taxable)
                                                        <small>Imp: € {{ number_format($cig->taxable, 2, ',', '.') }}</small><br>
                                                        <small>IVA: € {{ number_format($cig->vat, 2, ',', '.') }}</small><br>
                                                        <strong>Tot: € {{ number_format($cig->taxable + $cig->vat, 2, ',', '.') }}</strong>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($cig->userRup)
                                                        <small><strong>RUP:</strong> {{ $cig->userRup->name }}</small>
                                                    @endif
                                                    @if($cig->userSupport)
                                                        <br><small>Supp: {{ $cig->userSupport->name }}</small>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        @if($cig->preventive)
                                                            <span class="badge bg-info" data-bs-toggle="tooltip" title="Preventivo">
                                                                <i class="bi bi-file-earmark-text"></i> P
                                                            </span>
                                                        @endif
                                                        @if($cig->final_report)
                                                            <span class="badge bg-success" data-bs-toggle="tooltip" title="Relazione Finale">
                                                                <i class="bi bi-file-earmark-check"></i> RF
                                                            </span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <div class="btn-group dropstart">
                                                        <button type="button" class="btn btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bi bi-three-dots-vertical"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item" href="{{ route('cigs.show', $cig->id) }}">
                                                                    <i class="bi bi-eye"></i> {{ __('Visualizza') }}
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="{{ route('cigs.edit', $cig->id) }}">
                                                                    <i class="bi bi-pencil"></i> {{ __('Modifica') }}
                                                                </a>
                                                            </li>
                                                            <li><hr class="dropdown-divider"></li>
                                                            <li>
                                                                <form action="{{ route('cigs.destroy', $cig->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item text-danger" data-confirm-delete="true">
                                                                        <i class="bi bi-trash"></i> {{ __('Elimina') }}
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle"></i> Nessun CIG registrato.
                                <a href="{{ route('cigs.create') }}" class="alert-link">Registra il primo CIG</a>
                            </div>
                        @endif
                    </div>
                </div>

                @if($cigs->hasPages())
                    <div class="mt-3">
                        {!! $cigs->withQueryString()->links() !!}
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
