@extends('layouts.app')

@section('template_title')
    Modifica Movimento {{ $movement->code }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="card-title">
                                <i class="bi bi-pencil"></i> {{ __('Modifica Movimento') }}: <strong>{{ $movement->code }}</strong>
                            </span>
                            <div>
                                <a href="{{ route('movements.show', $movement->id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i> Visualizza
                                </a>
                                <a href="{{ route('movements.index') }}" class="btn btn-sm btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Torna alla lista
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- Alert per movimenti in corso o completati --}}
                        @if(in_array($movement->status, ['in_progress', 'completed']))
                            <div class="alert alert-warning" role="alert">
                                <i class="bi bi-exclamation-triangle"></i>
                                <strong>Attenzione:</strong> Questo movimento è {{ $movement->status_label }}.
                                Alcune modifiche potrebbero non essere consentite.
                            </div>
                        @endif

                        <form method="POST" action="{{ route('movements.update', $movement->id) }}" role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('movement.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
