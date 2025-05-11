@extends('layouts.app')

@section('template_title')
    {{ $assigneeOffice->name ?? __('Show') . " " . __('Assignee Office') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Assignee Office</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('assignee-offices.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
    <div class="form-group mb-2 mb20">
        <strong>Car Assignee Id:</strong>
        {{ $assigneeOffice->car_assignee_id }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Name:</strong>
        {{ $assigneeOffice->name }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Description:</strong>
        {{ $assigneeOffice->description }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Note:</strong>
        {{ $assigneeOffice->note }}
    </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
