@extends('layouts.app')

@section('template_title')
    {{ $office->name ?? __('Show') . " " . __('Office') }}
@endsection

@section('content')

    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"
                         style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Dati Ufficio') }} : {{ $office?->full_name ?? ''  }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-sm btn-warning" href="{{ route('offices.edit', $office->id ?? 0) }}">
                                <i class="bi bi-pencil"></i> {{ __('Modifica') }}
                            </a>
                            <a class="btn btn-primary btn-sm" href="{{ route('offices.index') }}"> {{ __('Indice') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-office-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-office" type="button" role="tab" aria-controls="nav-office"
                                        aria-selected="true">Ufficio
                                </button>
                                <button class="nav-link" id="nav-car-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-car" type="button" role="tab"
                                        aria-controls="nav-car" aria-selected="false">Vetture
                                </button>
                                <button class="nav-link" id="nav-movement-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-movement" type="button" role="tab"
                                        aria-controls="nav-movement" aria-selected="false">Movimenti
                                </button>
                            </div>
                        </nav>


                        <div class="tab-content" id="nav-tabContent">
                            {{--                            Ufficio --}}
                            <div class="tab-pane fade show active" id="nav-office" role="tabpanel"
                                 aria-labelledby="nav-office-tab">
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <div class="">
                                            <div class="" style="display: flex; justify-content: space-between; align-items: center;">
                                                <div class="float-left">
                                                    <span class="">Dettagli Ufficio</span>
                                                </div>
                                            </div>
                                            <div class="">
                                                <div class="form-group mb-2 ">
                                                    <strong>Ente:</strong>
                                                    {{ $office->ente }}
                                                </div>
                                                <div class="form-group mb-2 ">
                                                    <strong>Name:</strong>
                                                    {{ $office->name }}
                                                </div>
                                                <div class="form-group mb-2 ">
                                                    <strong>Phone:</strong>
                                                    {{ $office->phone }}
                                                </div>
                                                <div class="form-group mb-2 ">
                                                    <strong>Mail:</strong>
                                                    {{ $office->mail }}
                                                </div>
                                                <div class="form-group mb-2 ">
                                                    <strong>Address:</strong>
                                                    {{ $office->address }}
                                                </div>
                                                <div class="form-group mb-2 ">
                                                    <strong>Description:</strong>
                                                    {{ $office->description }}
                                                </div>
                                                <div class="form-group mb-2 ">
                                                    <strong>Note:</strong>
                                                    {{ $office->note }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{--                            Vetture--}}
                            <div class="tab-pane fade" id="nav-car" role="tabpanel"
                                 aria-labelledby="nav-car-tab">

                                <table class="table table-hover table-responsive">
                                    <thead>
                                    <tr>
                                        <th class="col-1">Targa</th>
                                        <th class="col-2">Modello</th>
                                        <th class="col-2">Tipologia</th>
                                        <th class="col-2">Colore</th>
                                        <th class="col-1">Km</th>
                                        <th class="col-4">Note</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($office->cars->count())
                                        @foreach($office->cars as $car)
                                            <tr>
                                                <td class="text-truncate">
                                                   <ul class="list-unstyled">
                                                    @foreach($car->carPlates as $plate)
                                                        <li class="
                                                    @switch($plate->type)
                                                        @case('POLIZIA')
                                                            text-primary
                                                            @break
                                                        @case('CIVILE')
                                                            text-info
                                                            @break
                                                        @case('ORIGINALE')
                                                            text-danger
                                                            @break
                                                        @default
                                                            text-muted
                                                    @endswitch
                                                    " style="font-size: 10px">{{$plate->name}}</li>
                                                    @endforeach
                                                </ul>
                                                </td>
                                                <td class="text-truncate">{{$car->full_name ?? ''}}</td>
                                                <td class="text-truncate">{{$car->carTypology?->name ?? ''}}</td>
                                                <td class="text-truncate">{{$car->color ?? ''}}</td>
                                                <td>{{$car->km ?? 0}}</td>
                                                <td>{{ $car->note ?? '' }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>

                            {{--                            Movimenti--}}
                            <div class="tab-pane fade" id="nav-movement" role="tabpanel"
                                 aria-labelledby="nav-movement-tab">
                                 <div class="row">
                                <div class="col-6">
                                <h5>Movimenti in uscita</h5>
                                <table class="table table-hover table-responsive">
                                    <thead>
                                    <tr>
                                        <th scope="col">Codice</th>
                                        <th scope="col">Ufficio</th>
                                        <th scope="col">Dal</th>
                                        <th scope="col">Al</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($office->movementsTo))
                                        @foreach($office->movementsTo as $m)
                                            @php
                                                $movement = $m->movements->first();
                                                $movementIsActive = !$movement?->date_to || $movement?->date_to >= now();
                                            @endphp 
                                            @if($movement)
                                            <tr>
                                                <td class="col-2">
                                                    <a href="{{ route('movements.edit', $movement?->id) }}"
                                                       class="text-decoration-none">
                                                        <strong>{{ $movement?->code }}</strong>
                                                    </a>
                                                </td>
                                                <td class="col-3">{{$movement?->office->full_name}}</td>
                                                <td class="col-2">{{date('d/m/Y H:i', strtotime($movement?->date_from))}}</td>
                                                <td class="col-2"  data-bs-toggle="tooltip" title="{{$movement?->date_to ? $movement?->date_to->format('d/m/Y H:i') : 'in corso'}}" >
                                                    @if($movementIsActive)
                                                        <span class="badge bg-warning text-dark w-75">
                                                            <i class="bi bi-clock"></i> In corso
                                                        </span>
                                                    @else
                                                        <span class="badge bg-success">
                                                            <i class="bi bi-check-circle"></i> Completata
                                                        </span>
                                                    @endif
                                            </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                                </div>


                                <div class="col-6">
                                <h5>Movimenti in ingresso</h5>
                                <table class="table table-hover table-responsive">
                                    <thead>
                                    <tr>
                                        <th scope="col">Codice</th>
                                        <th scope="col">Ufficio</th>
                                        <th scope="col">Dal</th>
                                        <th scope="col">Al</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($office->movement))
                                        @foreach($office->movement as $m)
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
                                                <td class="col-2">{{date('d/m/Y H:i', strtotime($m->date_from))}}</td>
                                                <td class="col-2"  data-bs-toggle="tooltip" title="{{$m->date_to ? $m->date_to->format('d/m/Y H:i') : 'in corso'}}" >
                                                    @if($movementIsActive)
                                                        <span class="badge bg-warning text-dark w-75">
                                                            <i class="bi bi-clock"></i> In corso
                                                        </span>
                                                    @else
                                                        <span class="badge bg-success">
                                                            <i class="bi bi-check-circle"></i> Completata
                                                        </span>
                                                    @endif
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
            </div>
        </div>
    </section>
@endsection
