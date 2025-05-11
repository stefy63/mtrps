@extends('layouts.app')

@section('template_title')
    {{ $maintenanceType->name ?? __('Show') . " " . __('Maintenance Type') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Maintenance Type</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('maintenance-types.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
    <div class="form-group mb-2 mb20">
        <strong>Maintenance Id:</strong>
        {{ $maintenanceType->maintenance_id }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Name:</strong>
        {{ $maintenanceType->name }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Description:</strong>
        {{ $maintenanceType->description }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Note:</strong>
        {{ $maintenanceType->note }}
    </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
