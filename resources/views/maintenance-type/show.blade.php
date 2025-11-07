@extends('layouts.app')

@section('template_title')
    {{ $maintenanceType->name ?? __('Dettagli Tipo Intervento') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="card-title">
                                <i class="bi bi-tools"></i> {{ __('Dettagli Tipo Intervento') }}
                            </span>
                            <div>
                                <a class="btn btn-sm btn-warning"
                                   href="{{ route('maintenance-types.edit', $maintenanceType->id) }}">
                                    <i class="bi bi-pencil"></i> {{ __('Modifica') }}
                                </a>
                                <a class="btn btn-sm btn-primary" href="{{ route('maintenance-types.index') }}">
                                    <i class="bi bi-arrow-left"></i> {{ __('Torna alla Lista') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8 offset-md-2">
                                <!-- Informazioni Principali -->
                                <div class="card mb-3">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informazioni Intervento</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <strong>Tipo Intervento:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                <h5 class="mb-0">{{ $maintenanceType->name }}</h5>
                                            </div>
                                        </div>

                                        @if($maintenanceType->description)
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <strong>Descrizione:</strong>
                                                </div>
                                                <div class="col-md-8">
                                                    {{ $maintenanceType->description }}
                                                </div>
                                            </div>
                                        @endif

                                        @if($maintenanceType->note)
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <strong>Note:</strong>
                                                </div>
                                                <div class="col-md-8 fst-italic">
                                                    {{ $maintenanceType->note }}
                                                </div>
                                            </div>
                                        @endif

                                        <hr>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <small class="text-muted">
                                                    <i class="bi bi-clock"></i> Creato
                                                    il: {{ $maintenanceType->created_at->format('d/m/Y H:i') }}
                                                </small>
                                            </div>
                                            <div class="col-md-6 text-end">
                                                <small class="text-muted">
                                                    <i class="bi bi-clock-history"></i> Aggiornato
                                                    il: {{ $maintenanceType->updated_at->format('d/m/Y H:i') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
