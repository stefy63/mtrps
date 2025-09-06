@extends('layouts.app')

@section('template_title')
    {{ __('Nuovo') }} Equipaggiamento
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Nuovo') }} Equipaggiamento</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('car-equipments.index') }}">
                                <i class="bi bi-arrow-left"></i> {{ __('Indietro') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('car-equipments.store') }}" role="form" enctype="multipart/form-data">
                            @csrf

                            @include('car-equipment.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
