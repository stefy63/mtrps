@extends('layouts.app')

@section('template_title')
    CIG - Codici Identificativi Gara
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                <i class="bi bi-file-earmark-text"></i> {{ __('CIG - Codici Identificativi Gara') }}
                            </span>

                            <div class="float-right">
                                {{-- <button class="btn btn-sm btn-outline-secondary me-2" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse">
                                    <i class="bi bi-funnel"></i> Filtri
                                </button> --}}
                                <a href="{{ route('cigs.create') }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus"></i> {{ __('Nuovo CIG') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Totali -->
                    <div class="card-header bg-light">
                        <div class="row text-center">
                            <div class="col-md-3">
                                <h6 class="mb-0">Totale CIG</h6>
                                <h4 class="mb-0 text-primary">{{ $totals['count'] }}</h4>
                            </div>
                            <div class="col-md-3">
                                <h6 class="mb-0">Imponibile Totale</h6>
                                <h4 class="mb-0 text-success">€ {{ number_format($totals['taxable'], 2, ',', '.') }}</h4>
                            </div>
                            <div class="col-md-3">
                                <h6 class="mb-0">IVA Totale</h6>
                                <h4 class="mb-0 text-info">€ {{ number_format($totals['vat'], 2, ',', '.') }}</h4>
                            </div>
                            <div class="col-md-3">
                                <h6 class="mb-0">Totale Complessivo</h6>
                                <h4 class="mb-0 text-danger">€ {{ number_format($totals['total'], 2, ',', '.') }}</h4>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-12">
                                <x-input-search-button
                                        action="{{ route('cigs.index') }}"
                                        search="{{old('search', $search)}}"
                                />
                            </div>
                        </div>
                        @if(count($cigs) > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="thead">
                                        <tr>
                                            <th>CIG</th>
                                            <th>Data</th>
                                            <th>Veicolo</th>
                                            <th>Officina</th>
                                            <th>Descrizione</th>
                                            <th>Importi</th>
                                            <th>RUP</th>
                                            <th>Responsabili</th>
                                            <th width="120"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cigs as $cig)
                                            <tr>
                                                <td>
                                                    <strong class="text-primary">{{ $cig->cig }}</strong>
                                                    @if($cig->ce)
                                                        <br><small class="text-muted">CE: {{ $cig->ce }}</small>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($cig->date)
                                                        {{ $cig->date->format('d/m/Y') }}
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <small>{{ $cig->car->full_name }}</small>
                                                    @if($cig->car->carPlates->count() > 0)
                                                        <br><span class="badge bg-primary">{{ $cig->car->carPlates[0]->name }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <small>{{ $cig->maintenanceGarage->name }}</small>
                                                    @if($cig->maintenanceGarage->piva)
                                                        <br><small class="text-muted">P.IVA: {{ $cig->maintenanceGarage->piva }}</small>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($cig->description)
                                                        <small>{{ Str::limit($cig->description, 50) }}</small>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($cig->taxable)
                                                        <small>Imp: € {{ number_format($cig->taxable, 2, ',', '.') }}</small><br>
                                                        {{-- <small>IVA: € {{ number_format($cig->vat, 2, ',', '.') }}</small><br> --}}
                                                        <strong>Tot: € {{ number_format($cig->taxable + $cig->vat, 2, ',', '.') }}</strong>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($cig->userRup)
                                                        <small><strong>RUP:</strong> {{ $cig->userRup->name }}</small>
                                                    @endif
                                                    @if($cig->userSupport)
                                                        <br><small><strong>Supp:</strong> {{ $cig->userSupport->name }}</small>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($cig->userTenderNotice)
                                                        <small><strong>Resp:</strong> {{ $cig->userTenderNotice->name }}</small>
                                                    @endif
                                                    @if($cig->userTester)
                                                        <br><small><strong>Coll:</strong> {{ $cig->userTester->name }}</small>
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    <x-action-table-button :itemRoute="'cigs'" :item="$cig" />
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle"></i> Nessun CIG registrato.
                                <a href="{{ route('cigs.create') }}" class="alert-link">Registra il primo CIG</a>
                            </div>
                        @endif
                    </div>
                </div>

                @if($cigs->hasPages())
                    <div class="mt-3">
                        {!! $cigs->withQueryString()->links() !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
