@extends('layouts.app')

@section('template_title')
    Car Owners
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Car Owners') }} (Proprietari)
                            </span>

                             <div class="float-right">
                                <a href="{{ route('car-owners.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        <th class="col-3">Proprietario</th>
                                        <th class="col-1">Veicoli</th>
                                        <th class="col-2">Telefono Assistenza</th>
                                        <th class="col-2">Mail/Pec</th>
                                        <th class="col-3">Indirizzo</th>
                                        <th class="col-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carOwners as $carOwner)
                                        <tr>
                                            <td>
                                                <strong class="text-primary">{{ $carOwner->name }}</strong>
                                            </td>
                                            <td class="text-center">
                                                @if($carOwner->cars_count > 0)
                                                <span class="badge bg-primary w-75 d-flex justify-content-around">
                                                    <i class="bi bi-car-front"></i> {{ $carOwner->cars_count }}
                                                </span>
                                                @else
                                                <span class="badge bg-warning w-75 d-flex justify-content-around">
                                                    <i class="bi bi-dash-circle-fill text-danger"></i> 0
                                                </span>
                                                @endif
                                            </td>
                                            <td>{{$carOwner->phone_safety}}</td>
                                            <td>{{$carOwner->mail}}<br>{{$carOwner->pec}}</td>
                                            <td>{{ $carOwner->address }}</td>

                                            <td class="text-end">
                                                <x-action-table-button :item="$carOwner" :label="'Proprietà'"  itemRoute="car-owners" />
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $carOwners->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection