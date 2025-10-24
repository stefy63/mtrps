@extends('layouts.app')

@section('template_title')
    Car Brands
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Car Brands') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('car-brands.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        <th>Marca</th>
                                        <th>Descrizione</th>
                                        <th>Veicoli</th>
                                        <th>Data Creazione</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carBrands as $carBrand)
                                        <tr>
                                            <td>
                                                <strong class="text-primary">{{ $carBrand->name }}</strong>
                                            </td>
                                            <td>{{ Str::limit($carBrand->description ?? 'N/A', 60) }}</td>
                                            <td>
                                                <span class="badge bg-info w-50">
                                                    {{ $carBrand->cars->count() ?? 0 }}
                                                </span>
                                            </td>
                                            <td>{{ $carBrand->created_at->format('d/m/Y') }}</td>

                                            <td class="text-end">
                                                <x-action-table-button :item="$carBrand" :label="'Marca'"  itemRoute="car-brands" />
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $carBrands->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection