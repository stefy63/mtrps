@extends('layouts.app')

@section('template_title')
    {{ $car->name ?? __('Show') . " " . __('Car') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Car: {{ $car->name }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('cars.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <div class="row">
                            <div class="col-md-6">
                                
                                <div class="form-group mb-2 mb20">
                                    <strong>Tipo Veicolo:</strong>
                                    {{ $car->carType?->name ?? 'N/A' }}
                                </div>
                                
                                <div class="form-group mb-2 mb20">
                                    <strong>Proprietario:</strong>
                                    {{ $car->carOwner?->name ?? 'N/A' }}
                                </div>
                                
                                <div class="form-group mb-2 mb20">
                                    <strong>Marca:</strong>
                                    {{ $car->carBrand?->name ?? 'N/A' }}
                                </div>
                                
                                <div class="form-group mb-2 mb20">
                                    <strong>Alimentazione:</strong>
                                    {{ $car->carPower?->name ?? 'N/A' }}
                                </div>
                                
                                <div class="form-group mb-2 mb20">
                                    <strong>Conto Economico:</strong>
                                    {{ $car->carProfitAccount?->name ?? 'N/A' }}
                                </div>
                                
                                <div class="form-group mb-2 mb20">
                                    <strong>Nome:</strong>
                                    {{ $car->name }}
                                </div>
                                
                                <div class="form-group mb-2 mb20">
                                    <strong>Modello:</strong>
                                    {{ $car->model ?? 'N/A' }}
                                </div>
                                
                                <div class="form-group mb-2 mb20">
                                    <strong>Colore:</strong>
                                    {{ $car->color ?? 'N/A' }}
                                </div>
                                
                                <div class="form-group mb-2 mb20">
                                    <strong>Codice Modello:</strong>
                                    {{ $car->cod_model ?? 'N/A' }}
                                </div>
                                
                                <div class="form-group mb-2 mb20">
                                    <strong>Conto Profitto:</strong>
                                    {{ $car->profit_account ?? 'N/A' }}
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                
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
                                    <strong>Data Documento:</strong>
                                    {{ $car->doc ? \Carbon\Carbon::parse($car->doc)->format('d/m/Y') : 'N/A' }}
                                </div>
                                
                                @if($car->createdBy)
                                <div class="form-group mb-2 mb20">
                                    <strong>Creato da:</strong>
                                    {{ $car->createdBy->name }}
                                </div>
                                @endif
                                
                                @if($car->updatedBy)
                                <div class="form-group mb-2 mb20">
                                    <strong>Aggiornato da:</strong>
                                    {{ $car->updatedBy->name }}
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
                                <div class="form-group mb-2 mb20">
                                    <strong>Note:</strong>
                                    <p>{{ $car->note }}</p>
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
                </div>
            </div>
        </div>
    </section>
@endsection