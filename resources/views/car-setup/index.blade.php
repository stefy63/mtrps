@extends('layouts.app')

@section('template_title')
    Allestimenti Veicoli
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                {{-- Statistiche --}}
                <div class="row mb-4">
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <h3 class="text-primary">{{ $stats['total'] }}</h3>
                                <p class="mb-0">Totale Allestimenti</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <h3 class="text-success">{{ $stats['active'] }}</h3>
                                <p class="mb-0">Allestimenti Attivi</p>
                            </div>
                        </div>
                    </div>
                    @foreach(array_slice($stats['by_category'], 0, 2, true) as $key => $count)
                        @if($count > 0)
                            <div class="col-md-3 col-sm-6 mb-3">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h3 class="text-{{ $categories[$key]['color'] }}">{{ $count }}</h3>
                                        <p class="mb-0">{{ $categories[$key]['name'] }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                <i class="bi bi-tools"></i> {{ __('Allestimenti Veicoli') }}
                            </span>

                            <div class="float-right">
                                <button class="btn btn-sm btn-secondary" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#filterCollapse" aria-expanded="false">
                                    <i class="bi bi-funnel"></i> Filtri
                                </button>
                                <a href="{{ route('car-setups.create') }}"
                                   class="btn btn-primary btn-sm float-right"
                                   data-bs-toggle="tooltip"
                                   data-bs-placement="top"
                                   title="Aggiungi Allestimento">
                                    <i class="bi bi-plus-circle"></i> {{ __('Nuovo') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Filtri --}}
                    <div class="collapse {{ request()->hasAny(['car_id', 'category', 'status', 'date_from', 'search']) ? 'show' : '' }}"
                         id="filterCollapse">
                        <div class="card-body bg-light">
                            <form method="GET" action="{{ route('car-setups.index') }}" class="row g-3">
                                <div class="col-md-3">
                                    <label for="car_id" class="form-label">Veicolo</label>
                                    <select name="car_id" id="car_id" class="form-select form-select-sm">
                                        <option value="">-- Tutti i veicoli --</option>
                                        @foreach($cars as $car)
                                            <option value="{{ $car->id }}"
                                                {{ request('car_id') == $car->id ? 'selected' : '' }}>
                                                {{ $car->name }}
                                                @if($car->carPlates->first())
                                                    ({{ $car->carPlates->first()->name }})
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label for="category" class="form-label">Categoria</label>
                                    <select name="category" id="category" class="form-select form-select-sm">
                                        <option value="">-- Tutte le categorie --</option>
                                        @foreach($categories as $key => $category)
                                            <option value="{{ $key }}"
                                                {{ request('category') == $key ? 'selected' : '' }}>
                                                {{ $category['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label for="status" class="form-label">Stato</label>
                                    <select name="status" id="status" class="form-select form-select-sm">
                                        <option value="">-- Tutti --</option>
                                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>
                                            Attivi
                                        </option>
                                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>
                                            Conclusi
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label for="date_from" class="form-label">Data Dal</label>
                                    <input type="date" name="date_from" id="date_from"
                                           class="form-control form-control-sm"
                                           value="{{ request('date_from') }}">
                                </div>

                                <div class="col-md-2">
                                    <label for="search" class="form-label">Ricerca</label>
                                    <input type="text" name="search" id="search"
                                           class="form-control form-control-sm"
                                           placeholder="Nome, descrizione..."
                                           value="{{ request('search') }}">
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="bi bi-search"></i> Filtra
                                    </button>
                                    <a href="{{ route('car-setups.index') }}" class="btn btn-secondary btn-sm">
                                        <i class="bi bi-x-circle"></i> Reset
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card-body">
                        @if($carSetups->isEmpty())
                            <div class="alert alert-info text-center">
                                <i class="bi bi-info-circle"></i>
                                Nessun allestimento trovato
                                @if(request()->hasAny(['car_id', 'category', 'status', 'date_from', 'search']))
                                    con i filtri applicati
                                @endif
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="thead">
                                        <tr>
                                            <th>
                                                <a href="{{ route('car-setups.index', array_merge(request()->all(), [
                                                    'sort' => 'date_from',
                                                    'direction' => request('sort') == 'date_from' && request('direction') == 'desc' ? 'asc' : 'desc'
                                                ])) }}">
                                                    Periodo
                                                    @if(request('sort') == 'date_from')
                                                        <i class="bi bi-arrow-{{ request('direction') == 'desc' ? 'down' : 'up' }}"></i>
                                                    @endif
                                                </a>
                                            </th>
                                            <th>
                                                <a href="{{ route('car-setups.index', array_merge(request()->all(), [
                                                    'sort' => 'car',
                                                    'direction' => request('sort') == 'car' && request('direction') == 'asc' ? 'desc' : 'asc'
                                                ])) }}">
                                                    Veicolo
                                                    @if(request('sort') == 'car')
                                                        <i class="bi bi-arrow-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i>
                                                    @endif
                                                </a>
                                            </th>
                                            <th>Allestimento</th>
                                            <th>Categoria</th>
                                            <th>Descrizione</th>
                                            <th>Stato</th>
                                            <th class="text-center">Durata</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($carSetups as $carSetup)
                                            <tr>
                                                <td>
                                                    <small class="text-muted">
                                                        {{ $carSetup->date_from->format('d/m/Y') }} -
                                                        {{ $carSetup->date_to ? $carSetup->date_to->format('d/m/Y') : 'Attivo' }}
                                                    </small>
                                                </td>
                                                <td>
                                                    @if($carSetup->car)
                                                        <x-item-link :href="route('cars.show', $carSetup->car->id)">
                                                            {{ $carSetup->car->name }}
                                                            @if($carSetup->car->carPlates->first())
                                                                <span class="badge bg-secondary">
                                                                    {{ $carSetup->car->carPlates->first()->name }}
                                                                </span>
                                                            @endif
                                                        </x-item-link>
                                                    @else
                                                        <span class="text-muted">N/D</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <x-item-link :href="route('car-setups.show', $carSetup->id)">
                                                        @if($carSetup->category_info)
                                                            <i class="bi bi-{{ $carSetup->category_info['icon'] }}
                                                               text-{{ $carSetup->category_info['color'] }}"></i>
                                                        @endif
                                                        {{ $carSetup->name }}
                                                    </x-item-link>
                                                </td>
                                                <td>
                                                    @if($carSetup->category_info)
                                                        <span class="badge bg-{{ $carSetup->category_info['color'] }}">
                                                            {{ $carSetup->category_info['name'] }}
                                                        </span>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ Str::limit($carSetup->description, 50) }}
                                                </td>
                                                <td>
                                                    @if($carSetup->is_active)
                                                        <span class="badge bg-success">
                                                            <i class="bi bi-check-circle"></i> Attivo
                                                        </span>
                                                    @else
                                                        <span class="badge bg-secondary">
                                                            <i class="bi bi-x-circle"></i> Concluso
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if($carSetup->duration_days !== null)
                                                        <small>{{ $carSetup->duration_days }} giorni</small>
                                                    @else
                                                        <small class="text-muted">-</small>
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    <div class="btn-group" role="group">
                                                        <a class="btn btn-sm btn-primary"
                                                           href="{{ route('car-setups.show', $carSetup->id) }}"
                                                           data-bs-toggle="tooltip"
                                                           title="Visualizza">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <a class="btn btn-sm btn-success"
                                                           href="{{ route('car-setups.edit', $carSetup->id) }}"
                                                           data-bs-toggle="tooltip"
                                                           title="Modifica">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                        <form action="{{ route('car-setups.destroy', $carSetup->id) }}"
                                                              method="POST"
                                                              style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    class="btn btn-danger btn-sm"
                                                                    data-confirm-delete="true"
                                                                    data-bs-toggle="tooltip"
                                                                    title="Elimina">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="mt-3">
                    {!! $carSetups->withQueryString()->links() !!}
                </div>
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
