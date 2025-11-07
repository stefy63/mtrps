@extends('layouts.app')

@section('template_title')
    Movimenti Veicoli
@endsection

@section('content')
    <div class="container-fluid">
        {{-- Statistiche Header --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="row g-3">
                    <div class="col-md-2 col-sm-6">
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
                                        <i class="bi bi-truck fs-2 text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-6">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            In Attesa
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ number_format($stats['pending']) }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-clock-history fs-2 text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-6">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            In Corso
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ number_format($stats['in_progress']) }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-arrow-right-circle fs-2 text-gray-300"></i>
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
                                            Completati ({{ now()->format('F') }})
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ number_format($stats['completed_month']) }}
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
                        <div class="card border-left-dark shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                            In Corso ({{ now()->format('F') }})
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ number_format($stats['in_progress_month']) }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-speedometer2 fs-2 text-gray-300"></i>
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
                                {{ __('Movimenti Veicoli') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('movements.create') }}" class="btn btn-primary btn-sm float-right"
                                   data-bs-toggle="tooltip" data-bs-placement="top" title="Nuovo Movimento">
                                    <i class="bi bi-plus-circle"></i> {{ __('Nuovo Movimento') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {{-- Filtri --}}
                        <div class="row mb-3">
                            <div class="col-12">

                                {{-- Filtri --}}
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <x-input-search-button
                                                action="{{ route('movements.index') }}"
                                                search="{{old('search', $search)}}"
                                                name="inprogress"
                                                label="Terminate"
                                                check="{{old('inprogress', $inprogress)}}"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Tabella --}}
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                <tr>
                                    <th class="col-2">
                                        <a href="{{ route('movements.index', array_merge(request()->all(), ['sort' => 'code', 'direction' => request('sort') == 'code' && request('direction') == 'asc' ? 'desc' : 'asc'])) }}"
                                           class="text-decoration-none text-dark">
                                            Codice
                                        </a>
                                    </th>
                                    <th class="col-2">Veicolo</th>
                                    <th class="col-2">Assegnatario</th>
                                    <th class="col-3">Ufficio Destinatario</th>
                                    <th class="col-1">Dal</th>
                                    <th class="col-1">Al</th>
                                    <th class="text-end col-1">Azioni</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($movements as $movement)
                                    <tr>
                                        <td>
                                            <a href="{{ route('movements.show', $movement->id) }}"
                                               class="text-decoration-none">
                                                <strong>{{ $movement->code }}</strong>
                                            </a>
                                        </td>
                                        <td>
                                            <div>
                                                <a href="{{route('cars.show', $movement->car_id)}}"
                                                   class="text-decoration-none">
                                                    <strong>{{ $movement->car?->full_name }}</strong>
                                                </a>
                                                @if($movement->car?->carPlates->first())
                                                    <br>
                                                    <small class="text-muted">
                                                        <i class="bi bi-credit-card"></i> {{ $movement->car?->carPlates()->whereType('POLIZIA')->first()->name }}
                                                    </small>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <a href="{{route('offices.show', $movement->car?->carOffices[0]->id)}}"
                                                   class="text-decoration-none">
                                                {{$movement->car?->carOffices[0]->full_name ?? ''}}
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <a href="{{route('offices.show', $movement->office_id)}}"
                                                   class="text-decoration-none">
                                                {{$movement->office?->full_name ?? ''}}
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                {{$movement->date_from ? $movement->date_from->format('d/m/Y') : '-'}}
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                {{$movement->date_to ? $movement->date_to->format('d/m/Y') : 'in corso'}}
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <div class="btn-group dropstart">
                                                <x-action-table-button :item="$movement" :label="'Movimento'"/>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center py-4">
                                            <i class="bi bi-inbox fs-1 text-muted"></i>
                                            <p class="text-muted">Nessun movimento trovato</p>
                                        </td>
                                    </tr>
                                @endforelse
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
