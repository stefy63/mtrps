@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Car Type
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Car Type</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('car-types.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('car-type.form')

                            <div class="col-md-12 mt20 mt-2">
                                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                                <a href="{{ route('car-types.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection