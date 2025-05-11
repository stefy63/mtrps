@extends('layouts.app')

@section('template_title')
    {{ $carOwner->name ?? __('Show') . " " . __('Car Owner') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Car Owner</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('car-owners.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
    <div class="form-group mb-2 mb20">
        <strong>Name:</strong>
        {{ $carOwner->name }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Description:</strong>
        {{ $carOwner->description }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Note:</strong>
        {{ $carOwner->note }}
    </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
