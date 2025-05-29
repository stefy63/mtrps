@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Car Power
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Car Power (Alimentazione)</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('car-powers.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('car-power.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection