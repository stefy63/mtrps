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
                                {{ __('Targhe') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('car-plates.create') }}" class="btn btn-primary btn-sm float-right"
                                   data-placement="left">
                                    {{ __('Create New') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                <tr>
                                    <th>Targa</th>
                                    <th>Vettura</th>
                                    <th>Modello</th>
                                    <th>Dal</th>
                                    <th>Al</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($carPlates as $carPlate)
                                    <tr>
                                        <td>
                                            <!-- Targa stilizzata -->
                                            <div class="plate-display">
                                                @php
                                                    $plateClass = '';
                                                    switch($carPlate->type) {
                                                        case 'POLIZIA':
                                                            $plateClass = 'plate-police';
                                                            break;
                                                        case 'CIVILE':
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
                                                @case('POLIZIA')
                                                    <span class="badge bg-primary w-75">
                                                            <i class="bi bi-shield-shaded me-1"></i>  Polizia
                                                        </span>
                                                    @break
                                                @case('CIVILE')
                                                    <span class="badge bg-success w-75">
                                                            <i class="bi bi-person me-1"></i>  Civile
                                                        </span>
                                                    @break
                                                @default
                                                    <span class="badge bg-secondary w-75">
                                                            <i class="bi bi-question me-1"></i>  Altro
                                                        </span>
                                            @endswitch
                                        </td>
                                        <td>
                                            @if($carPlate->car)
                                                <strong>{{ $carPlate->car->full_name ?? 'N/A' }}</strong>
                                            @else
                                                <span class="text-muted">Da assegnare</span>
                                            @endif
                                        </td>
                                        <td>
                                            <small>
                                                {{ \Carbon\Carbon::parse($carPlate->date_from)->format('d/m/Y') }}
                                            </small>
                                        </td>
                                        <td>
                                            <small>
                                                @if($carPlate->date_to)
                                                    {{ \Carbon\Carbon::parse($carPlate->date_to)->format('d/m/Y') }}
                                                @else
                                                    <em>In corso</em>
                                                @endif
                                            </small>
                                        </td>

                                        <td class="text-end">
                                            <x-action-table-button :itemRoute="'car-plates'" :item="$carPlate"
                                                                   :label="'Targa'"/>
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
            /*padding: 4px 8px;*/
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