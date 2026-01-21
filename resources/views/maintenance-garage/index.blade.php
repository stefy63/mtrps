@extends('layouts.app')

@section('template_title')
    Officine
@endsection
@use('App\Enum\PlateTypeEnum')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                <i class="bi bi-building"></i> {{ __('Officine') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('maintenance-garages.create') }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus"></i> {{ __('Nuova Officina') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {{-- Filtri --}}
                        <div class="row mb-3">
                            <div class="col-12">
                                <x-input-search-button
                                        action="{{ route('maintenance-garages.index') }}"
                                        search="{{old('search', request('search') )}}"
                                />
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                <tr>
                                    <th class="col-2">Officina</th>
                                    <th class="col-1">P.IVA / CF</th>
                                    <th class="col-1">Mail / PEC</th>
                                    <th class="col-1">Certificazioni</th>
                                    <th class="col-1">DURC</th>
                                    <th class="col-1">Telefono</th>
                                    <th class="col-2">Indirizzo</th>
                                    <th class="col-1">Incarichi</th>
                                    <th class="col-1">Targhe</th>
                                    <th class="col-1"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($maintenanceGarages as $garage)
                                    <tr>
                                        <td>
                                            <strong>{{ $garage->name }}</strong>
                                            @if($garage->description)
                                                <br><small
                                                        class="text-muted">{{ Str::limit($garage->description, 30) }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            @if($garage->piva)
                                                <small>P.IVA: {{ $garage->piva }}</small><br>
                                            @endif
                                            @if($garage->cf)
                                                <small>CF: {{ $garage->cf }}</small>
                                            @endif
                                            @if(!$garage->piva && !$garage->cf)
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($garage->mail)
                                                <small>MAIL: {{ $garage->mail }}</small><br>
                                            @endif
                                            @if($garage->pec)
                                                <small>PEC: {{ $garage->pec }}</small>
                                            @endif
                                            @if(!$garage->mail && !$garage->pec)
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="">
                                                    <span class="badge
                                                        @if($garage->acc == 'yes')
                                                             bg-success
                                                        @else
                                                        bg-danger-subtle
                                                        @endif
                                                        w-100" data-bs-toggle="tooltip" title="Accreditamento">
                                                        <i class="bi bi-check-circle"></i> ACC
                                                    </span>
                                                <span class="badge
                                                        @if($garage->anti_mafia == 'yes')
                                                             bg-success
                                                        @else
                                                            bg-danger-subtle
                                                        @endif
                                                        w-100" data-bs-toggle="tooltip"
                                                      title="Certificazione Antimafia">
                                                        <i class="bi bi-check-circle"></i> MAFIA
                                                    </span>
                                            </div>
                                        </td>
                                        <td>
                                            @if($garage->durc)
                                                @php
                                                    $durcDate = \Carbon\Carbon::parse($garage->durc);
                                                    $isExpired = $durcDate->isPast();
                                                    $isExpiringSoon = $durcDate->isBetween(now(), now()->addDays(30));
                                                @endphp
                                                <span class="badge bg-{{ $isExpired ? 'danger' : ($isExpiringSoon ? 'warning' : 'success') }}">
                                                            {{ $durcDate->format('d/m/Y') }}
                                                        </span>
                                                @if($isExpired)
                                                    <br><small class="text-danger">Scaduto</small>
                                                @elseif($isExpiringSoon)
                                                    <br><small class="text-warning">In scadenza</small>
                                                @endif
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td style="font-size: 12px">
                                            @if($garage->phone1)
                                                <small>Uff.: {{ $garage->phone1 }}</small><br>
                                            @endif
                                            @if($garage->phone2)
                                                <small>Fax: {{ $garage->phone2 }}</small><br>
                                            @endif
                                            @if($garage->phone3)
                                                <small>Resp.: {{ $garage->phone3 }}</small><br>
                                            @endif
                                        </td>
                                        <td>
                                            <small>{{ $garage->address }}</small>
                                        </td>
                                        <td>
                                            @if($garage->maintenances->count() > 0)
                                                <span class="badge text-bg-dark">{{ $garage->maintenances->count() }}</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($garage->maintenances->count() > 0)
                                                @foreach($garage->maintenances as $maintenance)
                                                    @foreach ($maintenance->car->carPlates as $plate)
                                                        @if ($plate->type === PlateTypeEnum::POLIZIA->value)
                                                            <span class="small badge text-bg-primary">{{ $plate->name }}</span>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <x-action-table-button itemRoute="maintenance-garages" :item="$garage"
                                                                   :label="'Officina'"/>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                @if($maintenanceGarages->hasPages())
                    <div class="mt-3">
                        {!! $maintenanceGarages->withQueryString()->links() !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
