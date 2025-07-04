@extends('layouts.app')

@section('template_title')
    Tipi di Intervento
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                <i class="bi bi-tools"></i> {{ __('Tipi di Intervento') }}
                            </span>

                            <div class="float-right">
                                <button class="btn btn-sm btn-outline-secondary me-2" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse">
                                    <i class="bi bi-funnel"></i> Filtri
                                </button>
                                <a href="{{ route('maintenance-types.create') }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus"></i> {{ __('Nuovo Tipo Intervento') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Filtri collassabili -->
                    <div class="collapse" id="filterCollapse">
                        <div class="card-body bg-light">
                            <form method="GET" action="{{ route('maintenance-types.index') }}" class="row g-3">
                                <div class="col-md-6">
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

                                <div class="col-md-6">
                                    <label class="form-label">Cerca</label>
                                    <input type="text" name="search" class="form-control" placeholder="Tipo intervento, descrizione..." value="{{ request('search') }}">
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-search"></i> Applica Filtri
                                    </button>
                                    <a href="{{ route('maintenance-types.index') }}" class="btn btn-secondary">
                                        <i class="bi bi-x-circle"></i> Cancella
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card-body">
                        @if(count($maintenanceTypes) > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="thead">
                                        <tr>
                                            <th>Tipo Intervento</th>
                                            <th>Categoria</th>
                                            <th>Descrizione</th>
                                            <th>Manutenzione</th>
                                            <th>Veicolo</th>
                                            <th>Data</th>
                                            <th>Note</th>
                                            <th width="120"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($maintenanceTypes as $type)
                                            @php
                                                $category = 'Altro';
                                                $categoryIcon = 'wrench';
                                                $categoryColor = 'secondary';

                                                $name = strtolower($type->name);

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
                                            <tr>
                                                <td>
                                                    <strong>{{ $type->name }}</strong>
                                                </td>
                                                <td>
                                                    <span class="badge bg-{{ $categoryColor }}">
                                                        <i class="bi bi-{{ $categoryIcon }}"></i> {{ $category }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if($type->description)
                                                        <small>{{ Str::limit($type->description, 40) }}</small>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <small>{{ $type->maintenance->name }}</small>
                                                </td>
                                                <td>
                                                    <small>{{ $type->maintenance->car->name }}</small>
                                                    @if($type->maintenance->car->carPlates->count() > 0)
                                                        <br><span class="badge bg-primary">{{ $type->maintenance->car->carPlates->first()->name }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <small>{{ $type->maintenance->date_from->format('d/m/Y') }}</small>
                                                </td>
                                                <td>
                                                    @if($type->note)
                                                        <small data-bs-toggle="tooltip" title="{{ $type->note }}">
                                                            {{ Str::limit($type->note, 20) }}
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
                                                                <a class="dropdown-item" href="{{ route('maintenance-types.show', $type->id) }}">
                                                                    <i class="bi bi-eye"></i> {{ __('Visualizza') }}
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="{{ route('maintenance-types.edit', $type->id) }}">
                                                                    <i class="bi bi-pencil"></i> {{ __('Modifica') }}
                                                                </a>
                                                            </li>
                                                            <li><hr class="dropdown-divider"></li>
                                                            <li>
                                                                <form action="{{ route('maintenance-types.destroy', $type->id) }}" method="POST">
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
                                <i class="bi bi-info-circle"></i> Nessun tipo di intervento registrato.
                                <a href="{{ route('maintenance-types.create') }}" class="alert-link">Registra il primo tipo di intervento</a>
                            </div>
                        @endif
                    </div>
                </div>

                @if($maintenanceTypes->hasPages())
                    <div class="mt-3">
                        {!! $maintenanceTypes->withQueryString()->links() !!}
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
