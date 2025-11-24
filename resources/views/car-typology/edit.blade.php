@extends('layouts.app')

@section('template_title')
    {{ __('Aggiorna') }} Tipologia vettura
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Aggiorna') }} Tipologia vettura</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('car-typology.update', $carTypology->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('car-typology.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection