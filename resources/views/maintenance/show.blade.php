@extends('layouts.app')

@section('template_title')
    {{ $maintenance->name ?? __('Show') . " " . __('Maintenance') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Maintenance</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('maintenances.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
    <div class="form-group mb-2 mb20">
        <strong>Car Id:</strong>
        {{ $maintenance->car_id }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Name:</strong>
        {{ $maintenance->name }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Description:</strong>
        {{ $maintenance->description }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Date From:</strong>
        {{ $maintenance->date_from }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Date To:</strong>
        {{ $maintenance->date_to }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Note:</strong>
        {{ $maintenance->note }}
    </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
