@extends('layouts.app')

@section('template_title')
    Car Powers
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Tipologia carburanti') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('car-powers.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>Icona</th>
                                        <th>Alimentazione</th>
                                        <th>Descrizione</th>
                                        <th>Veicoli</th>
                                        <th>Data Creazione</th>
                                        <th class="text-center">Azioni</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carPowers as $carPower)
                                        <tr>
                                            <td>
                                                <!-- Icone specifiche per tipo di alimentazione -->
                                                @php
                                                    $powerName = strtolower($carPower->name);
                                                    if (str_contains($powerName, 'benzina')) {
                                                        $icon = 'bi bi-fuel-pump text-warning';
                                                        $bgColor = 'bg-warning';
                                                    } elseif (str_contains($powerName, 'diesel')) {
                                                        $icon = 'bi bi-fuel-pump-diesel text-dark';
                                                        $bgColor = 'bg-secondary';
                                                    } elseif (str_contains($powerName, 'elettric') || str_contains($powerName, 'electric')) {
                                                        $icon = 'bi bi-ev-front text-primary';
                                                        $bgColor = 'bg-primary';
                                                    } elseif (str_contains($powerName, 'ibrido') || str_contains($powerName, 'hybrid')) {
                                                        $icon = 'bi bi-ev-station text-success';
                                                        $bgColor = 'bg-success';
                                                    } elseif (str_contains($powerName, 'gpl')) {
                                                        $icon = 'bi bi-fire text-info';
                                                        $bgColor = 'bg-info';
                                                    } elseif (str_contains($powerName, 'metano')) {
                                                        $icon = 'bi bi-wind text-success';
                                                        $bgColor = 'bg-success';
                                                    } else {
                                                        $icon = 'bi bi-gear text-muted';
                                                        $bgColor = 'bg-light';
                                                    }
                                                @endphp
                                                
                                                <div class="power-icon d-flex align-items-center justify-content-center {{ $bgColor }} bg-opacity-10 rounded" style="width: 40px; height: 40px;">
                                                    <i class="{{ $icon }}"></i>
                                                </div>
                                            </td>
                                            <td>
                                                <strong class="text-primary">{{ $carPower->name }}</strong>
                                            </td>
                                            <td>{{ Str::limit($carPower->description ?? 'N/A', 80) }}</td>
                                            <td>
                                                <span class="badge bg-info w-50">
                                                    {{ $carPower->cars->count() ?? 0 }}
                                                </span>
                                            </td>
                                            <td>{{ $carPower->created_at->format('d/m/Y') }}</td>

                                            <td class="text-end">
                                                <x-action-table-button :item="$carPower" :label="'Tipo alimentazione'"  itemRoute="car-powers" />
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $carPowers->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection