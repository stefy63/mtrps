@extends('layouts.app')

@section('template_title')
    {{ $carEquipment->name ?? __('Visualizza') . " " . __('Equipaggiamento') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card position-relative">
                    <div class="card-header"
                         style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Dettagli') }} Equipaggiamento</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('equipments.index') }}">
                                <i class="bi bi-arrow-left"></i> {{ __('Indietro') }}
                            </a>
                            <a class="btn btn-warning btn-sm" href="{{ route('equipments.edit', $carEquipment->id) }}">
                                <i class="bi bi-pencil"></i> {{ __('Modifica') }}
                            </a>
                        </div>
                    </div>

                    <div class="card-body bg-white overflow-x-auto" style="height: 70vh">
                        {{-- Informazioni Principali --}}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <strong>Nome:</strong>
                                    <p class="text-muted">{{ $carEquipment->name }}</p>
                                </div>

                                <div class="form-group mb-3">
                                    <strong>Descrizione:</strong>
                                    <p class="text-muted">{{ $carEquipment->description ?: 'Non specificata' }}</p>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <p><strong class="text-primary">Vetture su cui è installato:</strong></p>
                                @foreach($carEquipment->cars as $car)
                                    <div class="row">
                                        <div class="vr"></div>
                                        <div class="col-7 row">
                                            <div class="col-4">
                                                <small class="text-muted" style="font-size: 10px">{{$car->chassis}}</small>
                                            </div>
                                            <div class="col-6">
                                                <u>{{$car->full_name}}:</u>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <small class="text-muted">{{$car->pivot->note}}</small>
                                        </div>
                                    </div>
                                @endforeach
                                 @foreach($carEquipment->cars as $car)
                                    <div class="row">
                                        <div class="vr"></div>
                                        <div class="col-7 row">
                                            <div class="col-4">
                                                <small class="text-muted" style="font-size: 10px">{{$car->chassis}}</small>
                                            </div>
                                            <div class="col-6">
                                                <u>{{$car->full_name}}:</u>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <small class="text-muted">{{$car->pivot->note}}</small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="row fixed-bottom my-3">
                            <hr>
                            <div class="col-md-6 ps-4">
                                <small class="text-muted">
                                    <strong>Creato il:</strong> {{ $carEquipment->created_at?->format('d/m/Y H:i') }}
                                </small>
                            </div>
                            <div class="col-md-6 text-end pe-4">
                                <small class="text-muted">
                                    <strong>Ultimo
                                        aggiornamento:</strong> {{ $carEquipment->updated_at?->format('d/m/Y H:i') }}
                                </small>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
