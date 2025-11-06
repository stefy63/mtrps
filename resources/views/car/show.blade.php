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
                                                    <div class="ms-3 row"><u class="col-3">{{ $c->name }}:</u> <strong
                                                                class="col">{{ $c->pivot->note }}</strong></div>
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
                                            <tr>
                                                <td class="col-3">
                                                    <a href="{{ route('movements.edit', $m->id) }}"
                                                       class="text-decoration-none">
                                                        <strong>{{ $m->code }}</strong>
                                                    </a>
                                                </td>
                                                <td class="col-3">{{$m->office->full_name}}</td>
                                                <td class="col-3">{{date('d/m/Y', strtotime($m->date_from))}}</td>
                                                <td class="col-3">{{$m->date_to ? date('d/m/Y', strtotime($m->date_to)) : '---'}}</td>
                                                <td class="col-3">{{$m->note}}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="nav-maintenance" role="tabpanel"
                                 aria-labelledby="nav-maintenance-tab">

                                <table class="table table-hover table-responsive">
                                    <thead>
                                    <tr>
                                        <th scope="col">Officina</th>
                                        <th scope="col">Tipo intervento</th>
                                        <th scope="col">Dal</th>
                                        <th scope="col">Al</th>
                                        <th scope="col">Note</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($car->maintenances->count())
                                        @foreach($car->maintenances as $m)
                                            <tr>
                                                <td class="col-3">{{$m->maintenanceGarages->name ?? ''}}</td>
                                                <td class="col-3">{{$m->maintenanceTypes->name ?? ''}}</td>
                                                <td class="col-3">{{date('d/m/Y', strtotime($m->date_from))}}</td>
                                                <td class="col-3">{{$m->date_to ? date('d/m/Y', strtotime($m->date_to)) : '---'}}</td>
                                                <td class="col-3">{{$m->note}}</td>
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