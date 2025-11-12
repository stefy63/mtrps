@extends('layouts.app')

@section('template_title')
    {{ $car->name ?? __('Show') . " " . __('Car') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"
                         style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Dati Vettura') }} : {{ $car->full_name }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-sm btn-warning" href="{{ route('cars.edit', $car->id) }}">
                                <i class="bi bi-pencil"></i> {{ __('Modifica') }}
                            </a>
                            <a class="btn btn-primary btn-sm" href="{{ route('cars.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-car-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-car" type="button" role="tab" aria-controls="nav-car"
                                        aria-selected="true">Vettura
                                </button>
                                <button class="nav-link" id="nav-movement-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-movement" type="button" role="tab"
                                        aria-controls="nav-movement" aria-selected="false">Movimenti
                                </button>
                                <button class="nav-link" id="nav-maintenance-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-maintenance" type="button" role="tab"
                                        aria-controls="nav-maintenance" aria-selected="false">Manutenzioni
                                </button>
                            </div>
                        </nav>


                        <div class="tab-content" id="nav-tabContent">
                            {{--                            Vettura --}}
                            <div class="tab-pane fade show active" id="nav-car" role="tabpanel"
                                 aria-labelledby="nav-car-tab">
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group mb-2 mb20">
                                            <strong>Marca:</strong>
                                            {{ $car->carBrand?->name ?? 'N/A' }}
                                        </div>

                                        <div class="form-group mb-2 mb20">
                                            <strong>Tipo Veicolo:</strong>
                                            {{ $car->carType?->name ?? 'N/A' }}
                                        </div>

                                        <div class="form-group mb-2 mb20">
                                            <strong>Proprietario:</strong>
                                            {{ $car->carOwner?->name ?? 'N/A' }}
                                        </div>


                                        <div class="form-group mb-2 mb20">
                                            <strong>Alimentazione:</strong>
                                            {{ $car->carPower?->name ?? 'N/A' }}
                                        </div>

                                        <div class="form-group mb-2 mb20">
                                            <strong>Conto:</strong>
                                            {{ $car->profit_account ?? 'N/A' }}
                                        </div>

                                        <div class="form-group mb-2 mb20">
                                            <strong>Tipologia di Mezzo:</strong>
                                            {{ $car->car_typology ?? 'N/A' }}
                                        </div>

                                        <div class="form-group mb-2 mb20">
                                            <strong>Colore:</strong>
                                            {{ $car->color ?? 'N/A' }}
                                        </div>

                                        <div class="form-group mb-2 mb20">
                                            <strong>Serbatoio:</strong>
                                            {{ $car->tank ? $car->tank . ' L' : 'N/A' }}
                                        </div>

                                        <div class="form-group mb-2 mb20">
                                            <strong>Chilometraggio:</strong>
                                            {{ $car->km ? number_format($car->km) . ' km' : 'N/A' }}
                                        </div>

                                        <div class="form-group mb-2 mb20">
                                            <strong>Pneumatici Invernali:</strong>
                                            <span class="badge badge-{{ $car->winter_wheels ? 'success' : 'secondary' }}">
                                        {{ $car->winter_wheels ? 'Sì' : 'No' }}
                                    </span>
                                        </div>

                                        <div class="form-group mb-2 mb20">
                                            <strong>Tipo Pneumatici:</strong>
                                            {{ $car->wheels_type ?? 'N/A' }}
                                        </div>

                                    </div>

                                    <div class="col-md-6">


                                        <div class="form-group mb-2 mb20">
                                            <strong>Garanzia:</strong>
                                            {{ $car->warranty ?? 'N/A' }}
                                        </div>

                                        <div class="form-group mb-2 mb20">
                                            <strong>Telefono Assistenza:</strong>
                                            {{ $car->tel_warranty ?? 'N/A' }}
                                        </div>

                                        <div class="form-group mb-2 mb20">
                                            <strong>Telaio:</strong>
                                            {{ $car->chassis ?? 'N/A' }}
                                        </div>

                                        <div class="form-group mb-2 mb20">
                                            <strong>Data Revisione:</strong>
                                            {{ $car->date_revision ? \Carbon\Carbon::parse($car->date_revision)->format('d/m/Y') : 'N/A' }}
                                        </div>

                                        <div class="form-group mb-2 mb20">
                                            <strong>Targhe:</strong>
                                            @foreach($car->carPlates as $c)
                                                <div class="row ms-3"><u class="col-3">{{ $c->type }}:</u> <strong
                                                            class="col">{{ $c->name }}</strong></div>
                                            @endforeach
                                        </div>

                                        @if($car->carOffices->count() > 0)
                                            <div class="form-group mb-2 mb20">
                                                <strong>Assegnatario:</strong>
                                                {{ $car->carOffices[0]->full_name }}
                                            </div>
                                        @endif

                                        @if($car->carEquipment)
                                            <div class="form-group mb-2 mb20">
                                                <strong>Equipaggiamento:</strong>
                                                @foreach($car->carEquipment as $c)
                                                    <div class="ms-3 row">
                                                        <u class="col-6">{{ $c->name }}:</u>
                                                        <strong class="col">{{ $c->pivot->note }}</strong></div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @if($car->description)
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <div class="form-group mb-2 mb20">
                                                <strong>Descrizione:</strong>
                                                <p>{{ $car->description }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($car->note)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-2 mb20"
                                                 x-data="{note: '{{str_replace(["\r\n", "\n", "\r"], '<br>', $car->note)}}'}">
                                                <strong>Note:</strong>
                                                <p x-html="note"></p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="form-group mb-2 mb20">
                                            <small class="text-muted">
                                                <strong>Creato:</strong> {{ $car->created_at->format('d/m/Y H:i') }} |
                                                <strong>Aggiornato:</strong> {{ $car->updated_at->format('d/m/Y H:i') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--                            Movimenti--}}
                            <div class="tab-pane fade" id="nav-movement" role="tabpanel"
                                 aria-labelledby="nav-movement-tab">
                                <div class="text-end m-2">

                                    <x-button-modal-form
                                            endpoint="{{ route('movement.storeForm') }}"
                                            label="{{ __('Movimento') }}"
                                            url="{{ route('movement.getForm', ['car_id' => $car->id]) }}"
                                            modalTitle="Nuovo Movimento"
                                            modalClass="modal-xl"
                                            class="btn-primary"
                                            icon="bi-database-fill-add"
                                    />
                                </div>
                                <table class="table table-hover table-responsive">
                                    <thead>
                                    <tr>
                                        <th scope="col">Codice</th>
                                        <th scope="col">Ufficio</th>
                                        <th scope="col">Dal</th>
                                        <th scope="col">Al</th>
                                        <th scope="col">Note</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($car->movements))
                                        @foreach($car->movements as $m)
                                            @php
                                                $movementIsActive = !$m->date_to || $m->date_to >= now();
                                            @endphp
                                            <tr>
                                                <td class="col-2">
                                                    <a href="{{ route('movements.edit', $m->id) }}"
                                                       class="text-decoration-none">
                                                        <strong>{{ $m->code }}</strong>
                                                    </a>
                                                </td>
                                                <td class="col-3">{{$m->office->full_name}}</td>
                                                <td class="col-2">{{date('d/m/Y', strtotime($m->date_from))}}</td>
                                                <td class="col-2">
                                                    @if($movementIsActive)
                                                        <span class="badge bg-warning text-dark w-75">
                                                            <i class="bi bi-clock"></i> In corso
                                                        </span>
                                                    @else
                                                        <span class="badge bg-success">
                                                            <i class="bi bi-check-circle"></i> Completata
                                                        </span>
                                                    @endif
{{--                                                    {{$m->date_to ? date('d/m/Y', strtotime($m->date_to)) : '---'}}</td>--}}
                                                <td class="col-3">{{$m->note}}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            {{--                            Manutenzioni--}}
                            <div class="tab-pane fade" id="nav-maintenance" role="tabpanel"
                                 aria-labelledby="nav-maintenance-tab">

                                <div class="text-end m-2">
                                    <x-button-modal-form
                                            endpoint="{{ route('maintenance.storeForm') }}"
                                            label="{{ __('Manutenzioni') }}"
                                            url="{{ route('maintenance.getForm', ['car_id' => $car->id]) }}"
                                            modalTitle="Nuova Manutenzione"
                                            modalClass="modal-xl"
                                            class="btn-primary"
                                            icon="bi-database-fill-add"
                                    />
                                </div>
                                <table class="table table-hover table-responsive">
                                    <thead>
                                    <tr>
                                        <th class="col-2">Officina</th>
                                        <th class="col-2">Indirizzo</th>
                                        <th class="col-1">Telefoni</th>
                                        <th class="col-2">Mail/PEC</th>
                                        <th class="col-1">Tipo intervento</th>
                                        <th class="col-1">Dal</th>
                                        <th class="col-1">Al</th>
                                        <th class="col-2">Note</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($car->maintenances->count())
                                        @foreach($car->maintenances as $m)
                                            @php
                                                $maintenanceIsActive = !$m->date_to || $m->date_to >= now();
                                            @endphp
                                            <tr>
                                                <td class="text-truncate">
                                                    <a href="{{route('maintenances.show', $m->id)}}"
                                                       class="text-decoration-none">
                                                        {{$m->maintenanceGarages?->name ?? ''}}
                                                    </a>
                                                </td>
                                                <td class="text-truncate">{{$m->maintenanceGarages?->address ?? ''}}</td>
                                                <td class="text-truncate">
                                                    @if($m->maintenanceGarages?->phone1)
                                                        <small class="text-muted">
                                                            Uff: {{$m->maintenanceGarages?->phone1 }}
                                                        </small><br>
                                                    @endif
                                                    @if($m->maintenanceGarages?->phone2)
                                                        <small class="text-muted">
                                                            Fax: {{$m->maintenanceGarages?->phone2 }}
                                                        </small><br>
                                                    @endif
                                                    @if($m->maintenanceGarages?->phone3)
                                                        <small class="text-muted">
                                                            Resp: {{$m->maintenanceGarages?->phone3 }}
                                                        </small>
                                                    @endif
                                                </td>
                                                <td class="text-truncate">
                                                    @if($m->maintenanceGarages?->mail)
                                                        <small class="text-muted">
                                                            Mail: {{$m->maintenanceGarages?->mail }}
                                                        </small><br>
                                                    @endif
                                                    @if($m->maintenanceGarages?->pec)
                                                        <small class="text-muted">
                                                            Pec: {{$m->maintenanceGarages?->pec }}
                                                        </small><br>
                                                    @endif</td>
                                                <td>{{$m->maintenanceTypes?->name ?? ''}}</td>
                                                <td>{{date('d/m/Y', strtotime($m->date_from))}}</td>
                                                <td>
                                                    @if($maintenanceIsActive)
                                                        <span class="badge bg-warning text-dark w-75">
                                                            <i class="bi bi-clock"></i> In corso
                                                        </span>
                                                    @else
                                                        <span class="badge bg-success">
                                                            <i class="bi bi-check-circle"></i> Completata
                                                        </span>
                                                    @endif
{{--                                                    {{$m->date_to ? date('d/m/Y', strtotime($m->date_to)) : '---'}}</td>--}}
                                                <td>{{$m->note}}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection