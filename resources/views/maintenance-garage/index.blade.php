@extends('layouts.app')

@section('template_title')
    Officine
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                <i class="bi bi-building"></i> {{ __('Officine') }}
                            </span>

                            <div class="float-right">
                                <button class="btn btn-sm btn-outline-secondary me-2" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse">
                                    <i class="bi bi-funnel"></i> Filtri
                                </button>
                                <a href="{{ route('maintenance-garages.create') }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus"></i> {{ __('Nuova Officina') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Filtri collassabili -->
                    <div class="collapse" id="filterCollapse">
                        <div class="card-body bg-light">
                            <form method="GET" action="{{ route('maintenance-garages.index') }}" class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label">Manutenzione</label>
                                    <select name="maintenance_id" class="form-select">
                                        <option value="">Tutte le manutenzioni</option>
                                        @foreach($maintenances as $maintenance)
                                            <option value="{{ $maintenance->id }}" {{ request('maintenance_id') == $maintenance->id ? 'selected' : '' }}>
                                                {{ $maintenance->car->name }} - {{ $maintenance->name }}
                                                ({{ $maintenance->date_from->format('d/m/Y') }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Accreditamento</label>
                                    <select name="acc" class="form-select">
                                        <option value="">Tutti</option>
                                        <option value="yes" {{ request('acc') == 'yes' ? 'selected' : '' }}>Accreditate</option>
                                        <option value="no" {{ request('acc') == 'no' ? 'selected' : '' }}>Non accreditate</option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Antimafia</label>
                                    <select name="anti_mafia" class="form-select">
                                        <option value="">Tutte</option>
                                        <option value="yes" {{ request('anti_mafia') == 'yes' ? 'selected' : '' }}>Con certificazione</option>
                                        <option value="no" {{ request('anti_mafia') == 'no' ? 'selected' : '' }}>Senza certificazione</option>
                                    </select>
                                </div>

                                <div class="col-md-5">
                                    <label class="form-label">Cerca</label>
                                    <input type="text" name="search" class="form-control" placeholder="Nome, P.IVA, CF, PEC..." value="{{ request('search') }}">
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-search"></i> Applica Filtri
                                    </button>
                                    <a href="{{ route('maintenance-garages.index') }}" class="btn btn-secondary">
                                        <i class="bi bi-x-circle"></i> Cancella
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card-body">
                        @if(count($maintenanceGarages) > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="thead">
                                        <tr>
                                            <th>Officina</th>
                                            <th>P.IVA / CF</th>
                                            <th>PEC</th>
                                            <th>Certificazioni</th>
                                            <th>DURC</th>
                                            <th>Manutenzione</th>
                                            <th>Veicolo</th>
                                            <th>CIG</th>
                                            <th width="120"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($maintenanceGarages as $garage)
                                            <tr>
                                                <td>
                                                    <strong>{{ $garage->name }}</strong>
                                                    @if($garage->description)
                                                        <br><small class="text-muted">{{ Str::limit($garage->description, 30) }}</small>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($garage->piva)
                                                        <small>P.IVA: {{ $garage->piva }}</small>
                                                    @endif
                                                    @if($garage->cf)
                                                        <br><small>CF: {{ $garage->cf }}</small>
                                                    @endif
                                                    @if(!$garage->piva && !$garage->cf)
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($garage->pec)
                                                        <small>{{ $garage->pec }}</small>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        @if($garage->acc == 'yes')
                                                            <span class="badge bg-success" data-bs-toggle="tooltip" title="Accreditata">
                                                                <i class="bi bi-check-circle"></i> ACC
                                                            </span>
                                                        @else
                                                            <span class="badge bg-secondary" data-bs-toggle="tooltip" title="Non accreditata">
                                                                <i class="bi bi-x-circle"></i> ACC
                                                            </span>
                                                        @endif

                                                        @if($garage->anti_mafia == 'yes')
                                                            <span class="badge bg-success" data-bs-toggle="tooltip" title="Certificazione Antimafia">
                                                                <i class="bi bi-shield-check"></i> AM
                                                            </span>
                                                        @else
                                                            <span class="badge bg-secondary" data-bs-toggle="tooltip" title="Senza Certificazione Antimafia">
                                                                <i class="bi bi-shield-x"></i> AM
                                                            </span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    @if($garage->durc)
                                                        @php
                                                            $durcDate = \Carbon\Carbon::parse($garage->durc);
                                                            $isExpired = $durcDate->isPast();
                                                            $isExpiringSoon = $durcDate->isBetween(now(), now()->addDays(30));
                                                        @endphp
                                                        <span class="badge bg-{{ $isExpired ? 'danger' : ($isExpiringSoon ? 'warning' : 'success') }}">
                                                            {{ $durcDate->format('d/m/Y') }}
                                                        </span>
                                                        @if($isExpired)
                                                            <br><small class="text-danger">Scaduto</small>
                                                        @elseif($isExpiringSoon)
                                                            <br><small class="text-warning">In scadenza</small>
                                                        @endif
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <small>{{ $garage->maintenance->name }}</small>
                                                    <br><small class="text-muted">{{ $garage->maintenance->date_from->format('d/m/Y') }}</small>
                                                </td>
                                                <td>
                                                    <small>{{ $garage->maintenance->car->name }}</small>
                                                    @if($garage->maintenance->car->carPlates->count() > 0)
                                                        <br><span class="badge bg-primary">{{ $garage->maintenance->car->carPlates->first()->name }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($garage->cigs->count() > 0)
                                                        <span class="badge bg-info">
                                                            {{ $garage->cigs->count() }}
                                                        </span>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    <div class="btn-group dropstart">
                                                        <button type="button" class="btn btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bi bi-three-dots-vertical"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item" href="{{ route('maintenance-garages.show', $garage->id) }}">
                                                                    <i class="bi bi-eye"></i> {{ __('Visualizza') }}
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="{{ route('maintenance-garages.edit', $garage->id) }}">
                                                                    <i class="bi bi-pencil"></i> {{ __('Modifica') }}
                                                                </a>
                                                            </li>
                                                            <li><hr class="dropdown-divider"></li>
                                                            <li>
                                                                <a class="dropdown-item" href="{{ route('cigs.create', ['maintenance_garage_id' => $garage->id]) }}">
                                                                    <i class="bi bi-file-earmark-text"></i> {{ __('Aggiungi CIG') }}
                                                                </a>
                                                            </li>
                                                            <li><hr class="dropdown-divider"></li>
                                                            <li>
                                                                <form action="{{ route('maintenance-garages.destroy', $garage->id) }}" method="POST">
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
                                <i class="bi bi-info-circle"></i> Nessuna officina registrata.
                                <a href="{{ route('maintenance-garages.create') }}" class="alert-link">Registra la prima officina</a>
                            </div>
                        @endif
                    </div>
                </div>

                @if($maintenanceGarages->hasPages())
                    <div class="mt-3">
                        {!! $maintenanceGarages->withQueryString()->links() !!}
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
