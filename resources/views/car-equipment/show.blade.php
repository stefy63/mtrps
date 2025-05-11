@extends('layouts.app')

@section('template_title')
    {{ $carEquipment->name ?? __('Show') . " " . __('Car Equipment') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Car Equipment</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('car-equipments.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
    <div class="form-group mb-2 mb20">
        <strong>Car Id:</strong>
        {{ $carEquipment->car_id }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Name:</strong>
        {{ $carEquipment->name }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Description:</strong>
        {{ $carEquipment->description }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Date From:</strong>
        {{ $carEquipment->date_from }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Date To:</strong>
        {{ $carEquipment->date_to }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Note:</strong>
        {{ $carEquipment->note }}
    </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
