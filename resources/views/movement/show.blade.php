@extends('layouts.app')

@section('template_title')
    Movimento {{ $movement->code }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">
                                <i class="bi bi-eye"></i> {{ __('Dettaglio Movimento') }}: <strong>{{ $movement->code }}</strong>
                                <span class="badge bg-{{ $movement->status_badge_class }} ms-2">{{ $movement->status_label }}</span>
                            </span>
                        </div>
                        <div class="float-right">
                            @if(in_array($movement->status, ['pending', 'approved']))
                                <a class="btn btn-sm btn-warning" href="{{ route('movements.edit', $movement->id) }}">
                                    <i class="bi bi-pencil"></i> {{ __('Modifica') }}
                                </a>
                            @endif
                            <a class="btn btn-sm btn-secondary" href="{{ route('movements.index') }}">
                                <i class="bi bi-arrow-left"></i> {{ __('Torna alla lista') }}
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            {{-- Colonna Sinistra --}}
                            <div class="col-md-8">
                                {{-- Informazioni Principali --}}
                                <div class="card mb-3">
                                    <div class="card-header bg-primary text-white">
                                        <i class="bi bi-info-circle"></i> Informazioni Movimento
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p><strong>Tipo:</strong>
                                                    <span class="badge bg-secondary">{{ $movement->type_label }}</span>
                                                </p>
                                                <p><strong>Scopo:</strong> {{ $movement->purpose }}</p>
                                                @if($movement->purpose_details)
                                                    <p><strong>Dettagli:</strong><br>{{ $movement->purpose_details }}</p>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                @if($movement->mission_order)
                                                    <p><strong>Ordine di Missione:</strong> {{ $movement->mission_order }}</p>
                                                @endif
                                                @if($movement->requires_overnight)
                                                    <p><strong>Pernottamento:</strong>
                                                        <i class="bi bi-check-circle text-success"></i> Sì
                                                        @if($movement->overnight_location)
                                                            - {{ $movement->overnight_location }}
                                                        @endif
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Veicolo e Personale --}}
                                <div class="card mb-3">
                                    <div class="card-header bg-info text-white">
                                        <i class="bi bi-truck"></i> Veicolo e Personale
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Veicolo</h6>
                                                <p>
                                                    <strong>{{ $movement->car->name }}</strong><br>
                                                    @if($movement->car->carPlates->first())
                                                        <i class="bi bi-credit-card"></i> Targa: {{ $movement->car->carPlates->first()->name }}<br>
                                                    @endif
                                                    @if($movement->car->carBrand)
                                                        <i class="bi bi-tag"></i> {{ $movement->car->carBrand->name }}<br>
                                                    @endif
                                                    @if($movement->car->carType)
                                                        <i class="bi bi-car-front"></i> {{ $movement->car->carType->name }}<br>
                                                    @endif
                                                    @if($movement->car->carPower)
                                                        <i class="bi bi-fuel-pump"></i> {{ $movement->car->carPower->name }}
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Personale</h6>
                                                <p>
                                                    <strong>Conducente:</strong>
                                                    <i class="bi bi-person-circle"></i> {{ $movement->driver->name }}<br>

                                                    @if($movement->requested_by)
                                                        <strong>Richiesto da:</strong> {{ $movement->requester->name }}<br>
                                                    @endif

                                                    @if($movement->authorized_by)
                                                        <strong>Autorizzato da:</strong> {{ $movement->authorizer->name }}
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Percorso --}}
                                <div class="card mb-3">
                                    <div class="card-header bg-success text-white">
                                        <i class="bi bi-geo-alt"></i> Percorso
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6><i class="bi bi-geo"></i> Partenza</h6>
                                                <p>
                                                    <strong>{{ $movement->departure_location }}</strong><br>
                                                    @if($movement->departure_address)
                                                        <small class="text-muted">{{ $movement->departure_address }}</small><br>
                                                    @endif
                                                    <i class="bi bi-calendar3"></i>
                                                    {{ $movement->departure_datetime->format('d/m/Y') }}
                                                    <i class="bi bi-clock"></i>
                                                    {{ $movement->departure_datetime->format('H:i') }}

                                                    @if($movement->actual_departure)
                                                        <br><span class="text-success">
                                                            <i class="bi bi-check-circle"></i> Partito alle
                                                            {{ $movement->actual_departure->format('H:i') }}
                                                        </span>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6><i class="bi bi-geo-alt-fill text-danger"></i> Arrivo</h6>
                                                <p>
                                                    <strong>{{ $movement->arrival_location }}</strong><br>
                                                    @if($movement->arrival_address)
                                                        <small class="text-muted">{{ $movement->arrival_address }}</small><br>
                                                    @endif
                                                    <i class="bi bi-calendar3"></i>
                                                    {{ $movement->arrival_datetime->format('d/m/Y') }}
                                                    <i class="bi bi-clock"></i>
                                                    {{ $movement->arrival_datetime->format('H:i') }}

                                                    @if($movement->actual_arrival)
                                                        <br><span class="text-success">
                                                            <i class="bi bi-check-circle"></i> Arrivato alle
                                                            {{ $movement->actual_arrival->format('H:i') }}
                                                        </span>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>

                                        @if($movement->route_type || $movement->formatted_duration)
                                            <hr>
                                            <div class="row">
                                                @if($movement->route_type)
                                                    <div class="col-md-4">
                                                        <p><strong>Tipo percorso:</strong> {{ ucfirst($movement->route_type) }}</p>
                                                    </div>
                                                @endif
                                                @if($movement->formatted_duration)
                                                    <div class="col-md-4">
                                                        <p><strong>Durata:</strong> {{ $movement->formatted_duration }}</p>
                                                    </div>
                                                @endif
                                                @if($movement->estimated_duration)
                                                    <div class="col-md-4">
                                                        <p><strong>Durata stimata:</strong> {{ floor($movement->estimated_duration / 60) }}h {{ $movement->estimated_duration % 60 }}m</p>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                {{-- Chilometraggio --}}
                                <div class="card mb-3">
                                    <div class="card-header bg-dark text-white">
                                        <i class="bi bi-speedometer2"></i> Chilometraggio
                                    </div>
                                    <div class="card-body">
                                        <div class="row text-center">
                                            <div class="col-md-3">
                                                <h6>KM Iniziali</h6>
                                                <h4>{{ $movement->km_start ? number_format($movement->km_start) : '-' }}</h4>
                                            </div>
                                            <div class="col-md-3">
                                                <h6>KM Finali</h6>
                                                <h4>{{ $movement->km_end ? number_format($movement->km_end) : '-' }}</h4>
                                            </div>
                                            <div class="col-md-3">
                                                <h6>KM Percorsi</h6>
                                                <h4 class="text-primary">
                                                    {{ $movement->km_total ? number_format($movement->km_total) : '-' }}
                                                </h4>
                                            </div>
                                            <div class="col-md-3">
                                                <h6>KM Stimati</h6>
                                                <h4 class="text-muted">
                                                    {{ $movement->estimated_km ? number_format($movement->estimated_km) : '-' }}
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Passeggeri --}}
                                @if($movement->passengers_count > 0)
                                    <div class="card mb-3">
                                        <div class="card-header bg-secondary text-white">
                                            <i class="bi bi-people"></i> Passeggeri ({{ $movement->passengers_count }})
                                        </div>
                                        <div class="card-body">
                                            @if($movement->passengers && count($movement->passengers) > 0)
                                                <h6>Passeggeri Interni:</h6>
                                                <ul>
                                                    @foreach($movement->passengers_users as $passenger)
                                                        <li><i class="bi bi-person"></i> {{ $passenger->name }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif

                                            @if($movement->external_passengers)
                                                <h6>Passeggeri Esterni:</h6>
                                                <p>{{ $movement->external_passengers }}</p>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                {{-- Costi --}}
                                @if($movement->total_cost > 0)
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <i class="bi bi-currency-euro"></i> Costi del Movimento
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-sm">
                                                <tbody>
                                                    @if($movement->fuel_cost)
                                                        <tr>
                                                            <td><i class="bi bi-fuel-pump"></i> Carburante</td>
                                                            <td>
                                                                @if($movement->fuel_liters)
                                                                    {{ $movement->fuel_liters }} L
                                                                @endif
                                                            </td>
                                                            <td class="text-end">€ {{ number_format($movement->fuel_cost, 2) }}</td>
                                                        </tr>
                                                    @endif
                                                    @if($movement->toll_cost)
                                                        <tr>
                                                            <td><i class="bi bi-cash-coin"></i> Pedaggi</td>
                                                            <td></td>
                                                            <td class="text-end">€ {{ number_format($movement->toll_cost, 2) }}</td>
                                                        </tr>
                                                    @endif
                                                    @if($movement->parking_cost)
                                                        <tr>
                                                            <td><i class="bi bi-p-square"></i> Parcheggi</td>
                                                            <td></td>
                                                            <td class="text-end">€ {{ number_format($movement->parking_cost, 2) }}</td>
                                                        </tr>
                                                    @endif
                                                    @if($movement->other_costs)
                                                        <tr>
                                                            <td><i class="bi bi-cash"></i> Altri costi</td>
                                                            <td>
                                                                @if($movement->cost_notes)
                                                                    <small class="text-muted">{{ $movement->cost_notes }}</small>
                                                                @endif
                                                            </td>
                                                            <td class="text-end">€ {{ number_format($movement->other_costs, 2) }}</td>
                                                        </tr>
                                                    @endif
                                                    <tr class="table-success">
                                                        <td colspan="2"><strong>Totale</strong></td>
                                                        <td class="text-end"><strong>€ {{ number_format($movement->total_cost, 2) }}</strong></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif

                                {{-- Note e Controlli --}}
                                @if($movement->notes || $movement->incidents || $movement->vehicle_damages)
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <i class="bi bi-file-text"></i> Note e Segnalazioni
                                        </div>
                                        <div class="card-body">
                                            @if($movement->notes)
                                                <h6>Note:</h6>
                                                <p>{{ $movement->notes }}</p>
                                            @endif

                                            @if($movement->incidents)
                                                <h6 class="text-danger">Incidenti/Problemi:</h6>
                                                <p class="text-danger">{{ $movement->incidents }}</p>
                                            @endif

                                            @if($movement->vehicle_damages)
                                                <h6 class="text-warning">Danni al veicolo:</h6>
                                                <p class="text-warning">{{ $movement->vehicle_damages }}</p>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                {{-- Controlli Veicolo --}}
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <i class="bi bi-check2-square"></i> Controlli Veicolo
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                @if($movement->vehicle_check_before)
                                                    <p class="text-success">
                                                        <i class="bi bi-check-circle-fill"></i>
                                                        Controllo pre-partenza effettuato
                                                    </p>
                                                @else
                                                    <p class="text-muted">
                                                        <i class="bi bi-x-circle"></i>
                                                        Controllo pre-partenza non effettuato
                                                    </p>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                @if($movement->vehicle_check_after)
                                                    <p class="text-success">
                                                        <i class="bi bi-check-circle-fill"></i>
                                                        Controllo post-arrivo effettuato
                                                    </p>
                                                @else
                                                    <p class="text-muted">
                                                        <i class="bi bi-x-circle"></i>
                                                        Controllo post-arrivo non effettuato
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Colonna Destra - Timeline e Azioni --}}
                            <div class="col-md-4">
                                {{-- Azioni Rapide --}}
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <i class="bi bi-lightning"></i> Azioni Rapide
                                    </div>
                                    <div class="card-body">
                                        @if($movement->status == 'pending')
                                            <form action="{{ route('movements.updateStatus', $movement->id) }}" method="POST" class="mb-2">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit" class="btn btn-success w-100">
                                                    <i class="bi bi-check-circle"></i> Approva Movimento
                                                </button>
                                            </form>
                                        @endif

                                        @if($movement->status == 'approved')
                                            <form action="{{ route('movements.updateStatus', $movement->id) }}" method="POST" class="mb-2">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="in_progress">
                                                <button type="submit" class="btn btn-info w-100">
                                                    <i class="bi bi-play-circle"></i> Inizia Movimento
                                                </button>
                                            </form>
                                        @endif

                                        @if($movement->status == 'in_progress')
                                            <form action="{{ route('movements.updateStatus', $movement->id) }}" method="POST" class="mb-2">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="completed">
                                                <button type="submit" class="btn btn-success w-100">
                                                    <i class="bi bi-check2-all"></i> Completa Movimento
                                                </button>
                                            </form>
                                        @endif

                                        @if(!in_array($movement->status, ['completed', 'cancelled']))
                                            <form action="{{ route('movements.updateStatus', $movement->id) }}" method="POST" class="mb-2">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="cancelled">
                                                <button type="submit" class="btn btn-danger w-100"
                                                        onclick="return confirm('Sei sicuro di voler annullare questo movimento?')">
                                                    <i class="bi bi-x-circle"></i> Annulla Movimento
                                                </button>
                                            </form>
                                        @endif

                                        @if($movement->status == 'cancelled')
                                            <form action="{{ route('movements.destroy', $movement->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger w-100" data-confirm-delete="true">
                                                    <i class="bi bi-trash"></i> Elimina Definitivamente
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>

                                {{-- Timeline --}}
                                <div class="card">
                                    <div class="card-header">
                                        <i class="bi bi-clock-history"></i> Timeline Movimento
                                    </div>
                                    <div class="card-body">
                                        <div class="timeline">
                                            @foreach($timeline as $event)
                                                <div class="timeline-item">
                                                    <div class="timeline-marker
                                                        @if($event['type'] == 'created') bg-primary
                                                        @elseif($event['type'] == 'approved') bg-success
                                                        @elseif($event['type'] == 'departed') bg-info
                                                        @elseif($event['type'] == 'arrived') bg-success
                                                        @elseif($event['type'] == 'completed') bg-success
                                                        @elseif($event['type'] == 'cancelled') bg-danger
                                                        @else bg-secondary
                                                        @endif">
                                                    </div>
                                                    <div class="timeline-content">
                                                        <h6 class="mb-0">{{ $event['description'] }}</h6>
                                                        <small class="text-muted">
                                                            {{ $event['date']->format('d/m/Y H:i') }}
                                                            @if($event['user'])
                                                                - {{ $event['user'] }}
                                                            @endif
                                                        </small>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                {{-- Metadati --}}
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <i class="bi bi-info-square"></i> Informazioni Sistema
                                    </div>
                                    <div class="card-body small text-muted">
                                        <p class="mb-1">
                                            <strong>Creato:</strong>
                                            {{ $movement->created_at->format('d/m/Y H:i') }}
                                            @if($movement->creator)
                                                da {{ $movement->creator->name }}
                                            @endif
                                        </p>
                                        @if($movement->updated_at != $movement->created_at)
                                            <p class="mb-1">
                                                <strong>Modificato:</strong>
                                                {{ $movement->updated_at->format('d/m/Y H:i') }}
                                                @if($movement->updater)
                                                    da {{ $movement->updater->name }}
                                                @endif
                                            </p>
                                        @endif
                                        @if($movement->deleted_at)
                                            <p class="mb-1 text-danger">
                                                <strong>Cancellato:</strong>
                                                {{ $movement->deleted_at->format('d/m/Y H:i') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
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
