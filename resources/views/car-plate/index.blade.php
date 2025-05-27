@extends('layouts.app')

@section('template_title')
    Car Plates
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Car Plates') }} (Targhe)
                            </span>

                             <div class="float-right">
                                <a href="{{ route('car-plates.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Targa</th>
                                        <th>Tipo</th>
                                        <th>Veicolo</th>
                                        <th>Marca/Modello</th>
                                        <th>Periodo</th>
                                        <th>Stato</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carPlates as $carPlate)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>
                                                <!-- Targa stilizzata -->
                                                <div class="plate-display">
                                                    @php
                                                        $plateClass = '';
                                                        switch($carPlate->type) {
                                                            case 'POL':
                                                                $plateClass = 'plate-police';
                                                                break;
                                                            case 'CIV':
                                                                $plateClass = 'plate-civil';
                                                                break;
                                                            default:
                                                                $plateClass = 'plate-other';
                                                        }
                                                    @endphp
                                                    <span class="plate {{ $plateClass }}">
                                                        {{ $carPlate->name }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                @switch($carPlate->type)
                                                    @case('POL')
                                                        <span class="badge badge-primary">
                                                            <i class="fas fa-shield-alt"></i> Polizia
                                                        </span>
                                                        @break
                                                    @case('CIV')
                                                        <span class="badge badge-success">
                                                            <i class="fas fa-user"></i> Civile
                                                        </span>
                                                        @break
                                                    @default
                                                        <span class="badge badge-secondary">
                                                            <i class="fas fa-question"></i> Altro
                                                        </span>
                                                @endswitch
                                            </td>
                                            <td>
                                                @if($carPlate->car)
                                                <strong>{{ $carPlate->car->name }}</strong>
                                                @else
                                                <span class="text-muted">Veicolo non trovato</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($carPlate->car)
                                                {{ $carPlate->car->carBrand?->name ?? 'N/A' }} 
                                                {{ $carPlate->car->model ?? '' }}
                                                <br><small class="text-muted">{{ $carPlate->car->carType?->name ?? 'N/A' }}</small>
                                                @else
                                                <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                <small>
                                                    <strong>Dal:</strong> {{ \Carbon\Carbon::parse($carPlate->date_from)->format('d/m/Y') }}<br>
                                                    @if($carPlate->date_to)
                                                    <strong>Al:</strong> {{ \Carbon\Carbon::parse($carPlate->date_to)->format('d/m/Y') }}
                                                    @else
                                                    <strong>Al:</strong> <em>In corso</em>
                                                    @endif
                                                </small>
                                            </td>
                                            <td>
                                                @php
                                                    $now = now();
                                                    $dateFrom = \Carbon\Carbon::parse($carPlate->date_from);
                                                    $dateTo = $carPlate->date_to ? \Carbon\Carbon::parse($carPlate->date_to) : null;
                                                    
                                                    if ($now < $dateFrom) {
                                                        $status = 'future';
                                                        $statusText = 'Futura';
                                                        $statusClass = 'warning';
                                                        $statusIcon = 'clock';
                                                    } elseif ($dateTo && $now > $dateTo) {
                                                        $status = 'expired';
                                                        $statusText = 'Scaduta';
                                                        $statusClass = 'danger';
                                                        $statusIcon = 'times-circle';
                                                    } else {
                                                        $status = 'active';
                                                        $statusText = 'Attiva';
                                                        $statusClass = 'success';
                                                        $statusIcon = 'check-circle';
                                                    }
                                                @endphp
                                                
                                                <span class="badge badge-{{ $statusClass }}">
                                                    <i class="fas fa-{{ $statusIcon }}"></i> {{ $statusText }}
                                                </span>
                                            </td>

                                            <td>
                                                <form action="{{ route('car-plates.destroy', $carPlate->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('car-plates.show', $carPlate->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('car-plates.edit', $carPlate->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Sei sicuro di voler eliminare questa targa?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $carPlates->withQueryString()->links() !!}
            </div>
        </div>
    </div>

    <style>
    .plate {
        display: inline-block;
        padding: 4px 8px;
        font-family: 'Courier New', monospace;
        font-weight: bold;
        font-size: 14px;
        border: 2px solid;
        border-radius: 4px;
        text-align: center;
        min-width: 100px;
    }
    
    .plate-civil {
        background-color: #ffffff;
        color: #000000;
        border-color: #000000;
    }
    
    .plate-police {
        background-color: #1e3a8a;
        color: #ffffff;
        border-color: #ffffff;
    }
    
    .plate-other {
        background-color: #f3f4f6;
        color: #374151;
        border-color: #6b7280;
    }
    
    .plate-display {
        font-family: monospace;
    }
    </style>
@endsection