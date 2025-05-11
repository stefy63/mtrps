@extends('layouts.app')

@section('template_title')
    {{ $car->name ?? __('Show') . " " . __('Car') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Car</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('cars.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
    <div class="form-group mb-2 mb20">
        <strong>Car Type Id:</strong>
        {{ $car->car_type_id }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Car Owner Id:</strong>
        {{ $car->car_owner_id }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Car Brand Id:</strong>
        {{ $car->car_brand_id }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Car Power Id:</strong>
        {{ $car->car_power_id }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Car Profit Account Id:</strong>
        {{ $car->car_profit_account_id }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Name:</strong>
        {{ $car->name }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Model:</strong>
        {{ $car->model }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Color:</strong>
        {{ $car->color }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Cod Model:</strong>
        {{ $car->cod_model }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Profit Account:</strong>
        {{ $car->profit_account }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Tank:</strong>
        {{ $car->tank }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Km:</strong>
        {{ $car->km }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Description:</strong>
        {{ $car->description }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Winter Wheels:</strong>
        {{ $car->winter_wheels }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Wheels Type:</strong>
        {{ $car->wheels_type }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Warranty:</strong>
        {{ $car->warranty }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Tel Warranty:</strong>
        {{ $car->tel_warranty }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Chassis:</strong>
        {{ $car->chassis }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Date Revision:</strong>
        {{ $car->date_revision }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Doc:</strong>
        {{ $car->doc }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Note:</strong>
        {{ $car->note }}
    </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
