@extends('layouts.app')

@section('template_title')
    Tipi di Intervento
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                <i class="bi bi-tools"></i> {{ __('Tipi di Intervento') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('maintenance-types.create') }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus"></i> {{ __('Nuovo Tipo Intervento') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(count($maintenanceTypes) > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="thead">
                                        <tr>
                                            <th>Tipo Intervento</th>
                                            <th>Descrizione</th>
                                            <th>Note</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($maintenanceTypes as $type)
                                            <tr>
                                                <td>
                                                    <strong>{{ $type->name }}</strong>
                                                </td>
                                                <td>
                                                    @if($type->description)
                                                        <small>{{ Str::limit($type->description, 40) }}</small>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($type->note)
                                                        <small data-bs-toggle="tooltip" title="{{ $type->note }}">
                                                            {{ Str::limit($type->note, 20) }}
                                                        </small>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    <x-action-table-button itemRoute="maintenance-types" :item="$type" :label="'Tipo Intervento'"/>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle"></i> Nessun tipo di intervento registrato.
                                <a href="{{ route('maintenance-types.create') }}" class="alert-link">Registra il primo tipo di intervento</a>
                            </div>
                        @endif
                    </div>
                </div>

                @if($maintenanceTypes->hasPages())
                    <div class="mt-3">
                        {!! $maintenanceTypes->withQueryString()->links() !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
