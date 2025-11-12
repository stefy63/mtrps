@extends('layouts.app')

@section('template_title')
    {{ __('Modifica') }} Equipaggiamento
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <div class="float-start">
                            <span class="card-title">{{ __('Modifica') }} Equipaggiamento</span>
                        </div>
                        <div class="float-end">
                            <a class="btn btn-primary btn-sm" href="{{ route('equipments.index') }}">
                                <i class="bi bi-arrow-left"></i> {{ __('Indietro') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('equipments.update', $carEquipment->id) }}" role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('car-equipment.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
