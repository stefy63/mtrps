@extends('layouts.app')

@section('template_title')
    Car Assignees
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Car Assignees') }} (Assegnatari)
                            </span>

                            <div class="float-right">
                                <a href="{{ route('car-assignees.current') }}" class="btn btn-info btn-sm me-2">
                                    <i class="fas fa-clock"></i> Assegnazioni Correnti
                                </a>
                                <a href="{{ route('car-assignees.create') }}" class="btn btn-primary btn-sm">
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
                                        <th>No</th>
                                        <th>Stato</th>
                                        <th>Assegnatario</th>
                                        <th>Veicolo</th>
                                        <th>Targa</th>
                                        <th>Proprietario</th>
                                        <th>Periodo</th>
                                        <th>Uffici</th>
                                        <th>Durata</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carAssignees as $carAssignee)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>
                                                @php
                                                    $now = now();
                                                    $dateFrom = \Carbon\Carbon::parse($carAssignee->date_from);
                                                    $dateTo = $carAssignee->date_to ? \Carbon\Carbon::parse($carAssignee->date_to) : null;
                                                    
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
                                                    
                                                    <div class="assignee-icon d-flex align-items-center justify-content-center {{ $bgColor }} bg-opacity-10 rounded-circle me-2" style="width: 30px; height: 30px;">
                                                        <i class="{{ $icon }} fa-sm"></i>
                                                    </div>
                                                    <div>
                                                        <strong>{{ $carAssignee->name }}</strong>
                                                        @if($carAssignee->description)
                                                        <br><small class="text-muted">{{ Str::limit($carAssignee->description, 30) }}</small>
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
                                                <span class="badge badge-outline-dark">{{ $carAssignee->car->carPlates->first()->name }}</span>
                                                @else
                                                <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($carAssignee->car && $carAssignee->car->carOwner)
                                                {{ Str::limit($carAssignee->car->carOwner->name, 20) }}
                                                @else
                                                <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                <small>
                                                    <strong>Dal:</strong> {{ $dateFrom->format('d/m/Y') }}<br>
                                                    @if($carAssignee->date_to)
                                                    <strong>Al:</strong> {{ \Carbon\Carbon::parse($carAssignee->date_to)->format('d/m/Y') }}
                                                    @else
                                                    <strong>Al:</strong> <em>In corso</em>
                                                    @endif
                                                </small>
                                            </td>
                                            <td>
                                                @if($carAssignee->assigneeOffices->count() > 0)
                                                <span class="badge badge-info">{{ $carAssignee->assigneeOffices->count() }}</span>
                                                <br><small>{{ $carAssignee->assigneeOffices->first()->name ?? '' }}</small>
                                                @else
                                                <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                    if ($dateTo) {
                                                        $duration = $dateFrom->diffInDays($dateTo);
                                                        $durationText = $duration . ' giorni';
                                                    } else {
                                                        $duration = $dateFrom->diffInDays($now);
                                                        $durationText = $duration . ' giorni (in corso)';
                                                    }
                                                @endphp
                                                <small class="text-info">{{ $durationText }}</small>
                                            </td>

                                            <td>
                                                <form action="{{ route('car-assignees.destroy', $carAssignee->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('car-assignees.show', $carAssignee->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('car-assignees.edit', $carAssignee->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Sei sicuro di voler eliminare questa assegnazione?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $carAssignees->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection