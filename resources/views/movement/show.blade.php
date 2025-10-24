@extends('layouts.app')

@section('template_title')
    Movimento {{ $movement->code }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"
                         style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">
                                <i class="bi bi-eye"></i>&nbsp; {{ __('Dettaglio Movimento') }}:&nbsp; <strong>{{ $movement->code }}</strong>
                            </span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-sm btn-warning" href="{{ route('movements.edit', $movement->id) }}">
                                <i class="bi bi-pencil"></i> {{ __('Modifica') }}
                            </a>
                            <a class="btn btn-sm btn-secondary" href="{{ route('movements.index') }}">
                                <i class="bi bi-arrow-left"></i> {{ __('Torna alla lista') }}
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Veicolo</h6>
                                <p>
                                    <strong>{{ $movement->car->full_name }}</strong><br>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h6>Ufficio</h6>
                                <p>
                                    <strong>{{$movement->office->full_name}}</strong>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Dal</h6>
                                <p>
                                    <strong>{{ $movement->date_from->format('d/m/Y') }}</strong><br>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h6>Al</h6>
                                <p>
                                    <strong>@if($movement->date_to){{$movement->date_to->format('d/m/Y') }}@else <em>In corso</em>@endif</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Stili per la timeline --}}
    <style>
        .timeline {
            position: relative;
            padding-left: 30px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 9px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #dee2e6;
        }

        .timeline-item {
            position: relative;
            padding-bottom: 20px;
        }

        .timeline-marker {
            position: absolute;
            left: -21px;
            top: 0;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 3px solid #fff;
            box-shadow: 0 0 0 1px #dee2e6;
        }

        .timeline-content {
            padding-left: 10px;
        }
    </style>
@endsection
