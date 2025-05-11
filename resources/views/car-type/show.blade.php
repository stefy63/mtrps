@extends('layouts.app')

@section('template_title')
    {{ $carType->name ?? __('Show') . " " . __('Car Type') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Car Type</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('car-types.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
    <div class="form-group mb-2 mb20">
        <strong>Name:</strong>
        {{ $carType->name }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Description:</strong>
        {{ $carType->description }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Note:</strong>
        {{ $carType->note }}
    </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
