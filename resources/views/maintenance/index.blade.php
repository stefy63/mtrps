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
                                <button class="btn btn-sm btn-outline-secondary me-2" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse">
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
                                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>In corso</option>
                                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completate</option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Data dal</label>
                                    <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Data al</label>
                                    <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Cerca</label>
                                    <input type="text" name="search" class="form-control" placeholder="Cerca..." value="{{ request('search') }}">
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
                                            <th>Descrizione</th>
                                            <th>Data Inizio</th>
                                            <th>Data Fine</th>
                                            <th>Durata</th>
                                            <th>Officine</th>
                                            <th>Note</th>
                                            <th width="120"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($maintenances as $maintenance)
                                            @php
                                                $isActive = !$maintenance->date_to || $maintenance->date_to >= now();
                                                $duration = $maintenance->date_to
                                                    ? $maintenance->date_from->diffInDays($maintenance->date_to) + 1
                                                    : $maintenance->date_from->diffInDays(now()) + 1;
                                            @endphp
                                            <tr>
                                                <td>
                                                    @if($isActive)
                                                        <span class="badge bg-warning text-dark">
                                                            <i class="bi bi-clock"></i> In corso
                                                        </span>
                                                    @else
                                                        <span class="badge bg-success">
                                                            <i class="bi bi-check-circle"></i> Completata
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <strong>{{ $maintenance->car->name }}</strong>
                                                    @if($maintenance->car->carBrand)
                                                        <br><small class="text-muted">{{ $maintenance->car->carBrand->name }}</small>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($maintenance->car->carPlates->count() > 0)
                                                        <span class="badge bg-primary">{{ $maintenance->car->carPlates->first()->name }}</span>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <strong>{{ $maintenance->name }}</strong>
                                                </td>
                                                <td>
                                                    @if($maintenance->description)
                                                        <small>{{ Str::limit($maintenance->description, 40) }}</small>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
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
                                                    @if($maintenance->maintenanceGarages->count() > 0)
                                                        <span class="badge bg-info">
                                                            {{ $maintenance->maintenanceGarages->count() }}
                                                        </span>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($maintenance->note)
                                                        <small data-bs-toggle="tooltip" title="{{ $maintenance->note }}">
                                                            {{ Str::limit($maintenance->note, 20) }}
                                                        </small>
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
                                                                <a class="dropdown-item" href="{{ route('maintenances.show', $maintenance->id) }}">
                                                                    <i class="bi bi-eye"></i> {{ __('Visualizza') }}
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="{{ route('maintenances.edit', $maintenance->id) }}">
                                                                    <i class="bi bi-pencil"></i> {{ __('Modifica') }}
                                                                </a>
                                                            </li>
                                                            <li><hr class="dropdown-divider"></li>
                                                            <li>
                                                                <a class="dropdown-item" href="{{ route('maintenance-garages.create', ['maintenance_id' => $maintenance->id]) }}">
                                                                    <i class="bi bi-building"></i> {{ __('Aggiungi Officina') }}
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="{{ route('maintenance-types.create', ['maintenance_id' => $maintenance->id]) }}">
                                                                    <i class="bi bi-tools"></i> {{ __('Aggiungi Tipo Intervento') }}
                                                                </a>
                                                            </li>
                                                            <li><hr class="dropdown-divider"></li>
                                                            <li>
                                                                <form action="{{ route('maintenances.destroy', $maintenance->id) }}" method="POST">
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
                                <i class="bi bi-info-circle"></i> Nessuna manutenzione registrata.
                                <a href="{{ route('maintenances.create') }}" class="alert-link">Registra la prima manutenzione</a>
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
