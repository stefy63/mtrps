@extends('layouts.app')

@section('template_title')
    {{ $carEquipment->name ?? __('Visualizza') . " " . __('Equipaggiamento') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Dettagli') }} Equipaggiamento</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('car-equipments.index') }}">
                                <i class="bi bi-arrow-left"></i> {{ __('Indietro') }}
                            </a>
                            <a class="btn btn-warning btn-sm" href="{{ route('car-equipments.edit', $carEquipment->id) }}">
                                <i class="bi bi-pencil"></i> {{ __('Modifica') }}
                            </a>
                            @if($carEquipment->is_active && !$carEquipment->date_to)
                                <a class="btn btn-danger btn-sm" href="{{ route('car-equipments.edit', $carEquipment->id) }}">
                                    <i class="bi bi-x-square"></i> {{ __('Rimuovi Equipaggiamento') }}
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="card-body bg-white">

                        {{-- Informazioni Principali --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <strong><i class="bi {{ $carEquipment->getCategoryIcon() }}"></i> Equipaggiamento:</strong>
                                    <p class="text-muted">{{ $carEquipment->name }}</p>
                                </div>

                                <div class="form-group mb-3">
                                    <strong>Categoria:</strong>
                                    <p class="text-muted">{{ ucfirst($carEquipment->getCategory()) }}</p>
                                </div>

                                <div class="form-group mb-3">
                                    <strong>Descrizione:</strong>
                                    <p class="text-muted">{{ $carEquipment->description ?: 'Non specificata' }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <strong>Stato:</strong>
                                    <p>{!! $carEquipment->status_badge !!}</p>
                                </div>

                                <div class="form-group mb-3">
                                    <strong>Periodo Installazione:</strong>
                                    <p class="text-muted">
                                        Dal {{ $carEquipment->date_from->format('d/m/Y') }}
                                        @if($carEquipment->date_to)
                                            al {{ $carEquipment->date_to->format('d/m/Y') }}
                                        @else
                                            (ancora installato)
                                        @endif
                                    </p>
                                </div>

                                <div class="form-group mb-3">
                                    <strong>Durata:</strong>
                                    <p class="text-muted">
                                        @if($carEquipment->duration_days !== null)
                                            @if($carEquipment->duration_days > 365)
                                                {{ round($carEquipment->duration_days / 365, 1) }} anni
                                            @elseif($carEquipment->duration_days > 30)
                                                {{ round($carEquipment->duration_days / 30, 1) }} mesi
                                            @else
                                                {{ $carEquipment->duration_days }} giorni
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <strong>Note:</strong>
                                    <p class="text-muted">{{ $carEquipment->note ?: 'Nessuna nota' }}</p>
                                </div>
                            </div>
                        </div>

                        <hr>

                        {{-- Informazioni Veicolo --}}
                        <h5 class="mb-3">Informazioni Veicolo</h5>
                        @if($carEquipment->car)
                            @php
                                $car = $carEquipment->car;
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
                                                @if($currentPlate)
                                                    - <span class="badge bg-primary">{{ $currentPlate->name }}</span>
                                                @endif
                                            </a>
                                        </p>
                                    </div>

                                    <div class="form-group mb-3">
                                        <strong>Marca e Modello:</strong>
                                        <p class="text-muted">
                                            {{ $car->carBrand ? $car->carBrand->name : 'N/A' }}
                                            {{ $car->model }}
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <strong>Tipo Veicolo:</strong>
                                        <p class="text-muted">
                                            {{ $car->carType ? $car->carType->name : 'N/A' }}
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

                            {{-- Storia targhe del veicolo durante il periodo di installazione --}}
                            @php
                                $relevantPlates = $car->carPlates->filter(function($plate) use ($carEquipment) {
                                    $plateStart = $plate->date_from;
                                    $plateEnd = $plate->date_to ?? now();
                                    $equipStart = $carEquipment->date_from;
                                    $equipEnd = $carEquipment->date_to ?? now();

                                    return $plateStart <= $equipEnd && $plateEnd >= $equipStart;
                                });
                            @endphp

                            @if($relevantPlates->count() > 0)
                                <div class="alert alert-info">
                                    <strong>Targhe durante il periodo di installazione:</strong>
                                    <ul class="mb-0">
                                        @foreach($relevantPlates as $plate)
                                            <li>
                                                <span class="badge bg-primary">{{ $plate->name }}</span>
                                                ({{ $plate->type }})
                                                - dal {{ $plate->date_from->format('d/m/Y') }}
                                                @if($plate->date_to)
                                                    al {{ $plate->date_to->format('d/m/Y') }}
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        @else
                            <p class="text-muted">Nessun veicolo collegato</p>
                        @endif

                        {{-- Altri equipaggiamenti dello stesso veicolo --}}
                        @if($otherEquipments->count() > 0)
                            <hr>
                            <h5 class="mb-3">Altri Equipaggiamenti del Veicolo</h5>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Equipaggiamento</th>
                                            <th>Periodo</th>
                                            <th>Stato</th>
                                            <th>Azioni</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($otherEquipments as $equipment)
                                            <tr>
                                                <td>
                                                    <i class="bi {{ $equipment->getCategoryIcon() }}"></i>
                                                    {{ $equipment->name }}
                                                </td>
                                                <td>
                                                    {{ $equipment->date_from->format('d/m/Y') }}
                                                    @if($equipment->date_to)
                                                        - {{ $equipment->date_to->format('d/m/Y') }}
                                                    @endif
                                                </td>
                                                <td>{!! $equipment->status_badge !!}</td>
                                                <td>
                                                    <a href="{{ route('car-equipments.show', $equipment->id) }}"
                                                       class="btn btn-sm btn-info">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

                        {{-- Timestamp --}}
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <small class="text-muted">
                                    <strong>Creato il:</strong> {{ $carEquipment->created_at->format('d/m/Y H:i') }}
                                </small>
                            </div>
                            <div class="col-md-6 text-end">
                                <small class="text-muted">
                                    <strong>Ultimo aggiornamento:</strong> {{ $carEquipment->updated_at->format('d/m/Y H:i') }}
                                </small>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
