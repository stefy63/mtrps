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
                                        name="unavailable"
                                        label="Fuori Uso"
                                        check="{{old('unavailable', $unavailable)}}"
                                        check="true"
                                />
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="thead">
                                    <tr>
                                        <th>Targa</th>
                                        <th>Modello</th>
                                        <th>Assegnatario</th>
                                        <th>Colore</th>
                                        <th>Km</th>
                                        <th>Alimentazione</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($cars as $car)
                                        <tr class="@if(!$car->available) text-decoration-line-through @endif">
                                            {{--                                        <td>{{ $car->carPlates->first()?->name ?? 'N/A' }}</td>--}}
                                            <td>
                                                <ul class="list-unstyled">
                                                    @foreach($car->carPlates as $plate)
                                                        <li class="
                                                    @switch($plate->type)
                                                        @case('POLIZIA')
                                                            text-primary
                                                            @break
                                                        @case('CIVILE')
                                                            text-info
                                                            @break
                                                        @case('ORIGINALE')
                                                            text-danger
                                                            @break
                                                        @default
                                                            text-muted
                                                    @endswitch
                                                    " style="font-size: 10px">{{$plate->name}}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>
                                                @if($car->maintenances->count() > 0)
                                                    <i class="bi bi-gear-fill text-danger"></i>
                                                @endif
                                                @if($car->movements->count() > 0)
                                                    <i class="bi bi-car-front text-warning"></i>
                                                @endif
                                                {{ $car->full_name ?? 'N/A' }}
                                            </td>
                                            <td class="text-truncate">{{ $car->carOffices?->first()->full_name ?? 'N/A' }}</td>
                                            <td>{{ $car->color ?? 'N/A' }}</td>
                                            <td>{{ number_format($car->km ?? 0) }} km</td>
                                            <td>{{ $car->carPower?->name ?? 'N/A' }}</td>

                                            <td class="text-end">
                                                @if($car->available)
                                                    <x-action-table-button :item="$car" :label="'Vettura'"/>
                                                @endif
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