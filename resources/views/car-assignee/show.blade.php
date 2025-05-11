@extends('layouts.app')

@section('template_title')
    {{ $carAssignee->name ?? __('Show') . " " . __('Car Assignee') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Car Assignee</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('car-assignees.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
    <div class="form-group mb-2 mb20">
        <strong>Car Id:</strong>
        {{ $carAssignee->car_id }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Name:</strong>
        {{ $carAssignee->name }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Description:</strong>
        {{ $carAssignee->description }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Date From:</strong>
        {{ $carAssignee->date_from }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Date To:</strong>
        {{ $carAssignee->date_to }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Note:</strong>
        {{ $carAssignee->note }}
    </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
