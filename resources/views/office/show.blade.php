@extends('layouts.app')

@section('template_title')
    {{ $office->name ?? __('Show') . " " . __('Office') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Office</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('offices.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
    <div class="form-group mb-2 mb20">
        <strong>Ente:</strong>
        {{ $office->ente }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Name:</strong>
        {{ $office->name }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Phone:</strong>
        {{ $office->phone }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Mail:</strong>
        {{ $office->mail }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Address:</strong>
        {{ $office->address }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Description:</strong>
        {{ $office->description }}
    </div>
    <div class="form-group mb-2 mb20">
        <strong>Note:</strong>
        {{ $office->note }}
    </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
