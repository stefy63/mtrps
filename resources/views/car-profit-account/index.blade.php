@extends('layouts.app')

@section('template_title')
    Centri di Costo
@endsection

@section('content')
    <div class="container-fluid">
        {{-- Statistiche Header --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="row g-3">
                    <div class="col-md-3 col-sm-6">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Totali
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ number_format($stats['total']) }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-wallet2 fs-2 text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Attivi
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ number_format($stats['active']) }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-check-circle fs-2 text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Con Veicoli
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ number_format($stats['with_cars']) }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-truck fs-2 text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            In Scadenza
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ number_format($stats['expiring_soon']) }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-exclamation-triangle fs-2 text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Card --}}
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Centri di Costo / Conti Economici') }}
                            </span>

                            <div class="float-right d-flex gap-2">
                                <a href="{{ route('car-profit-accounts.export') }}"
                                   class="btn btn-success btn-sm"
                                   data-bs-toggle="tooltip"
                                   data-bs-placement="top"
                                   title="Esporta CSV">
                                    <i class="bi bi-download"></i> Esporta
                                </a>
                                <a href="{{ route('car-profit-accounts.create') }}"
                                   class="btn btn-primary btn-sm float-right"
                                   data-bs-toggle="tooltip"
                                   data-bs-placement="top"
                                   title="Nuovo Centro di Costo">
                                    <i class="bi bi-plus-circle"></i> {{ __('Nuovo') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {{-- Filtri --}}
                        <div class="row mb-3">
                            <div class="col-12">
                                <form method="GET" action="{{ route('car-profit-accounts.index') }}" class="row g-3">
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="text"
                                                   name="search"
                                                   class="form-control"
                                                   id="search"
                                                   placeholder="Cerca..."
                                                   value="{{ request('search') }}">
                                            <label for="search">Cerca (codice, nome, dipartimento, responsabile)</label>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <select name="category" class="form-select" id="category">
                                                <option value="">Tutte le categorie</option>
                                                @foreach($categories as $key => $label)
                                                    <option value="{{ $key }}" {{ request('category') == $key ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label for="category">Categoria</label>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <select name="status" class="form-select" id="status">
                                                <option value="">Tutti gli stati</option>
                                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Attivi</option>
                                                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Disattivi</option>
                                                <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Scaduti</option>
                                            </select>
                                            <label for="status">Stato</label>
                                        </div>
                                    </div>

                                    <div class="col-md-1 d-flex align-items-center gap-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-search"></i>
                                        </button>
                                        <a href="{{ route('car-profit-accounts.index') }}" class="btn btn-secondary">
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
                                            <a href="{{ route('car-profit-accounts.index', array_merge(request()->all(), ['sort' => 'code', 'direction' => request('sort') == 'code' && request('direction') == 'asc' ? 'desc' : 'asc'])) }}"
                                               class="text-decoration-none text-dark">
                                                Codice
                                                @if(request('sort') == 'code')
                                                    <i class="bi bi-chevron-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i>
                                                @endif
                                            </a>
                                        </th>
                                        <th>
                                            <a href="{{ route('car-profit-accounts.index', array_merge(request()->all(), ['sort' => 'name', 'direction' => request('sort') == 'name' && request('direction') == 'asc' ? 'desc' : 'asc'])) }}"
                                               class="text-decoration-none text-dark">
                                                Nome
                                                @if(request('sort') == 'name')
                                                    <i class="bi bi-chevron-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i>
                                                @endif
                                            </a>
                                        </th>
                                        <th>Categoria</th>
                                        <th>Dipartimento</th>
                                        <th>Responsabile</th>
                                        <th>Budget Anno</th>
                                        <th>Veicoli</th>
                                        <th>Validità</th>
                                        <th>Stato</th>
                                        <th class="text-end">Azioni</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($carProfitAccounts as $carProfitAccount)
                                        <tr>
                                            <td>
                                                <a href="{{ route('car-profit-accounts.show', $carProfitAccount->id) }}"
                                                   class="text-decoration-none fw-bold">
                                                    {{ $carProfitAccount->code }}
                                                </a>
                                            </td>
                                            <td>
                                                <strong>{{ $carProfitAccount->name }}</strong>
                                                @if($carProfitAccount->description)
                                                    <br>
                                                    <small class="text-muted">{{ Str::limit($carProfitAccount->description, 50) }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                @if($carProfitAccount->category)
                                                    <span class="badge bg-secondary">
                                                        {{ $carProfitAccount->category_label }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>{{ $carProfitAccount->department ?? '-' }}</td>
                                            <td>
                                                @if($carProfitAccount->responsible)
                                                    <div>
                                                        <i class="bi bi-person"></i> {{ $carProfitAccount->responsible }}
                                                        @if($carProfitAccount->email)
                                                            <br>
                                                            <small class="text-muted">
                                                                <i class="bi bi-envelope"></i> {{ $carProfitAccount->email }}
                                                            </small>
                                                        @endif
                                                        @if($carProfitAccount->phone)
                                                            <br>
                                                            <small class="text-muted">
                                                                <i class="bi bi-telephone"></i> {{ $carProfitAccount->phone }}
                                                            </small>
                                                        @endif
                                                    </div>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($carProfitAccount->budget_year)
                                                    <div>
                                                        <strong>€ {{ number_format($carProfitAccount->budget_year, 2, ',', '.') }}</strong>
                                                        @if($carProfitAccount->budget_month)
                                                            <br>
                                                            <small class="text-muted">
                                                                € {{ number_format($carProfitAccount->budget_month, 2, ',', '.') }}/mese
                                                            </small>
                                                        @endif
                                                        @if($carProfitAccount->budget_usage_percentage)
                                                            <br>
                                                            <div class="progress" style="height: 10px;">
                                                                <div class="progress-bar
                                                                    @if($carProfitAccount->budget_usage_percentage > 90) bg-danger
                                                                    @elseif($carProfitAccount->budget_usage_percentage > 70) bg-warning
                                                                    @else bg-success
                                                                    @endif"
                                                                    role="progressbar"
                                                                    style="width: {{ $carProfitAccount->budget_usage_percentage }}%">
                                                                </div>
                                                            </div>
                                                            <small class="text-muted">{{ $carProfitAccount->budget_usage_percentage }}% utilizzato</small>
                                                        @endif
                                                    </div>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($carProfitAccount->cars_count > 0)
                                                    <div>
                                                        <i class="bi bi-truck"></i>
                                                        <strong>{{ $carProfitAccount->cars_count }}</strong> totali
                                                        @if($carProfitAccount->active_cars_count > 0)
                                                            <br>
                                                            <small class="text-success">
                                                                {{ $carProfitAccount->active_cars_count }} attivi
                                                            </small>
                                                        @endif
                                                    </div>
                                                @else
                                                    <span class="text-muted">Nessuno</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($carProfitAccount->valid_from || $carProfitAccount->valid_to)
                                                    <small>
                                                        @if($carProfitAccount->valid_from)
                                                            Dal {{ $carProfitAccount->valid_from->format('d/m/Y') }}
                                                        @endif
                                                        @if($carProfitAccount->valid_to)
                                                            <br>Al {{ $carProfitAccount->valid_to->format('d/m/Y') }}
                                                            @php
                                                                $daysToExpiry = now()->diffInDays($carProfitAccount->valid_to, false);
                                                            @endphp
                                                            @if($daysToExpiry >= 0 && $daysToExpiry <= 30)
                                                                <br>
                                                                <span class="badge bg-warning">
                                                                    <i class="bi bi-exclamation-triangle"></i>
                                                                    Scade tra {{ $daysToExpiry }} giorni
                                                                </span>
                                                            @endif
                                                        @endif
                                                    </small>
                                                @else
                                                    <span class="text-muted">Sempre valido</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge bg-{{ $carProfitAccount->status_badge_class }}">
                                                    {{ $carProfitAccount->status_label }}
                                                </span>
                                            </td>
                                            <td class="text-end">
                                                <div class="btn-group dropstart">
                                                    <button type="button" class="btn btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('car-profit-accounts.show', $carProfitAccount->id) }}">
                                                                <i class="bi bi-eye"></i> Visualizza
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('car-profit-accounts.edit', $carProfitAccount->id) }}">
                                                                <i class="bi bi-pencil"></i> Modifica
                                                            </a>
                                                        </li>
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li>
                                                            <form action="{{ route('car-profit-accounts.toggleActive', $carProfitAccount->id) }}"
                                                                  method="POST"
                                                                  class="d-inline">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="dropdown-item">
                                                                    @if($carProfitAccount->is_active)
                                                                        <i class="bi bi-x-circle text-warning"></i> Disattiva
                                                                    @else
                                                                        <i class="bi bi-check-circle text-success"></i> Attiva
                                                                    @endif
                                                                </button>
                                                            </form>
                                                        </li>
                                                        @if($carProfitAccount->cars_count == 0)
                                                            <li><hr class="dropdown-divider"></li>
                                                            <li>
                                                                <form action="{{ route('car-profit-accounts.destroy', $carProfitAccount->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item text-danger" data-confirm-delete="true">
                                                                        <i class="bi bi-trash"></i> Elimina
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center py-4">
                                                <i class="bi bi-inbox fs-1 text-muted"></i>
                                                <p class="text-muted">Nessun centro di costo trovato</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    {!! $carProfitAccounts->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </div>

    {{-- Stili aggiuntivi --}}
    <style>
        .border-left-primary {
            border-left: 4px solid #4e73df !important;
        }
        .border-left-success {
            border-left: 4px solid #1cc88a !important;
        }
        .border-left-info {
            border-left: 4px solid #36b9cc !important;
        }
        .border-left-warning {
            border-left: 4px solid #f6c23e !important;
        }
        .table th a {
            color: inherit;
            text-decoration: none;
        }
        .table th a:hover {
            color: #0d6efd;
        }
        .progress {
            margin-top: 5px;
        }
    </style>
@endsection
