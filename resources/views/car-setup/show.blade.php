@extends('layouts.app')

@section('template_title')
    {{ $carSetup->name ?? __('Show') . " " . __('Car Setup') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Car Setup</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('car-setups.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
    <div class="form-group mb-2 ">
        <strong>Car Id:</strong>
        {{ $carSetup->car_id }}
    </div>
    <div class="form-group mb-2 ">
        <strong>Name:</strong>
        {{ $carSetup->name }}
    </div>
    <div class="form-group mb-2 ">
        <strong>Description:</strong>
        {{ $carSetup->description }}
    </div>
    <div class="form-group mb-2 ">
        <strong>Date From:</strong>
        {{ $carSetup->date_from }}
    </div>
    <div class="form-group mb-2 ">
        <strong>Date To:</strong>
        {{ $carSetup->date_to }}
    </div>
    <div class="form-group mb-2 ">
        <strong>Note:</strong>
        {{ $carSetup->note }}
    </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
