@extends('layouts.app')

@section('template_title')
    {{ $maintenanceGarage->name ?? __('Dettagli Officina') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="card-title">
                                <i class="bi bi-building"></i> {{ __('Dettagli Officina') }}
                            </span>
                            <div>
                                <a class="btn btn-sm btn-warning" href="{{ route('maintenance-garages.edit', $maintenanceGarage->id) }}">
                                    <i class="bi bi-pencil"></i> {{ __('Modifica') }}
                                </a>
                                <a class="btn btn-sm btn-primary" href="{{ route('maintenance-garages.index') }}">
                                    <i class="bi bi-arrow-left"></i> {{ __('Torna alla Lista') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <!-- Informazioni Principali -->
                                <div class="card mb-3">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informazioni Officina</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <strong>Nome Officina:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                <h5 class="mb-0">{{ $maintenanceGarage->name }}</h5>
                                            </div>
                                        </div>

                                        @if($maintenanceGarage->description)
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <strong>Descrizione:</strong>
                                                </div>
                                                <div class="col-md-8">
                                                    {{ $maintenanceGarage->description }}
                                                </div>
                                            </div>
                                        @endif

                                        <hr>

                                        <!-- Dati Fiscali -->
                                        <h6 class="mb-3"><i class="bi bi-receipt"></i> Dati Fiscali</h6>

                                        <div class="row mb-2">
                                            <div class="col-md-4">
                                                <strong>Partita IVA:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                {{ $maintenanceGarage->piva ?? 'Non specificata' }}
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-md-4">
                                                <strong>Codice Fiscale:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                {{ $maintenanceGarage->cf ?? 'Non specificato' }}
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-md-4">
                                                <strong>IBAN:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                @if($maintenanceGarage->iban)
                                                    <code>{{ $maintenanceGarage->iban }}</code>
                                                @else
                                                    Non specificato
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-md-4">
                                                <strong>PEC:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                @if($maintenanceGarage->pec)
                                                    <a href="mailto:{{ $maintenanceGarage->pec }}">{{ $maintenanceGarage->pec }}</a>
                                                @else
                                                    Non specificata
                                                @endif
                                            </div>
                                        </div>

                                        <hr>

                                        <!-- Certificazioni -->
                                        <h6 class="mb-3"><i class="bi bi-shield-check"></i> Certificazioni</h6>

                                        <div class="row mb-2">
                                            <div class="col-md-4">
                                                <strong>Accreditamento:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                @if($maintenanceGarage->acc == 'yes')
                                                    <span class="badge bg-success">
                                                        <i class="bi bi-check-circle"></i> Accreditata
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary">
                                                        <i class="bi bi-x-circle"></i> Non accreditata
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-md-4">
                                                <strong>Certificazione Antimafia:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                @if($maintenanceGarage->anti_mafia == 'yes')
                                                    <span class="badge bg-success">
                                                        <i class="bi bi-shield-check"></i> Presente
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary">
                                                        <i class="bi bi-shield-x"></i> Non presente
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-md-4">
                                                <strong>DURC:</strong>
                                            </div>
                                            <div class="col-md-8">
                                                @if($maintenanceGarage->durc)
                                                    @php
                                                        $durcDate = \Carbon\Carbon::parse($maintenanceGarage->durc);
                                                        $isExpired = $durcDate->isPast();
                                                        $isExpiringSoon = $durcDate->isBetween(now(), now()->addDays(30));
                                                    @endphp
                                                    <span class="badge bg-{{ $isExpired ? 'danger' : ($isExpiringSoon ? 'warning' : 'success') }}">
                                                        <i class="bi bi-calendar-check"></i> Scadenza: {{ $durcDate->format('d/m/Y') }}
                                                    </span>
                                                    @if($isExpired)
                                                        <span class="text-danger ms-2">
                                                            <i class="bi bi-exclamation-triangle"></i> Scaduto da {{ $durcDate->diffInDays(now()) }} giorni
                                                        </span>
                                                    @elseif($isExpiringSoon)
                                                        <span class="text-warning ms-2">
                                                            <i class="bi bi-exclamation-triangle"></i> In scadenza tra {{ now()->diffInDays($durcDate) }} giorni
                                                        </span>
                                                    @else
                                                        <span class="text-success ms-2">
                                                            <i class="bi bi-check-circle"></i> Valido per {{ now()->diffInDays($durcDate) }} giorni
                                                        </span>
                                                    @endif
                                                @else
                                                    <span class="text-muted">Non specificato</span>
                                                @endif
                                            </div>
                                        </div>

                                        @if($maintenanceGarage->note)
                                            <hr>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <strong>Note:</strong>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="alert alert-light">
                                                        {{ $maintenanceGarage->note }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <hr>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <small class="text-muted">
                                                    <i class="bi bi-clock"></i> Creato il: {{ $maintenanceGarage->created_at->format('d/m/Y H:i') }}
                                                </small>
                                            </div>
                                            <div class="col-md-6 text-end">
                                                <small class="text-muted">
                                                    <i class="bi bi-clock-history"></i> Aggiornato il: {{ $maintenanceGarage->updated_at->format('d/m/Y H:i') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- CIG Collegati -->
                                @if($maintenanceGarage->cigs->count() > 0)
                                    <div class="card">
                                        <div class="card-header bg-secondary text-white">
                                            <h5 class="mb-0"><i class="bi bi-file-earmark-text"></i> CIG Collegati</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>CIG</th>
                                                            <th>Data</th>
                                                            <th>Descrizione</th>
                                                            <th>Importo</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($maintenanceGarage->cigs as $cig)
                                                            <tr>
                                                                <td><strong>{{ $cig->cig }}</strong></td>
                                                                <td>{{ $cig->date ? \Carbon\Carbon::parse($cig->date)->format('d/m/Y') : '-' }}</td>
                                                                <td>{{ $cig->description ?? '-' }}</td>
                                                                <td>
                                                                    @if($cig->taxable)
                                                                        € {{ number_format($cig->taxable, 2, ',', '.') }}
                                                                    @else
                                                                        -
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="col-md-4">
                                <!-- Info Manutenzione -->
                                <div class="card mb-3">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="mb-0"><i class="bi bi-wrench"></i> Manutenzione</h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="mb-2">
                                            <strong>Tipo:</strong> {{ $maintenanceGarage->maintenance->name }}
                                        </p>
                                        <p class="mb-2">
                                            <strong>Veicolo:</strong> {{ $maintenanceGarage->maintenance->car->name }}
                                            @if($maintenanceGarage->maintenance->car->carPlates->count() > 0)
                                                <br><span class="badge bg-primary">{{ $maintenanceGarage->maintenance->car->carPlates->first()->name }}</span>
                                            @endif
                                        </p>
                                        <p class="mb-2">
                                            <strong>Periodo:</strong><br>
                                            {{ $maintenanceGarage->maintenance->date_from->format('d/m/Y') }}
                                            @if($maintenanceGarage->maintenance->date_to)
                                                - {{ $maintenanceGarage->maintenance->date_to->format('d/m/Y') }}
                                            @else
                                                (In corso)
                                            @endif
                                        </p>
                                        <div class="d-grid">
                                            <a href="{{ route('maintenances.show', $maintenanceGarage->maintenance->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-eye"></i> Vedi Manutenzione
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Azioni Rapide -->
                                <div class="card">
                                    <div class="card-header bg-info text-white">
                                        <h5 class="mb-0"><i class="bi bi-lightning"></i> Azioni Rapide</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-grid gap-2">
                                            <a href="{{ route('cigs.create', ['maintenance_garage_id' => $maintenanceGarage->id]) }}" class="btn btn-outline-info">
                                                <i class="bi bi-file-earmark-text-fill"></i> Aggiungi CIG
                                            </a>
                                            <a href="{{ route('maintenance-garages.edit', $maintenanceGarage->id) }}" class="btn btn-outline-warning">
                                                <i class="bi bi-pencil"></i> Modifica Officina
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Alert DURC -->
                                @if($maintenanceGarage->durc)
                                    @php
                                        $durcDate = \Carbon\Carbon::parse($maintenanceGarage->durc);
                                        $isExpired = $durcDate->isPast();
                                        $isExpiringSoon = $durcDate->isBetween(now(), now()->addDays(30));
                                    @endphp
                                    @if($isExpired || $isExpiringSoon)
                                        <div class="alert alert-{{ $isExpired ? 'danger' : 'warning' }} mt-3">
                                            <i class="bi bi-exclamation-triangle"></i>
                                            <strong>Attenzione!</strong><br>
                                            @if($isExpired)
                                                Il DURC è scaduto. È necessario richiedere il rinnovo.
                                            @else
                                                Il DURC scadrà tra {{ now()->diffInDays($durcDate) }} giorni.
                                            @endif
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
