@extends('layouts.app')

@section('template_title')
    {{ $maintenanceGarage->name ?? __('Show') . " " . __('Maintenance Garage') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Maintenance Garage</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('maintenance-garages.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
    <div class="form-group mb-2 mb20">
        <strong>Maintenance Id:</strong>
        {{ $maintenanceGarage->maintenance_id }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Name:</strong>
        {{ $maintenanceGarage->name }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Piva:</strong>
        {{ $maintenanceGarage->piva }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Cf:</strong>
        {{ $maintenanceGarage->cf }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Iban:</strong>
        {{ $maintenanceGarage->iban }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Pec:</strong>
        {{ $maintenanceGarage->pec }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Acc:</strong>
        {{ $maintenanceGarage->acc }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Anti Mafia:</strong>
        {{ $maintenanceGarage->anti_mafia }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Durc:</strong>
        {{ $maintenanceGarage->durc }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Description:</strong>
        {{ $maintenanceGarage->description }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Note:</strong>
        {{ $maintenanceGarage->note }}
    </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
