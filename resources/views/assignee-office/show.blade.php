@extends('layouts.app')

@section('template_title')
    {{ $assigneeOffice->name ?? __('Visualizza') . " " . __('Ufficio Assegnatario') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Dettagli') }} Ufficio Assegnatario</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('assignee-offices.index') }}">
                                <i class="bi bi-arrow-left"></i> {{ __('Indietro') }}
                            </a>
                            <a class="btn btn-warning btn-sm" href="{{ route('assignee-offices.edit', $assigneeOffice->id) }}">
                                <i class="bi bi-pencil"></i> {{ __('Modifica') }}
                            </a>
                        </div>
                    </div>

                    <div class="card-body bg-white">

                        {{-- Informazioni Principali --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <strong>Nome Ufficio:</strong>
                                    <p class="text-muted">{{ $assigneeOffice->name }}</p>
                                </div>

                                <div class="form-group mb-3">
                                    <strong>Descrizione:</strong>
                                    <p class="text-muted">{{ $assigneeOffice->description ?: 'Non specificata' }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <strong>Stato:</strong>
                                    <p>
                                        @if($assigneeOffice->isActive())
                                            <span class="badge bg-success">Attivo</span>
                                        @else
                                            <span class="badge bg-secondary">Inattivo</span>
                                        @endif
                                    </p>
                                </div>

                                <div class="form-group mb-3">
                                    <strong>Note:</strong>
                                    <p class="text-muted">{{ $assigneeOffice->note ?: 'Nessuna nota' }}</p>
                                </div>
                            </div>
                        </div>

                        <hr>

                        {{-- Informazioni Assegnatario --}}
                        <h5 class="mb-3">Informazioni Assegnatario</h5>
                        @if($assigneeOffice->carAssignee)
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <strong>Assegnatario:</strong>
                                        <p class="text-muted">
                                            <a href="{{ route('car-assignees.show', $assigneeOffice->carAssignee->id) }}"
                                               class="text-decoration-none">
                                                {{ $assigneeOffice->carAssignee->name }}
                                            </a>
                                        </p>
                                    </div>

                                    <div class="form-group mb-3">
                                        <strong>Periodo Assegnazione:</strong>
                                        <p class="text-muted">
                                            Dal {{ $assigneeOffice->carAssignee->date_from ? $assigneeOffice->carAssignee->date_from->format('d/m/Y') : 'N/A' }}
                                            @if($assigneeOffice->carAssignee->date_to)
                                                al {{ $assigneeOffice->carAssignee->date_to->format('d/m/Y') }}
                                            @else
                                                (In corso)
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <strong>Descrizione Assegnatario:</strong>
                                        <p class="text-muted">{{ $assigneeOffice->carAssignee->description ?: 'Non specificata' }}</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <p class="text-muted">Nessun assegnatario collegato</p>
                        @endif

                        {{-- Informazioni Veicolo --}}
                        @if($assigneeOffice->carAssignee && $assigneeOffice->carAssignee->car)
                            <hr>
                            <h5 class="mb-3">Informazioni Veicolo</h5>
                            @php
                                $car = $assigneeOffice->carAssignee->car;
                                $currentPlate = $car->carPlates->first();
                            @endphp

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <strong>Veicolo:</strong>
                                        <p class="text-muted">
                                            <a href="{{ route('cars.show', $car->id) }}"
                                               class="text-decoration-none">
                                                {{ $car->name }}
                                            </a>
                                        </p>
                                    </div>

                                    <div class="form-group mb-3">
                                        <strong>Targa Attuale:</strong>
                                        <p>
                                            @if($currentPlate)
                                                <span class="badge bg-primary">{{ $currentPlate->name }}</span>
                                                <small class="text-muted">({{ $currentPlate->type }})</small>
                                            @else
                                                <span class="text-muted">Nessuna targa attiva</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <strong>Marca e Modello:</strong>
                                        <p class="text-muted">
                                            {{ $car->carBrand ? $car->carBrand->name : 'N/A' }}
                                            {{ $car->model }}
                                        </p>
                                    </div>

                                    <div class="form-group mb-3">
                                        <strong>Proprietario:</strong>
                                        <p class="text-muted">
                                            {{ $car->carOwner ? $car->carOwner->name : 'N/A' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Timestamp --}}
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <small class="text-muted">
                                    <strong>Creato il:</strong> {{ $assigneeOffice->created_at->format('d/m/Y H:i') }}
                                </small>
                            </div>
                            <div class="col-md-6 text-end">
                                <small class="text-muted">
                                    <strong>Ultimo aggiornamento:</strong> {{ $assigneeOffice->updated_at->format('d/m/Y H:i') }}
                                </small>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
