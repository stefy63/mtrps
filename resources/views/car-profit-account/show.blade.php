@extends('layouts.app')

@section('template_title')
    {{ $carProfitAccount->name ?? __('Show') . " " . __('Car Profit Account') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Car Profit Account</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('car-profit-accounts.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
    <div class="form-group mb-2 mb20">
        <strong>Code:</strong>
        {{ $carProfitAccount->code }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Name:</strong>
        {{ $carProfitAccount->name }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Description:</strong>
        {{ $carProfitAccount->description }}
    </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
