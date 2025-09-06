@extends('layouts.app')

@section('template_title')
    Rifornimenti Carburante
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                <i class="bi bi-fuel-pump"></i> {{ __('Rifornimenti Carburante') }}
                            </span>

                            <div class="float-right">
                                <button class="btn btn-sm btn-outline-secondary me-2" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse">
                                    <i class="bi bi-funnel"></i> Filtri
                                </button>
                                <a href="{{ route('car-fuels.create') }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus"></i> {{ __('Nuovo Rifornimento') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Filtri collassabili -->
                    <div class="collapse" id="filterCollapse">
                        <div class="card-body bg-light">
                            <form method="GET" action="{{ route('car-fuels.index') }}" class="row g-3">
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
                                    <label class="form-label">Utente</label>
                                    <select name="user_id" class="form-select">
                                        <option value="">Tutti gli utenti</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
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

                                <div class="col-md-2">
                                    <label class="form-label">Cerca</label>
                                    <input type="text" name="search" class="form-control" placeholder="Cerca..." value="{{ request('search') }}">
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-search"></i> Applica Filtri
                                    </button>
                                    <a href="{{ route('car-fuels.index') }}" class="btn btn-secondary">
                                        <i class="bi bi-x-circle"></i> Cancella
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card-body">
                        @if(count($carFuels) > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="thead">
                                        <tr>
                                            <th>Data</th>
                                            <th>Veicolo</th>
                                            <th>Targa</th>
                                            <th>Alimentazione</th>
                                            <th>Rifornimento</th>
                                            <th>Dettagli</th>
                                            <th>Utente</th>
                                            <th>Note</th>
                                            <th width="120"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($carFuels as $carFuel)
                                            <tr>
                                                <td>
                                                    <small class="text-muted">{{ $carFuel->date_from->format('d/m/Y') }}</small>
                                                    @if($carFuel->date_to)
                                                        <br><small class="text-muted">fino al {{ $carFuel->date_to->format('d/m/Y') }}</small>
                                                    @endif
                                                </td>
                                                <td>
                                                    <strong>{{ $carFuel->car->name }}</strong>
                                                    @if($carFuel->car->carBrand)
                                                        <br><small class="text-muted">{{ $carFuel->car->carBrand->name }}</small>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($carFuel->car->carPlates->count() > 0)
                                                        <span class="badge bg-primary">{{ $carFuel->car->carPlates->first()->name }}</span>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($carFuel->car->carPower)
                                                        @php
                                                            $powerType = strtolower($carFuel->car->carPower->name);
                                                            $badgeClass = 'secondary';
                                                            $icon = 'fuel-pump';

                                                            if (str_contains($powerType, 'benzina')) {
                                                                $badgeClass = 'success';
                                                                $icon = 'droplet';
                                                            } elseif (str_contains($powerType, 'diesel') || str_contains($powerType, 'gasolio')) {
                                                                $badgeClass = 'dark';
                                                                $icon = 'droplet-fill';
                                                            } elseif (str_contains($powerType, 'elettric')) {
                                                                $badgeClass = 'info';
                                                                $icon = 'lightning-charge';
                                                            } elseif (str_contains($powerType, 'ibrid')) {
                                                                $badgeClass = 'warning';
                                                                $icon = 'battery-charging';
                                                            } elseif (str_contains($powerType, 'gpl')) {
                                                                $badgeClass = 'primary';
                                                                $icon = 'fire';
                                                            } elseif (str_contains($powerType, 'metano')) {
                                                                $badgeClass = 'secondary';
                                                                $icon = 'wind';
                                                            }
                                                        @endphp
                                                        <span class="badge bg-{{ $badgeClass }}">
                                                            <i class="bi bi-{{ $icon }}"></i> {{ $carFuel->car->carPower->name }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <strong>{{ $carFuel->name }}</strong>
                                                </td>
                                                <td>
                                                    @if($carFuel->description)
                                                        <small>{{ $carFuel->description }}</small>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($carFuel->user)
                                                        <small>{{ $carFuel->user->name }}</small>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($carFuel->note)
                                                        <small data-bs-toggle="tooltip" title="{{ $carFuel->note }}">
                                                            {{ Str::limit($carFuel->note, 30) }}
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
                                                                <a class="dropdown-item" href="{{ route('car-fuels.show', $carFuel->id) }}">
                                                                    <i class="bi bi-eye"></i> {{ __('Visualizza') }}
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="{{ route('car-fuels.edit', $carFuel->id) }}">
                                                                    <i class="bi bi-pencil"></i> {{ __('Modifica') }}
                                                                </a>
                                                            </li>
                                                            <li><hr class="dropdown-divider"></li>
                                                            <li>
                                                                <form action="{{ route('car-fuels.destroy', $carFuel->id) }}" method="POST">
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
                                <i class="bi bi-info-circle"></i> Nessun rifornimento registrato.
                                <a href="{{ route('car-fuels.create') }}" class="alert-link">Registra il primo rifornimento</a>
                            </div>
                        @endif
                    </div>
                </div>

                @if($carFuels->hasPages())
                    <div class="mt-3">
                        {!! $carFuels->withQueryString()->links() !!}
                    </div>
                @endif
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
