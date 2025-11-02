@extends('layouts.app')

@section('template_title')
    Cars
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Cars') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('cars.create') }}" class="btn btn-primary btn-sm float-right"
                                   data-placement="left">
                                    {{ __('Nuovo') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        {{-- Filtri --}}
                        <div class="row mb-3">
                            <div class="col-12">
                                <x-input-search-button
                                        action="{{ route('cars.index') }}"
                                        search="{{old('search', $search)}}"
                                />
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                <tr>
                                    <th>Targa</th>
                                    <th>Modello</th>
                                    <th>Proprietario</th>
                                    <th>Colore</th>
                                    <th>Km</th>
                                    <th>Alimentazione</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($cars as $car)
                                    <tr>
                                        <td>{{ $car->carPlates->first()?->name ?? 'N/A' }}</td>
                                        <td>{{ $car->full_name ?? 'N/A' }}</td>
                                        <td>{{ $car->carOwner?->name ?? 'N/A' }}</td>
                                        <td>{{ $car->color ?? 'N/A' }}</td>
                                        <td>{{ number_format($car->km ?? 0) }} km</td>
                                        <td>{{ $car->carPower?->name ?? 'N/A' }}</td>

                                        <td class="text-end">
                                            <x-action-table-button :item="$car" :label="'Vettura'" />
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $cars->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
