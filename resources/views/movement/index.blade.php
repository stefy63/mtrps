@extends('layouts.app')

@section('template_title')
    Movimenti Veicoli
@endsection

@section('content')
    <div class="container-fluid">
        {{-- Statistiche Header --}}
{{--        <div class="row mb-4">--}}
{{--            <div class="col-12">--}}
{{--                <div class="row g-3">--}}
{{--                    <div class="col-md-2 col-sm-6">--}}
{{--                        <div class="card border-left-primary shadow h-100 py-2">--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="row no-gutters align-items-center">--}}
{{--                                    <div class="col mr-2">--}}
{{--                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">--}}
{{--                                            Totali--}}
{{--                                        </div>--}}
{{--                                        <div class="h5 mb-0 font-weight-bold text-gray-800">--}}
{{--                                            {{ number_format($stats['total']) }}--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-auto">--}}
{{--                                        <i class="bi bi-truck fs-2 text-gray-300"></i>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="col-md-2 col-sm-6">--}}
{{--                        <div class="card border-left-warning shadow h-100 py-2">--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="row no-gutters align-items-center">--}}
{{--                                    <div class="col mr-2">--}}
{{--                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">--}}
{{--                                            In Attesa--}}
{{--                                        </div>--}}
{{--                                        <div class="h5 mb-0 font-weight-bold text-gray-800">--}}
{{--                                            {{ number_format($stats['pending']) }}--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-auto">--}}
{{--                                        <i class="bi bi-clock-history fs-2 text-gray-300"></i>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="col-md-2 col-sm-6">--}}
{{--                        <div class="card border-left-info shadow h-100 py-2">--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="row no-gutters align-items-center">--}}
{{--                                    <div class="col mr-2">--}}
{{--                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">--}}
{{--                                            In Corso--}}
{{--                                        </div>--}}
{{--                                        <div class="h5 mb-0 font-weight-bold text-gray-800">--}}
{{--                                            {{ number_format($stats['in_progress']) }}--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-auto">--}}
{{--                                        <i class="bi bi-arrow-right-circle fs-2 text-gray-300"></i>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="col-md-3 col-sm-6">--}}
{{--                        <div class="card border-left-success shadow h-100 py-2">--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="row no-gutters align-items-center">--}}
{{--                                    <div class="col mr-2">--}}
{{--                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">--}}
{{--                                            Completati ({{ now()->format('F') }})--}}
{{--                                        </div>--}}
{{--                                        <div class="h5 mb-0 font-weight-bold text-gray-800">--}}
{{--                                            {{ number_format($stats['completed_month']) }}--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-auto">--}}
{{--                                        <i class="bi bi-check-circle fs-2 text-gray-300"></i>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="col-md-3 col-sm-6">--}}
{{--                        <div class="card border-left-dark shadow h-100 py-2">--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="row no-gutters align-items-center">--}}
{{--                                    <div class="col mr-2">--}}
{{--                                        <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">--}}
{{--                                            KM Totali ({{ now()->format('F') }})--}}
{{--                                        </div>--}}
{{--                                        <div class="h5 mb-0 font-weight-bold text-gray-800">--}}
{{--                                            {{ number_format($stats['total_km_month']) }} km--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-auto">--}}
{{--                                        <i class="bi bi-speedometer2 fs-2 text-gray-300"></i>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        {{-- Main Card --}}
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Movimenti Veicoli') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('movements.create') }}" class="btn btn-primary btn-sm float-right" data-bs-toggle="tooltip" data-bs-placement="top" title="Nuovo Movimento">
                                    <i class="bi bi-plus-circle"></i> {{ __('Nuovo Movimento') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {{-- Filtri --}}
                        <div class="row mb-3">
                            <div class="col-12">
                                <form method="GET" action="{{ route('movements.index') }}" class="row g-3">
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="text"
                                                   name="search"
                                                   class="form-control"
                                                   id="search"
                                                   placeholder="Cerca..."
                                                   value="{{ request('search') }}">
                                            <label for="search">Cerca (codice, targa, destinazione)</label>
                                        </div>
                                    </div>

{{--                                    <div class="col-md-2">--}}
{{--                                        <div class="form-floating">--}}
{{--                                            <select name="car_id" class="form-select" id="car_id">--}}
{{--                                                <option value="">Tutti i veicoli</option>--}}
{{--                                                @foreach($cars as $car)--}}
{{--                                                    <option value="{{ $car->id }}" {{ request('car_id') == $car->id ? 'selected' : '' }}>--}}
{{--                                                        {{ $car->name }}--}}
{{--                                                        @if($car->carPlates->first())--}}
{{--                                                            ({{ $car->carPlates->first()->name }})--}}
{{--                                                        @endif--}}
{{--                                                    </option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                            <label for="car_id">Veicolo</label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="col-md-2">--}}
{{--                                        <div class="form-floating">--}}
{{--                                            <select name="driver_id" class="form-select" id="driver_id">--}}
{{--                                                <option value="">Tutti i conducenti</option>--}}
{{--                                                @foreach($drivers as $driver)--}}
{{--                                                    <option value="{{ $driver->id }}" {{ request('driver_id') == $driver->id ? 'selected' : '' }}>--}}
{{--                                                        {{ $driver->name }}--}}
{{--                                                    </option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                            <label for="driver_id">Conducente</label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="col-md-1">--}}
{{--                                        <div class="form-floating">--}}
{{--                                            <select name="status" class="form-select" id="status">--}}
{{--                                                <option value="">Tutti</option>--}}
{{--                                                @foreach($statuses as $key => $label)--}}
{{--                                                    <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>--}}
{{--                                                        {{ $label }}--}}
{{--                                                    </option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                            <label for="status">Stato</label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="col-md-1">--}}
{{--                                        <div class="form-floating">--}}
{{--                                            <select name="type" class="form-select" id="type">--}}
{{--                                                <option value="">Tutti</option>--}}
{{--                                                @foreach($types as $key => $label)--}}
{{--                                                    <option value="{{ $key }}" {{ request('type') == $key ? 'selected' : '' }}>--}}
{{--                                                        {{ $label }}--}}
{{--                                                    </option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                            <label for="type">Tipo</label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                    <div class="col-md-1">
                                        <div class="form-floating">
                                            <input type="date"
                                                   name="date_from"
                                                   class="form-control"
                                                   id="date_from"
                                                   value="{{ request('date_from') }}">
                                            <label for="date_from">Dal</label>
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-floating">
                                            <input type="date"
                                                   name="date_to"
                                                   class="form-control"
                                                   id="date_to"
                                                   value="{{ request('date_to') }}">
                                            <label for="date_to">Al</label>
                                        </div>
                                    </div>

                                    <div class="col-md-1 d-flex align-items-center gap-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-search"></i>
                                        </button>
                                        <a href="{{ route('movements.index') }}" class="btn btn-secondary">
                                            <i class="bi bi-x-circle"></i>
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- Tabella --}}
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>
                                            <a href="{{ route('movements.index', array_merge(request()->all(), ['sort' => 'code', 'direction' => request('sort') == 'code' && request('direction') == 'asc' ? 'desc' : 'asc'])) }}"
                                               class="text-decoration-none text-dark">
                                                Codice
                                                @if(request('sort') == 'code')
                                                    <i class="bi bi-chevron-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i>
                                                @endif
                                            </a>
                                        </th>
                                        <th>Stato</th>
                                        <th>Veicolo</th>
                                        <th>
                                            <a href="{{ route('movements.index', array_merge(request()->all(), ['sort' => 'departure_datetime', 'direction' => request('sort') == 'departure_datetime' && request('direction') == 'asc' ? 'desc' : 'asc'])) }}"
                                               class="text-decoration-none text-dark">
                                                Partenza
                                                @if(request('sort') == 'departure_datetime')
                                                    <i class="bi bi-chevron-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i>
                                                @endif
                                            </a>
                                        </th>
                                        <th>Destinazione</th>
                                        <th>Conducente</th>
                                        <th>Tipo</th>
                                        <th>KM</th>
                                        <th>Durata</th>
                                        <th class="text-end">Azioni</th>
                                    </tr>
                                </thead>
                                <tbody>
{{--                                    @forelse ($movements as $movement)--}}
{{--                                        <tr>--}}
{{--                                            <td>--}}
{{--                                                <a href="{{ route('movements.show', $movement->id) }}" class="text-decoration-none">--}}
{{--                                                    <strong>{{ $movement->code }}</strong>--}}
{{--                                                </a>--}}
{{--                                            </td>--}}
{{--                                            <td>--}}
{{--                                                <span class="badge bg-{{ $movement->status_badge_class }}">--}}
{{--                                                    {{ $movement->status_label }}--}}
{{--                                                </span>--}}
{{--                                            </td>--}}
{{--                                            <td>--}}
{{--                                                <div>--}}
{{--                                                    <strong>{{ $movement->car->name }}</strong>--}}
{{--                                                    @if($movement->car->carPlates->first())--}}
{{--                                                        <br>--}}
{{--                                                        <small class="text-muted">--}}
{{--                                                            <i class="bi bi-credit-card"></i> {{ $movement->car->carPlates->first()->name }}--}}
{{--                                                        </small>--}}
{{--                                                    @endif--}}
{{--                                                </div>--}}
{{--                                            </td>--}}
{{--                                            <td>--}}
{{--                                                <div>--}}
{{--                                                    <i class="bi bi-calendar3"></i> {{ $movement->departure_datetime->format('d/m/Y') }}--}}
{{--                                                    <br>--}}
{{--                                                    <small class="text-muted">--}}
{{--                                                        <i class="bi bi-clock"></i> {{ $movement->departure_datetime->format('H:i') }}--}}
{{--                                                    </small>--}}
{{--                                                    <br>--}}
{{--                                                    <small>--}}
{{--                                                        <i class="bi bi-geo-alt"></i> {{ Str::limit($movement->departure_location, 20) }}--}}
{{--                                                    </small>--}}
{{--                                                </div>--}}
{{--                                            </td>--}}
{{--                                            <td>--}}
{{--                                                <div>--}}
{{--                                                    <i class="bi bi-geo-alt-fill text-danger"></i>--}}
{{--                                                    <strong>{{ Str::limit($movement->arrival_location, 25) }}</strong>--}}
{{--                                                    <br>--}}
{{--                                                    <small class="text-muted">--}}
{{--                                                        <i class="bi bi-clock"></i> {{ $movement->arrival_datetime->format('d/m H:i') }}--}}
{{--                                                    </small>--}}
{{--                                                </div>--}}
{{--                                            </td>--}}
{{--                                            <td>--}}
{{--                                                <div>--}}
{{--                                                    <i class="bi bi-person-circle"></i> {{ $movement->driver->name }}--}}
{{--                                                    @if($movement->passengers_count > 0)--}}
{{--                                                        <br>--}}
{{--                                                        <small class="text-muted">--}}
{{--                                                            <i class="bi bi-people"></i> +{{ $movement->passengers_count }} passeggeri--}}
{{--                                                        </small>--}}
{{--                                                    @endif--}}
{{--                                                </div>--}}
{{--                                            </td>--}}
{{--                                            <td>--}}
{{--                                                <span class="badge bg-secondary">--}}
{{--                                                    {{ $movement->type_label }}--}}
{{--                                                </span>--}}
{{--                                                <br>--}}
{{--                                                <small class="text-muted">{{ Str::limit($movement->purpose, 20) }}</small>--}}
{{--                                            </td>--}}
{{--                                            <td>--}}
{{--                                                @if($movement->km_total)--}}
{{--                                                    <strong>{{ number_format($movement->km_total) }}</strong> km--}}
{{--                                                    @if($movement->fuel_liters)--}}
{{--                                                        <br>--}}
{{--                                                        <small class="text-muted">--}}
{{--                                                            <i class="bi bi-fuel-pump"></i> {{ $movement->fuel_liters }}L--}}
{{--                                                        </small>--}}
{{--                                                    @endif--}}
{{--                                                @else--}}
{{--                                                    <span class="text-muted">-</span>--}}
{{--                                                @endif--}}
{{--                                            </td>--}}
{{--                                            <td>--}}
{{--                                                @if($movement->formatted_duration)--}}
{{--                                                    {{ $movement->formatted_duration }}--}}
{{--                                                @else--}}
{{--                                                    <span class="text-muted">-</span>--}}
{{--                                                @endif--}}
{{--                                            </td>--}}
{{--                                            <td class="text-end">--}}
{{--                                                <div class="btn-group dropstart">--}}
{{--                                                    <button type="button" class="btn btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                                                        <i class="bi bi-three-dots-vertical"></i>--}}
{{--                                                    </button>--}}
{{--                                                    <ul class="dropdown-menu">--}}
{{--                                                        <li>--}}
{{--                                                            <a class="dropdown-item" href="{{ route('movements.show', $movement->id) }}">--}}
{{--                                                                <i class="bi bi-eye"></i> Visualizza--}}
{{--                                                            </a>--}}
{{--                                                        </li>--}}

{{--                                                        @if(in_array($movement->status, ['pending', 'approved']))--}}
{{--                                                            <li>--}}
{{--                                                                <a class="dropdown-item" href="{{ route('movements.edit', $movement->id) }}">--}}
{{--                                                                    <i class="bi bi-pencil"></i> Modifica--}}
{{--                                                                </a>--}}
{{--                                                            </li>--}}
{{--                                                        @endif--}}

{{--                                                        @if($movement->status == 'pending')--}}
{{--                                                            <li><hr class="dropdown-divider"></li>--}}
{{--                                                            <li>--}}
{{--                                                                <form action="{{ route('movements.updateStatus', $movement->id) }}" method="POST" class="d-inline">--}}
{{--                                                                    @csrf--}}
{{--                                                                    @method('PATCH')--}}
{{--                                                                    <input type="hidden" name="status" value="approved">--}}
{{--                                                                    <button type="submit" class="dropdown-item text-success">--}}
{{--                                                                        <i class="bi bi-check-circle"></i> Approva--}}
{{--                                                                    </button>--}}
{{--                                                                </form>--}}
{{--                                                            </li>--}}
{{--                                                        @endif--}}

{{--                                                        @if($movement->status == 'approved')--}}
{{--                                                            <li>--}}
{{--                                                                <form action="{{ route('movements.updateStatus', $movement->id) }}" method="POST" class="d-inline">--}}
{{--                                                                    @csrf--}}
{{--                                                                    @method('PATCH')--}}
{{--                                                                    <input type="hidden" name="status" value="in_progress">--}}
{{--                                                                    <button type="submit" class="dropdown-item text-info">--}}
{{--                                                                        <i class="bi bi-play-circle"></i> Inizia--}}
{{--                                                                    </button>--}}
{{--                                                                </form>--}}
{{--                                                            </li>--}}
{{--                                                        @endif--}}

{{--                                                        @if($movement->status == 'in_progress')--}}
{{--                                                            <li>--}}
{{--                                                                <form action="{{ route('movements.updateStatus', $movement->id) }}" method="POST" class="d-inline">--}}
{{--                                                                    @csrf--}}
{{--                                                                    @method('PATCH')--}}
{{--                                                                    <input type="hidden" name="status" value="completed">--}}
{{--                                                                    <button type="submit" class="dropdown-item text-success">--}}
{{--                                                                        <i class="bi bi-check2-all"></i> Completa--}}
{{--                                                                    </button>--}}
{{--                                                                </form>--}}
{{--                                                            </li>--}}
{{--                                                        @endif--}}

{{--                                                        @if(!in_array($movement->status, ['completed', 'cancelled']))--}}
{{--                                                            <li><hr class="dropdown-divider"></li>--}}
{{--                                                            <li>--}}
{{--                                                                <form action="{{ route('movements.updateStatus', $movement->id) }}" method="POST" class="d-inline">--}}
{{--                                                                    @csrf--}}
{{--                                                                    @method('PATCH')--}}
{{--                                                                    <input type="hidden" name="status" value="cancelled">--}}
{{--                                                                    <button type="submit" class="dropdown-item text-danger"--}}
{{--                                                                            onclick="return confirm('Sei sicuro di voler annullare questo movimento?')">--}}
{{--                                                                        <i class="bi bi-x-circle"></i> Annulla--}}
{{--                                                                    </button>--}}
{{--                                                                </form>--}}
{{--                                                            </li>--}}
{{--                                                        @endif--}}

{{--                                                        @if($movement->status == 'cancelled')--}}
{{--                                                            <li><hr class="dropdown-divider"></li>--}}
{{--                                                            <li>--}}
{{--                                                                <form action="{{ route('movements.destroy', $movement->id) }}" method="POST">--}}
{{--                                                                    @csrf--}}
{{--                                                                    @method('DELETE')--}}
{{--                                                                    <button type="submit" class="dropdown-item text-danger" data-confirm-delete="true">--}}
{{--                                                                        <i class="bi bi-trash"></i> Elimina--}}
{{--                                                                    </button>--}}
{{--                                                                </form>--}}
{{--                                                            </li>--}}
{{--                                                        @endif--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                    @empty--}}
{{--                                        <tr>--}}
{{--                                            <td colspan="10" class="text-center py-4">--}}
{{--                                                <i class="bi bi-inbox fs-1 text-muted"></i>--}}
{{--                                                <p class="text-muted">Nessun movimento trovato</p>--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                    @endforelse--}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    {!! $movements->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </div>

    {{-- Stili aggiuntivi --}}
    <style>
        .border-left-primary {
            border-left: 4px solid #4e73df !important;
        }
        .border-left-warning {
            border-left: 4px solid #f6c23e !important;
        }
        .border-left-info {
            border-left: 4px solid #36b9cc !important;
        }
        .border-left-success {
            border-left: 4px solid #1cc88a !important;
        }
        .border-left-dark {
            border-left: 4px solid #5a5c69 !important;
        }
        .table th a {
            color: inherit;
            text-decoration: none;
        }
        .table th a:hover {
            color: #0d6efd;
        }
    </style>
@endsection
