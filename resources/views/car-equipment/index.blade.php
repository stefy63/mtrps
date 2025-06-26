@extends('layouts.app')

@section('template_title')
    Equipaggiamenti Veicoli
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Equipaggiamenti Veicoli') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('car-equipments.create') }}" class="btn btn-primary btn-sm float-right"
                                   data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Nuovo Equipaggiamento') }}">
                                    <i class="bi bi-plus-circle"></i> {{ __('Nuovo') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {{-- Filtri --}}
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <form method="GET" action="{{ route('car-equipments.index') }}" id="filter-form">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control"
                                               placeholder="Cerca equipaggiamento o targa..."
                                               value="{{ request('search') }}">
                                        <button class="btn btn-outline-secondary" type="submit">
                                            <i class="bi bi-search"></i>
                                        </button>
                                    </div>
                            </div>

                            <div class="col-md-3">
                                <select name="car_id" class="form-select" onchange="document.getElementById('filter-form').submit()">
                                    <option value="">-- Tutti i veicoli --</option>
                                    @foreach($cars as $car)
                                        @php
                                            $plate = $car->carPlates->first();
                                            $plateName = $plate ? " ({$plate->name})" : '';
                                        @endphp
                                        <option value="{{ $car->id }}"
                                                {{ request('car_id') == $car->id ? 'selected' : '' }}>
                                            {{ $car->name }}{{ $plateName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <select name="status" class="form-select" onchange="document.getElementById('filter-form').submit()">
                                    <option value="">-- Tutti gli stati --</option>
                                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>
                                        Solo installati
                                    </option>
                                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>
                                        Solo rimossi
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                @if(request()->hasAny(['search', 'car_id', 'status']))
                                    <a href="{{ route('car-equipments.index') }}" class="btn btn-outline-danger w-100">
                                        <i class="bi bi-x-circle"></i> Reset
                                    </a>
                                @endif
                            </div>
                                </form>
                        </div>

                        {{-- Statistiche rapide --}}
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <div class="card bg-primary text-white">
                                    <div class="card-body p-2 text-center">
                                        <h6 class="mb-0">Totale Equipaggiamenti</h6>
                                        <h4 class="mb-0">{{ $carEquipments->total() }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-success text-white">
                                    <div class="card-body p-2 text-center">
                                        <h6 class="mb-0">Installati</h6>
                                        <h4 class="mb-0">{{ $carEquipments->filter(fn($e) => $e->is_active)->count() }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-secondary text-white">
                                    <div class="card-body p-2 text-center">
                                        <h6 class="mb-0">Rimossi</h6>
                                        <h4 class="mb-0">{{ $carEquipments->filter(fn($e) => !$e->is_active)->count() }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-info text-white">
                                    <div class="card-body p-2 text-center">
                                        <h6 class="mb-0">Veicoli Equipaggiati</h6>
                                        <h4 class="mb-0">{{ $carEquipments->pluck('car_id')->unique()->count() }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Tipo</th>
                                        <th>Equipaggiamento</th>
                                        <th>Veicolo</th>
                                        <th>Installazione</th>
                                        <th>Rimozione</th>
                                        <th>Stato</th>
                                        <th>Durata</th>
                                        <th>Note</th>
                                        <th class="text-end">Azioni</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($carEquipments as $equipment)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>
                                                <i class="bi {{ $equipment->getCategoryIcon() }}"
                                                   data-bs-toggle="tooltip"
                                                   title="{{ ucfirst($equipment->getCategory()) }}"></i>
                                            </td>
                                            <td>
                                                <strong>{{ $equipment->name }}</strong>
                                                @if($equipment->description)
                                                    <br>
                                                    <small class="text-muted">{{ $equipment->description }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                @if($equipment->car)
                                                    @php
                                                        $currentPlate = $equipment->car->carPlates->first();
                                                    @endphp
                                                    <a href="{{ route('cars.show', $equipment->car->id) }}"
                                                       class="text-decoration-none">
                                                        @if($currentPlate)
                                                            <span class="badge bg-primary">{{ $currentPlate->name }}</span>
                                                        @endif
                                                        {{ $equipment->car->name }}
                                                    </a>
                                                    @if($equipment->car->carBrand)
                                                        <br>
                                                        <small class="text-muted">
                                                            {{ $equipment->car->carBrand->name }}
                                                            {{ $equipment->car->model }}
                                                        </small>
                                                    @endif
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $equipment->date_from->format('d/m/Y') }}
                                            </td>
                                            <td>
                                                @if($equipment->date_to)
                                                    {{ $equipment->date_to->format('d/m/Y') }}
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                {!! $equipment->status_badge !!}
                                            </td>
                                            <td>
                                                @if($equipment->duration_days !== null)
                                                    @if($equipment->duration_days > 365)
                                                        {{ round($equipment->duration_days / 365, 1) }} anni
                                                    @elseif($equipment->duration_days > 30)
                                                        {{ round($equipment->duration_days / 30, 1) }} mesi
                                                    @else
                                                        {{ $equipment->duration_days }} giorni
                                                    @endif
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if($equipment->note)
                                                    <span data-bs-toggle="tooltip"
                                                          title="{{ $equipment->note }}">
                                                        {{ Str::limit($equipment->note, 20) }}
                                                    </span>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <div class="btn-group dropstart">
                                                    <button type="button" class="btn btn-sm dropdown-toggle"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item"
                                                               href="{{ route('car-equipments.show', $equipment->id) }}">
                                                                <i class="bi bi-eye"></i> {{ __('Visualizza') }}
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item"
                                                               href="{{ route('car-equipments.edit', $equipment->id) }}">
                                                                <i class="bi bi-pencil"></i> {{ __('Modifica') }}
                                                            </a>
                                                        </li>
                                                        @if($equipment->is_active && !$equipment->date_to)
                                                            <li>
                                                                <a class="dropdown-item text-warning"
                                                                   href="{{ route('car-equipments.edit', $equipment->id) }}">
                                                                    <i class="bi bi-x-square"></i> {{ __('Rimuovi') }}
                                                                </a>
                                                            </li>
                                                        @endif
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li>
                                                            <form action="{{ route('car-equipments.destroy', $equipment->id) }}"
                                                                  method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item text-danger"
                                                                        data-confirm-delete="true">
                                                                    <i class="bi bi-trash"></i> {{ __('Elimina') }}
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center py-4">
                                                <p class="mb-0">Nessun equipaggiamento trovato.</p>
                                                <a href="{{ route('car-equipments.create') }}" class="btn btn-primary btn-sm mt-2">
                                                    <i class="bi bi-plus-circle"></i> Aggiungi il primo equipaggiamento
                                                </a>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    {!! $carEquipments->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Inizializza i tooltip
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
</script>
@endsection
