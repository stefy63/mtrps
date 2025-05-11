@extends('layouts.app')

@section('template_title')
    {{ $cig->name ?? __('Show') . " " . __('Cig') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Cig</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('cigs.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
    <div class="form-group mb-2 mb20">
        <strong>Car Id:</strong>
        {{ $cig->car_id }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Maintenance Garage Id:</strong>
        {{ $cig->maintenance_garage_id }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>User Rup Id:</strong>
        {{ $cig->user_rup_id }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>User Support Id:</strong>
        {{ $cig->user_support_id }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>User Tender Notice Id:</strong>
        {{ $cig->user_tender_notice_id }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>User Tester Id:</strong>
        {{ $cig->user_tester_id }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Date:</strong>
        {{ $cig->date }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Ce:</strong>
        {{ $cig->ce }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Description:</strong>
        {{ $cig->description }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Preventive:</strong>
        {{ $cig->preventive }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Final Report:</strong>
        {{ $cig->final_report }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Taxable:</strong>
        {{ $cig->taxable }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Vat:</strong>
        {{ $cig->vat }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Cig:</strong>
        {{ $cig->cig }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Note:</strong>
        {{ $cig->note }}
    </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
