@extends('layouts.app')

@section('template_title')
    Uffici Assegnatari
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Uffici Assegnatari') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('assignee-offices.create') }}" class="btn btn-primary btn-sm float-right"
                                   data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Crea Nuovo Ufficio') }}">
                                    <i class="bi bi-plus-circle"></i> {{ __('Nuovo') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {{-- Barra di ricerca --}}
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <form method="GET" action="{{ route('assignee-offices.index') }}">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control"
                                               placeholder="Cerca per nome ufficio o assegnatario..."
                                               value="{{ request('search') }}">
                                        <button class="btn btn-outline-secondary" type="submit">
                                            <i class="bi bi-search"></i>
                                        </button>
                                        @if(request('search'))
                                            <a href="{{ route('assignee-offices.index') }}" class="btn btn-outline-danger">
                                                <i class="bi bi-x-circle"></i>
                                            </a>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Ufficio</th>
                                        <th>Assegnatario</th>
                                        <th>Veicolo</th>
                                        <th>Stato</th>
                                        <th>Descrizione</th>
                                        <th>Note</th>
                                        <th class="text-end">Azioni</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($assigneeOffices as $assigneeOffice)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>
                                                <strong>{{ $assigneeOffice->name }}</strong>
                                            </td>
                                            <td>
                                                @if($assigneeOffice->carAssignee)
                                                    <a href="{{ route('car-assignees.show', $assigneeOffice->carAssignee->id) }}"
                                                       class="text-decoration-none">
                                                        {{ $assigneeOffice->carAssignee->name }}
                                                    </a>
                                                    @if($assigneeOffice->carAssignee->date_from)
                                                        <br>
                                                        <small class="text-muted">
                                                            Dal {{ $assigneeOffice->carAssignee->date_from->format('d/m/Y') }}
                                                            @if($assigneeOffice->carAssignee->date_to)
                                                                al {{ $assigneeOffice->carAssignee->date_to->format('d/m/Y') }}
                                                            @endif
                                                        </small>
                                                    @endif
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($assigneeOffice->carAssignee && $assigneeOffice->carAssignee->car)
                                                    @php
                                                        $car = $assigneeOffice->carAssignee->car;
                                                        $currentPlate = $car->carPlates->first();
                                                    @endphp
                                                    <a href="{{ route('cars.show', $car->id) }}"
                                                       class="text-decoration-none">
                                                        @if($currentPlate)
                                                            <span class="badge bg-primary">{{ $currentPlate->name }}</span>
                                                        @endif
                                                        {{ $car->name }}
                                                    </a>
                                                    @if($car->carBrand)
                                                        <br>
                                                        <small class="text-muted">{{ $car->carBrand->name }} {{ $car->model }}</small>
                                                    @endif
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($assigneeOffice->isActive())
                                                    <span class="badge bg-success">Attivo</span>
                                                @else
                                                    <span class="badge bg-secondary">Inattivo</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $assigneeOffice->description ?: '-' }}
                                            </td>
                                            <td>
                                                @if($assigneeOffice->note)
                                                    <span data-bs-toggle="tooltip"
                                                          data-bs-placement="top"
                                                          title="{{ $assigneeOffice->note }}">
                                                        {{ Str::limit($assigneeOffice->note, 30) }}
                                                    </span>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <div class="btn-group dropstart">
                                                    <button type="button" class="btn btn-sm dropdown-toggle"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item"
                                                               href="{{ route('assignee-offices.show', $assigneeOffice->id) }}">
                                                                <i class="bi bi-eye"></i> {{ __('Visualizza') }}
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item"
                                                               href="{{ route('assignee-offices.edit', $assigneeOffice->id) }}">
                                                                <i class="bi bi-pencil"></i> {{ __('Modifica') }}
                                                            </a>
                                                        </li>
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li>
                                                            <form action="{{ route('assignee-offices.destroy', $assigneeOffice->id) }}"
                                                                  method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item text-danger"
                                                                        data-confirm-delete="true">
                                                                    <i class="bi bi-trash"></i> {{ __('Elimina') }}
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-4">
                                                <p class="mb-0">Nessun ufficio trovato.</p>
                                                <a href="{{ route('assignee-offices.create') }}" class="btn btn-primary btn-sm mt-2">
                                                    <i class="bi bi-plus-circle"></i> Crea il primo ufficio
                                                </a>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    {!! $assigneeOffices->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Inizializza i tooltip
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
</script>
@endsection
