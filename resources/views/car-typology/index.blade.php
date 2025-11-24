@extends('layouts.app')

@section('template_title')
    Tipologie vetture
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Tipologia vetture') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('car-typology.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Nuova') }}
                                </a>
                              </div>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>Tipologia</th>
                                        <th>Descrizione</th>
                                        <th>Veicoli</th>
                                        <th>Data Creazione</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carTypologies as $carTypology)
                                        <tr>
                                            <td>
                                                <strong class="text-primary">{{ $carTypology->name }}</strong>
                                            </td>
                                            <td>{{ Str::limit($carTypology->description ?? 'N/A', 80) }}</td>
                                            <td>
                                                <span class="badge bg-info w-50">
                                                    {{ $carTypology->cars->count() ?? 0 }}
                                                </span>
                                            </td>
                                            <td>{{ $carTypology?->created_at?->format('d/m/Y') ?? '----' }}</td>

                                            <td class="text-end">
                                                <x-action-table-button :item="$carTypology" :label="'Tipologia'"  itemRoute="car-typology" />
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $carTypologies->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection