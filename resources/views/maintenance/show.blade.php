@extends('layouts.app')

@section('template_title')
    {{ $maintenance->name ?? __('Dettagli Manutenzione') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="card-title">
                                <i class="bi bi-wrench"></i> {{ __('Dettagli Manutenzione') }}
                            </span>
                            <div>
                                <a class="btn btn-sm btn-warning" href="{{ route('maintenances.edit', $maintenance->id) }}">
                                    <i class="bi bi-pencil"></i> {{ __('Modifica') }}
                                </a>
                                <a class="btn btn-sm btn-primary" href="{{ route('maintenances.index') }}">
                                    <i class="bi bi-arrow-left"></i> {{ __('Torna alla Lista') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Informazioni Principali -->
                                <div class="card mb-3">
                                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informazioni Manutenzione</h5>
                                        <div>

                                    <x-button-modal-form
                                            endpoint="{{ route('cig.storeForm') }}"
                                            label="{{ __('CIG') }}"
                                            url="{{ route('cig.getForm', ['car_id' => $maintenance->car_id, 'maintenance_garage_id' => $maintenance->garage_id]) }}"
                                            modalTitle="Nuovo CIG"
                                            modalClass="modal-xl"
                                            class="btn-primary"
                                            icon="bi-database-fill-add"
                                            event="cig:inserted"
                                    />
                                            {{-- <a href="{{ route('cigs.create', ['car_id' => $maintenance->car_id, 'maintenance_garage_id' => $maintenance->garage_id]) }}" type="button" class="btn btn-sm btn-primary">
                                                <i class="bi bi-file-text"></i> {{ __('Crea CIG') }}
                                            </a> --}}
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <strong>Stato:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                @php
                                                    $isActive = !$maintenance->date_to || $maintenance->date_to >= now();
                                                @endphp
                                                @if($isActive)
                                                    <span class="badge bg-warning text-dark">
                                                        <i class="bi bi-clock"></i> In corso
                                                    </span>
                                                @else
                                                    <span class="badge bg-success">
                                                        <i class="bi bi-check-circle"></i> Completata
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <strong>Tipo Manutenzione:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                <h5 class="mb-0">{{ $maintenance->maintenanceTypes?->name }}</h5>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <strong>Veicolo:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                <i class="bi bi-car-front"></i>
                                                <a href="{{route('cars.show', $maintenance->car_id)}}" class="text-decoration-none">
                                                 {{ $maintenance->car?->full_name }}
                                                </a>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <strong>Targa:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                @if($maintenance->car?->carPlates->count() > 0)
                                                    @foreach($maintenance->car?->carPlates as $plate)
                                                        <span class="badge bg-primary">{{ $plate->name }}</span>
                                                    @endforeach
                                                @else
                                                    <span class="text-muted">Nessuna targa attiva</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <strong>Officina:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                <i class="bi bi-car-front"></i>
                                                <a href="{{route('maintenance-garages.show', $maintenance->garage_id)}}" class="text-decoration-none">
                                                    {{ $maintenance->maintenanceGarages?->name }}
                                                    @if($maintenance->maintenanceGarages?->address)
                                                        <br>
                                                        <small class="text-muted">{{$maintenance->maintenanceGarages?->address}}</small>
                                                    @endif
                                                </a>
                                            </div>
                                        </div>


                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <strong>Periodo:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                <i class="bi bi-calendar"></i> {{ $maintenance->date_from->format('d/m/Y') }}
                                                @if($maintenance->date_to)
                                                    - {{ $maintenance->date_to->format('d/m/Y') }}
                                                    @php
                                                        $duration = $maintenance->date_from->diffInDays($maintenance->date_to) + 1;
                                                    @endphp
                                                    <br><small class="text-muted">Durata: {{ $duration }} {{ $duration == 1 ? 'giorno' : 'giorni' }}</small>
                                                @else
                                                    <br><small class="text-muted">Ancora in corso</small>
                                                @endif
                                            </div>
                                        </div>

                                        @if($maintenance->description)
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <strong>Descrizione:</strong>
                                                </div>
                                                <div class="col-md-8">
                                                    {{ $maintenance->description }}
                                                </div>
                                            </div>
                                        @endif

                                        @if($maintenance->note)
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <strong>Note:</strong>
                                                </div>
                                                <div class="col-md-8">
                                                    <div>
                                                        {{ $maintenance->note }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <hr>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <small class="text-muted">
                                                    <i class="bi bi-clock"></i> Creato il: {{ $maintenance->created_at->format('d/m/Y H:i') }}
                                                </small>
                                            </div>
                                            <div class="col-md-6 text-end">
                                                <small class="text-muted">
                                                    <i class="bi bi-clock-history"></i> Aggiornato il: {{ $maintenance->updated_at->format('d/m/Y H:i') }}
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
