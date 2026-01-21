@extends('layouts.app')

@section('template_title')
    Movimenti Veicoli
@endsection

@section('content')
    <div class="container-fluid">
        {{-- Statistiche Header --}}
        <div class="row mb-4" x-data>
            <form x-ref="filterForm" action="{{ route('movements.index') }}" method="GET">
                <input type="hidden" name="search" value="{{ old('search', $search) }}">
                <input type="hidden" name="inprogress" value="{{ old('inprogress', $inprogress) }}">
                <div class="col-12">
                    <div class="row g-2">
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
                                        <i class="bi bi-hourglass-split fs-2 text-gray-300"></i>
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

                    <div class="col-md-2 col-sm-6">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Termine Oggi
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ number_format($stats['end_today']) }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="input-group">
                                            <div class="form-check form-switch">
                                                <input 
                                                    @if(old('end_today', $end_today))
                                                    checked
                                                    @endif                                                       class="form-check-input"
                                                    type="checkbox"
                                                    name="end_today"
                                                    @change="$refs.filterForm.submit()"
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-6">
                        <div class="card border-left-dark shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                            Iniziano Oggi
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ number_format($stats['start_today']) }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="input-group">
                                            <div class="form-check form-switch">
                                                <input 
                                                    @if(old('start_today', $start_today))
                                                    checked
                                                    @endif
                                                    class="form-check-input"
                                                    type="checkbox"
                                                    name="start_today"
                                                    @change="$refs.filterForm.submit()"
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-6">
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

                </div>
            </div>
            </form>
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
                                                enableCheck="true"
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
                                    <th class="col-1">Stato</th>
                                    <th class="col-2">Veicolo</th>
                                    <th class="col-2">Assegnatario</th>
                                    <th class="col-2">Ufficio Destinatario</th>
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
                                            @if($movement->date_to && $movement->date_to < now())
                                                @if ($movement->validated)
                                                    <span class="badge bg-success">
                                                        <i class="bi bi-arrow-left"></i> Restituita
                                                    </span>
                                                @else
                                                    <span class="badge bg-danger">
                                                        <i class="bi bi-key"></i> Non Restituita
                                                    </span>
                                                @endif
                                            @else
                                                @if ($movement->date_from > now())
                                                    <span class="badge bg-warning">
                                                        <i class="bi bi-hourglass-split"></i> In Attesa
                                                    </span>
                                                @else
                                                    <span class="badge bg-primary">
                                                        <i class="bi bi-clock-history"></i> In Uso
                                                    </span>
                                                @endif
                                            @endif
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
                                                {{$movement->date_from ? $movement->date_from->format('d/m/Y H:i') : '-'}}
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                {{$movement->date_to ? $movement->date_to->format('d/m/Y H:i') : 'in corso'}}
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            @if(!$movement->validated)
                                                <div class="btn-group dropstart">
                                                    <x-action-table-button :item="$movement" :label="'Movimento'"/>
                                                </div>
                                            @endif
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
@endsection
