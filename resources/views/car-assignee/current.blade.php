@extends('layouts.app')

@section('template_title')
    Current Car Assignees
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                <i class="fas fa-clock text-success"></i> {{ __('Current Car Assignees') }} (Assegnazioni Correnti)
                            </span>

                            <div class="float-right">
                                <a href="{{ route('car-assignees.index') }}" class="btn btn-secondary btn-sm me-2">
                                    <i class="fas fa-list"></i> Tutte le Assegnazioni
                                </a>
                                <a href="{{ route('car-assignees.create') }}" class="btn btn-primary btn-sm">
                                    {{ __('Create New') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Badge di riepilogo -->
                    <div class="card-body bg-light border-bottom">
                        <div class="row text-center">
                            <div class="col-md-3">
                                <div class="card border-success">
                                    <div class="card-body">
                                        <h3 class="text-success">{{ $carAssignees->total() }}</h3>
                                        <p class="mb-0">Assegnazioni Attive</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card border-info">
                                    <div class="card-body">
                                        <h3 class="text-info">{{ $carAssignees->unique('car_id')->count() }}</h3>
                                        <p class="mb-0">Veicoli Assegnati</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card border-warning">
                                    <div class="card-body">
                                        @php
                                            $indefiniteCount = $carAssignees->where('date_to', null)->count();
                                        @endphp
                                        <h3 class="text-warning">{{ $indefiniteCount }}</h3>
                                        <p class="mb-0">A Tempo Indeterminato</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card border-primary">
                                    <div class="card-body">
                                        @php
                                            $officesCount = $carAssignees->sum(function($assignee) {
                                                return $assignee->assigneeOffices->count();
                                            });
                                        @endphp
                                        <h3 class="text-primary">{{ $officesCount }}</h3>
                                        <p class="mb-0">Uffici Collegati</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-white">
                        @if($carAssignees->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Assegnatario</th>
                                        <th>Veicolo</th>
                                        <th>Targa</th>
                                        <th>Proprietario</th>
                                        <th>Data Inizio</th>
                                        <th>Durata</th>
                                        <th>Uffici</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carAssignees as $carAssignee)
                                        <tr class="table-row-active">
                                            <td>{{ ++$i }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @php
                                                        // Determina tipo di assegnatario dall'analisi del nome
                                                        $assigneeName = strtolower($carAssignee->name);
                                                        if (str_contains($assigneeName, 'direttore') || str_contains($assigneeName, 'dirigente') || str_contains($assigneeName, 'capo')) {
                                                            $icon = 'fas fa-user-tie text-primary';
                                                            $bgColor = 'bg-primary';
                                                        } elseif (str_contains($assigneeName, 'commissario') || str_contains($assigneeName, 'ispettore') || str_contains($assigneeName, 'sovrintendente')) {
                                                            $icon = 'fas fa-shield-alt text-danger';
                                                            $bgColor = 'bg-danger';
                                                        } elseif (str_contains($assigneeName, 'ufficio') || str_contains($assigneeName, 'servizio') || str_contains($assigneeName, 'reparto')) {
                                                            $icon = 'fas fa-building text-info';
                                                            $bgColor = 'bg-info';
                                                        } else {
                                                            $icon = 'fas fa-user text-secondary';
                                                            $bgColor = 'bg-secondary';
                                                        }
                                                    @endphp
                                                    
                                                    <div class="assignee-icon d-flex align-items-center justify-content-center {{ $bgColor }} bg-opacity-10 rounded-circle me-2" style="width: 35px; height: 35px;">
                                                        <i class="{{ $icon }} fa-sm"></i>
                                                    </div>
                                                    <div>
                                                        <strong>{{ $carAssignee->name }}</strong>
                                                        @if($carAssignee->description)
                                                        <br><small class="text-muted">{{ Str::limit($carAssignee->description, 40) }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if($carAssignee->car)
                                                <strong>{{ $carAssignee->car->name }}</strong>
                                                <br><small class="text-muted">{{ $carAssignee->car->carBrand?->name ?? 'N/A' }} {{ $carAssignee->car->model ?? '' }}</small>
                                                @else
                                                <span class="text-muted">Veicolo non trovato</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($carAssignee->car && $carAssignee->car->carPlates->count() > 0)
                                                <span class="badge badge-dark">{{ $carAssignee->car->carPlates->first()->name }}</span>
                                                @else
                                                <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($carAssignee->car && $carAssignee->car->carOwner)
                                                {{ Str::limit($carAssignee->car->carOwner->name, 25) }}
                                                @else
                                                <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                    $dateFrom = \Carbon\Carbon::parse($carAssignee->date_from);
                                                @endphp
                                                <strong>{{ $dateFrom->format('d/m/Y') }}</strong>
                                                <br><small class="text-success">{{ $dateFrom->diffForHumans() }}</small>
                                            </td>
                                            <td>
                                                @php
                                                    $now = now();
                                                    $duration = $dateFrom->diffInDays($now);
                                                @endphp
                                                @if($carAssignee->date_to)
                                                    @php
                                                        $dateTo = \Carbon\Carbon::parse($carAssignee->date_to);
                                                        $totalDuration = $dateFrom->diffInDays($dateTo);
                                                        $remainingDays = $now->diffInDays($dateTo);
                                                    @endphp
                                                    <span class="text-info">{{ $duration }} / {{ $totalDuration }} giorni</span>
                                                    <br><small class="text-warning">{{ $remainingDays }} giorni rimanenti</small>
                                                @else
                                                    <span class="text-success">{{ $duration }} giorni</span>
                                                    <br><small class="text-primary">Tempo indeterminato</small>
                                                @endif
                                            </td>
                                            <td>
                                                @if($carAssignee->assigneeOffices->count() > 0)
                                                <span class="badge badge-info">{{ $carAssignee->assigneeOffices->count() }}</span>
                                                @foreach($carAssignee->assigneeOffices->take(2) as $office)
                                                <br><small class="text-muted">{{ Str::limit($office->name, 20) }}</small>
                                                @endforeach
                                                @if($carAssignee->assigneeOffices->count() > 2)
                                                <br><small class="text-muted">... +{{ $carAssignee->assigneeOffices->count() - 2 }}</small>
                                                @endif
                                                @else
                                                <span class="text-muted">-</span>
                                                @endif
                                            </td>

                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('car-assignees.show', $carAssignee->id) }}" title="Vedi Dettagli">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a class="btn btn-sm btn-outline-success" href="{{ route('car-assignees.edit', $carAssignee->id) }}" title="Modifica">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    @if($carAssignee->car)
                                                    <a class="btn btn-sm btn-outline-info" href="{{ route('cars.show', $carAssignee->car->id) }}" title="Vedi Veicolo">
                                                        <i class="fa fa-car"></i>
                                                    </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="text-center py-5">
                            <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">Nessuna Assegnazione Corrente</h4>
                            <p class="text-muted">Non ci sono assegnazioni attive al momento.</p>
                            <a href="{{ route('car-assignees.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Crea Prima Assegnazione
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
                @if($carAssignees->count() > 0)
                {!! $carAssignees->withQueryString()->links() !!}
                @endif
            </div>
        </div>
    </div>

    <style>
    .table-row-active {
        border-left: 4px solid #28a745;
    }
    
    .card.border-success {
        border-color: #28a745 !important;
    }
    
    .card.border-info {
        border-color: #17a2b8 !important;
    }
    
    .card.border-warning {
        border-color: #ffc107 !important;
    }
    
    .card.border-primary {
        border-color: #007bff !important;
    }
    </style>
@endsection