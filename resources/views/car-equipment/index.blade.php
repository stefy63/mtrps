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
                                <a href="{{ route('equipments.create') }}" class="btn btn-primary btn-sm float-right"
                                   data-bs-toggle="tooltip" data-bs-placement="top"
                                   title="{{ __('Nuovo Equipaggiamento') }}">
                                    <i class="bi bi-plus-circle"></i> {{ __('Nuovo') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {{-- Filtri --}}
                        <div class="row mb-3">

                            <div class="col-12 mb-3">
                                <x-input-search-button
                                        action="{{ route('equipments.index') }}"
                                        search="{{old('search', $search)}}"
                                />

                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="thead">
                                    <tr>
                                        <th>Equipaggiamento</th>
                                        <th>Installazioni</th>
                                        <th class="text-end">Azioni</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($carEquipments as $equipment)
                                        <tr>
                                            <td>
                                                <strong>{{ $equipment->name }}</strong>
                                                @if($equipment->description)
                                                    <br>
                                                    <small class="text-muted">{{ $equipment->description }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                @if($equipment->cars)
                                                    <span>{{$equipment->cars->count()}}</span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <x-action-table-button :item="$equipment" :label="'Dotazione'"/>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center py-4">
                                                <p class="mb-0">Nessun equipaggiamento trovato.</p>
                                                <a href="{{ route('equipments.create') }}"
                                                   class="btn btn-primary btn-sm mt-2">
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
