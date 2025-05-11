@extends('layouts.app')

@section('template_title')
    {{ $movement->name ?? __('Show') . " " . __('Movement') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Movement</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('movements.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
    <div class="form-group mb-2 mb20">
        <strong>Car Id:</strong>
        {{ $movement->car_id }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Name:</strong>
        {{ $movement->name }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Description:</strong>
        {{ $movement->description }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Date From:</strong>
        {{ $movement->date_from }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Date To:</strong>
        {{ $movement->date_to }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Note:</strong>
        {{ $movement->note }}
    </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
