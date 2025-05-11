@extends('layouts.app')

@section('template_title')
    {{ $carPlate->name ?? __('Show') . " " . __('Car Plate') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Car Plate</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('car-plates.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
    <div class="form-group mb-2 mb20">
        <strong>Car Id:</strong>
        {{ $carPlate->car_id }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Name:</strong>
        {{ $carPlate->name }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Type:</strong>
        {{ $carPlate->type }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Date From:</strong>
        {{ $carPlate->date_from }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Date To:</strong>
        {{ $carPlate->date_to }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Note:</strong>
        {{ $carPlate->note }}
    </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
