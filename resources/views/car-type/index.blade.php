@extends('layouts.app')

@section('template_title')
    Car Types
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Car Types') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('car-types.create') }}" class="btn btn-primary btn-sm float-right"
                                   data-placement="left">
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
                                    <th>No</th>
                                    <th>Nome</th>
                                    <th>Descrizione</th>
                                    <th>Data Creazione</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($carTypes as $carType)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td><strong>{{ $carType->name }}</strong></td>
                                        <td>{{ Str::limit($carType->description ?? 'N/A', 50) }}</td>
                                        <td>{{ $carType->created_at->format('d/m/Y') }}</td>

                                        <td class="text-end">
                                            <x-action-table-button :itemRoute="'car-types'" :item="$carType"
                                                                   :label="'Tipo Vettura'"/>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $carTypes->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection