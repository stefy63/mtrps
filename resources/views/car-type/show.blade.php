@extends('layouts.app')

@section('template_title')
    {{ $carType->name ?? __('Show') . " " . __('Car Type') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Car Type: {{ $carType->name }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('car-types.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <div class="row">
                            <div class="col-md-8">
                                
                                <div class="form-group mb-3">
                                    <strong>Nome:</strong>
                                    <h4 class="text-primary">{{ $carType->name }}</h4>
                                </div>
                                
                                @if($carType->description)
                                <div class="form-group mb-3">
                                    <strong>Descrizione:</strong>
                                    <p>{{ $carType->description }}</p>
                                </div>
                                @endif
                                
                                @if($carType->note)
                                <div class="form-group mb-3">
                                    <strong>Note:</strong>
                                    <div class="border p-3 bg-light rounded">
                                        {!! nl2br(e($carType->note)) !!}
                                    </div>
                                </div>
                                @endif
                            </div>
                            
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Informazioni Sistema</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group mb-2">
                                            <strong>ID:</strong>
                                            <span class="badge badge-secondary">#{{ $carType->id }}</span>
                                        </div>
                                        
                                        <div class="form-group mb-2">
                                            <strong>Creato:</strong>
                                            <br><small>{{ $carType->created_at->format('d/m/Y H:i') }}</small>
                                        </div>
                                        
                                        <div class="form-group mb-2">
                                            <strong>Aggiornato:</strong>
                                            <br><small>{{ $carType->updated_at->format('d/m/Y H:i') }}</small>
                                        </div>
                                        
                                        <div class="form-group mb-2">
                                            <strong>Veicoli associati:</strong>
                                            <span class="badge badge-info">{{ $carType->cars->count() ?? 0 }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-3">
                                    <a href="{{ route('car-types.edit', $carType->id) }}" class="btn btn-success btn-sm">
                                        <i class="fa fa-edit"></i> Modifica
                                    </a>
                                    
                                    <form action="{{ route('car-types.destroy', $carType->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Sei sicuro di voler eliminare questa tipologia?')">
                                            <i class="fa fa-trash"></i> Elimina
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        @if($carType->cars && $carType->cars->count() > 0)
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <h5>Veicoli di questa tipologia:</h5>
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Marca</th>
                                                <th>Modello</th>
                                                <th>Azioni</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($carType->cars->take(5) as $car)
                                            <tr>
                                                <td>{{ $car->name }}</td>
                                                <td>{{ $car->carBrand?->name ?? 'N/A' }}</td>
                                                <td>{{ $car->model ?? 'N/A' }}</td>
                                                <td>
                                                    <a href="{{ route('cars.show', $car->id) }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @if($carType->cars->count() > 5)
                                    <p class="text-muted">... e altri {{ $carType->cars->count() - 5 }} veicoli</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection