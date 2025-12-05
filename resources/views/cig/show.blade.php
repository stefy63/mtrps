@extends('layouts.app')

@section('template_title')
    CIG {{ $cig->cig }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="card-title">
                                <i class="bi bi-file-earmark-text"></i> CIG {{ $cig->cig }}
                            </span>
                            <div>
                                <a class="btn btn-sm btn-warning" href="{{ route('cigs.edit', $cig->id) }}">
                                    <i class="bi bi-pencil"></i> {{ __('Modifica') }}
                                </a>
                                <a class="btn btn-sm btn-primary" href="{{ route('cigs.index') }}">
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
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informazioni CIG</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <strong>Codice CIG:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                <h4 class="mb-0 text-primary">{{ $cig->cig }}</h4>
                                            </div>
                                        </div>

                                        @if($cig->ce)
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <strong>Codice CE:</strong>
                                                </div>
                                                <div class="col-md-8">
                                                    {{ $cig->ce }}
                                                </div>
                                            </div>
                                        @endif

                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <strong>Data:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                @if($cig->date)
                                                    <i class="bi bi-calendar"></i> {{ $cig->date->format('d/m/Y') }}
                                                @else
                                                    <span class="text-muted">Non specificata</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <strong>Veicolo:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                <i class="bi bi-car-front"></i> {{ $cig->car->full_name }}
                                                @if($cig->car->carBrand)
                                                    <br><small class="text-muted">{{ $cig->car->carBrand->name }}</small>
                                                @endif
                                                @if($cig->car->carPlates->count() > 0)
                                                    <br><span class="badge bg-primary">{{ $cig->car->carPlates->first()->name }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <strong>Officina:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                <i class="bi bi-building"></i> {{ $cig->maintenanceGarage->name }}
                                                @if($cig->maintenanceGarage->piva)
                                                    <br><small class="text-muted">P.IVA: {{ $cig->maintenanceGarage->piva }}</small>
                                                @endif
                                                @if($cig->maintenanceGarage->cf)
                                                    <br><small class="text-muted">CF: {{ $cig->maintenanceGarage->cf }}</small>
                                                @endif
                                            </div>
                                        </div>

                                        @if($cig->description)
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <strong>Descrizione:</strong>
                                                </div>
                                                <div class="col-md-8">
                                                    {{ $cig->description }}
                                                </div>
                                            </div>
                                        @endif

                                        <hr>

                                        <!-- Importi -->
                                        <h6 class="mb-3"><i class="bi bi-currency-euro"></i> Importi</h6>

                                        <div class="row mb-2">
                                            <div class="col-md-4">
                                                <strong>Imponibile:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                @if($cig->taxable)
                                                    € {{ number_format($cig->taxable, 2, ',', '.') }}
                                                @else
                                                    <span class="text-muted">Non specificato</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-md-4">
                                                <strong>IVA:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                @if($cig->vat)
                                                    € {{ number_format($cig->vat, 2, ',', '.') }}
                                                @else
                                                    <span class="text-muted">Non specificata</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <strong>Totale:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                @if($cig->taxable || $cig->vat)
                                                    <h5 class="mb-0 text-danger">€ {{ number_format($cig->taxable + $cig->vat, 2, ',', '.') }}</h5>
                                                @else
                                                    <span class="text-muted">Non specificato</span>
                                                @endif
                                            </div>
                                        </div>

                                        <hr>

                                        <!-- Responsabili -->
                                        <h6 class="mb-3"><i class="bi bi-people"></i> Responsabili</h6>

                                        <div class="row mb-2">
                                            <div class="col-md-4">
                                                <strong>RUP:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                @if($cig->userRup)
                                                    <i class="bi bi-person-fill"></i> {{ $cig->userRup->name }}
                                                @else
                                                    <span class="text-muted">Non specificato</span>
                                                @endif
                                            </div>
                                        </div>

                                        @if($cig->userSupport)
                                            <div class="row mb-2">
                                                <div class="col-md-4">
                                                    <strong>Supporto RUP:</strong>
                                                </div>
                                                <div class="col-md-8">
                                                    <i class="bi bi-person"></i> {{ $cig->userSupport->name }}
                                                </div>
                                            </div>
                                        @endif

                                        @if($cig->userTenderNotice)
                                            <div class="row mb-2">
                                                <div class="col-md-4">
                                                    <strong>Resp. Bando:</strong>
                                                </div>
                                                <div class="col-md-8">
                                                    <i class="bi bi-person"></i> {{ $cig->userTenderNotice->name }}
                                                </div>
                                            </div>
                                        @endif

                                        @if($cig->userTester)
                                            <div class="row mb-2">
                                                <div class="col-md-4">
                                                    <strong>Collaudatore:</strong>
                                                </div>
                                                <div class="col-md-8">
                                                    <i class="bi bi-person"></i> {{ $cig->userTester->name }}
                                                </div>
                                            </div>
                                        @endif

                                        @if($cig->note)
                                            <hr>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <strong>Note:</strong>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="alert alert-light">
                                                        {{ $cig->note }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <hr>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <small class="text-muted">
                                                    <i class="bi bi-clock"></i> Creato il: {{ $cig->created_at->format('d/m/Y H:i') }}
                                                </small>
                                            </div>
                                            <div class="col-md-6 text-end">
                                                <small class="text-muted">
                                                    <i class="bi bi-clock-history"></i> Aggiornato il: {{ $cig->updated_at->format('d/m/Y H:i') }}
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
