@extends('layouts.app')

@section('template_title')
    Centro di Costo {{ $carProfitAccount->code }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">
                                <i class="bi bi-eye"></i> {{ __('Centro di Costo') }}: <strong>{{ $carProfitAccount->code }}</strong>
                                <span class="badge bg-{{ $carProfitAccount->status_badge_class }} ms-2">{{ $carProfitAccount->status_label }}</span>
                            </span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-sm btn-warning" href="{{ route('car-profit-accounts.edit', $carProfitAccount->id) }}">
                                <i class="bi bi-pencil"></i> {{ __('Modifica') }}
                            </a>
                            <a class="btn btn-sm btn-secondary" href="{{ route('car-profit-accounts.index') }}">
                                <i class="bi bi-arrow-left"></i> {{ __('Torna alla lista') }}
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            {{-- Colonna Sinistra - Dettagli --}}
                            <div class="col-md-8">
                                {{-- Informazioni Principali --}}
                                <div class="card mb-3">
                                    <div class="card-header bg-primary text-white">
                                        <i class="bi bi-info-circle"></i> Informazioni Principali
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p><strong>Nome:</strong> {{ $carProfitAccount->name }}</p>
                                                @if($carProfitAccount->category)
                                                    <p><strong>Categoria:</strong>
                                                        <span class="badge bg-secondary">{{ $carProfitAccount->category_label }}</span>
                                                    </p>
                                                @endif
                                                @if($carProfitAccount->department)
                                                    <p><strong>Dipartimento:</strong> {{ $carProfitAccount->department }}</p>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                @if($carProfitAccount->description)
                                                    <p><strong>Descrizione:</strong><br>{{ $carProfitAccount->description }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Responsabile e Contatti --}}
                                @if($carProfitAccount->responsible || $carProfitAccount->email || $carProfitAccount->phone)
                                    <div class="card mb-3">
                                        <div class="card-header bg-info text-white">
                                            <i class="bi bi-person"></i> Responsabile e Contatti
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    @if($carProfitAccount->responsible)
                                                        <p><strong>Responsabile:</strong> {{ $carProfitAccount->responsible }}</p>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    @if($carProfitAccount->email)
                                                        <p>
                                                            <i class="bi bi-envelope"></i>
                                                            <a href="mailto:{{ $carProfitAccount->email }}">{{ $carProfitAccount->email }}</a>
                                                        </p>
                                                    @endif
                                                    @if($carProfitAccount->phone)
                                                        <p>
                                                            <i class="bi bi-telephone"></i>
                                                            <a href="tel:{{ $carProfitAccount->phone }}">{{ $carProfitAccount->phone }}</a>
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- Budget --}}
                                @if($carProfitAccount->budget_year || $carProfitAccount->budget_month)
                                    <div class="card mb-3">
                                        <div class="card-header bg-success text-white">
                                            <i class="bi bi-currency-euro"></i> Budget
                                        </div>
                                        <div class="card-body">
                                            <div class="row text-center">
                                                @if($carProfitAccount->budget_year)
                                                    <div class="col-md-4">
                                                        <h6>Budget Annuale</h6>
                                                        <h4>€ {{ number_format($carProfitAccount->budget_year, 2, ',', '.') }}</h4>
                                                    </div>
                                                @endif
                                                @if($carProfitAccount->budget_month)
                                                    <div class="col-md-4">
                                                        <h6>Budget Mensile</h6>
                                                        <h4>€ {{ number_format($carProfitAccount->budget_month, 2, ',', '.') }}</h4>
                                                    </div>
                                                @endif
                                                @if($usageStats['budget_usage'])
                                                    <div class="col-md-4">
                                                        <h6>Utilizzo</h6>
                                                        <h4>{{ $usageStats['budget_usage'] }}%</h4>
                                                        <div class="progress" style="height: 20px;">
                                                            <div class="progress-bar
                                                                @if($usageStats['budget_usage'] > 90) bg-danger
                                                                @elseif($usageStats['budget_usage'] > 70) bg-warning
                                                                @else bg-success
                                                                @endif"
                                                                role="progressbar"
                                                                style="width: {{ $usageStats['budget_usage'] }}%">
                                                                {{ $usageStats['budget_usage'] }}%
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            @if($usageStats['remaining_budget'])
                                                <hr>
                                                <p class="text-center mb-0">
                                                    <strong>Budget Rimanente:</strong>
                                                    <span class="text-success">€ {{ number_format($usageStats['remaining_budget'], 2, ',', '.') }}</span>
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                {{-- Validità --}}
                                <div class="card mb-3">
                                    <div class="card-header bg-warning">
                                        <i class="bi bi-calendar-check"></i> Validità
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p><strong>Stato:</strong>
                                                    @if($carProfitAccount->is_active)
                                                        <span class="badge bg-success">Attivo</span>
                                                    @else
                                                        <span class="badge bg-secondary">Disattivo</span>
                                                    @endif
                                                </p>
                                                @if($carProfitAccount->valid_from)
                                                    <p><strong>Valido dal:</strong> {{ $carProfitAccount->valid_from->format('d/m/Y') }}</p>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                @if($carProfitAccount->valid_to)
                                                    <p><strong>Valido fino al:</strong> {{ $carProfitAccount->valid_to->format('d/m/Y') }}</p>
                                                    @php
                                                        $daysToExpiry = now()->diffInDays($carProfitAccount->valid_to, false);
                                                    @endphp
                                                    @if($daysToExpiry >= 0 && $daysToExpiry <= 30)
                                                        <div class="alert alert-warning">
                                                            <i class="bi bi-exclamation-triangle"></i>
                                                            Scade tra {{ $daysToExpiry }} giorni!
                                                        </div>
                                                    @elseif($daysToExpiry < 0)
                                                        <div class="alert alert-danger">
                                                            <i class="bi bi-x-circle"></i>
                                                            Scaduto da {{ abs($daysToExpiry) }} giorni!
                                                        </div>
                                                    @endif
                                                @else
                                                    <p class="text-muted">Nessuna scadenza impostata</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Note --}}
                                @if($carProfitAccount->notes)
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <i class="bi bi-file-text"></i> Note
                                        </div>
                                        <div class="card-body">
                                            <p>{{ $carProfitAccount->notes }}</p>
                                        </div>
                                    </div>
                                @endif

                                {{-- Veicoli Associati --}}
                                <div class="card">
                                    <div class="card-header bg-dark text-white">
                                        <i class="bi bi-truck"></i> Veicoli Associati ({{ $cars->count() }})
                                    </div>
                                    <div class="card-body">
                                        @if($cars->count() > 0)
                                            <div class="table-responsive">
                                                <table class="table table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Veicolo</th>
                                                            <th>Targa</th>
                                                            <th>Tipo</th>
                                                            <th>Marca</th>
                                                            <th>Stato</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($cars as $car)
                                                            <tr>
                                                                <td>
                                                                    <strong>{{ $car->name }}</strong>
                                                                </td>
                                                                <td>
                                                                    @if($car->carPlates->first())
                                                                        <i class="bi bi-credit-card"></i> {{ $car->carPlates->first()->name }}
                                                                    @else
                                                                        <span class="text-muted">-</span>
                                                                    @endif
                                                                </td>
                                                                <td>{{ $car->carType?->name ?? '-' }}</td>
                                                                <td>{{ $car->carBrand?->name ?? '-' }}</td>
                                                                <td>
                                                                    @if($car->carAssignees()->whereNull('date_to')->exists())
                                                                        <span class="badge bg-success">Assegnato</span>
                                                                    @else
                                                                        <span class="badge bg-secondary">Disponibile</span>
                                                                    @endif
                                                                </td>
                                                                <td class="text-end">
                                                                    <a href="{{ route('cars.show', $car->id) }}"
                                                                       class="btn btn-sm btn-info"
                                                                       data-bs-toggle="tooltip"
                                                                       title="Visualizza veicolo">
                                                                        <i class="bi bi-eye"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @else
                                            <p class="text-muted text-center">Nessun veicolo associato a questo centro di costo</p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Colonna Destra - Statistiche e Azioni --}}
                            <div class="col-md-4">
                                {{-- Azioni Rapide --}}
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <i class="bi bi-lightning"></i> Azioni Rapide
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('car-profit-accounts.toggleActive', $carProfitAccount->id) }}"
                                              method="POST"
                                              class="mb-2">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn w-100 {{ $carProfitAccount->is_active ? 'btn-warning' : 'btn-success' }}">
                                                @if($carProfitAccount->is_active)
                                                    <i class="bi bi-x-circle"></i> Disattiva Centro di Costo
                                                @else
                                                    <i class="bi bi-check-circle"></i> Attiva Centro di Costo
                                                @endif
                                            </button>
                                        </form>

                                        @if($cars->count() == 0)
                                            <form action="{{ route('car-profit-accounts.destroy', $carProfitAccount->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger w-100" data-confirm-delete="true">
                                                    <i class="bi bi-trash"></i> Elimina Centro di Costo
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>

                                {{-- Statistiche Utilizzo --}}
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <i class="bi bi-graph-up"></i> Statistiche Utilizzo
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <small class="text-muted">Veicoli Totali</small>
                                            <h5>{{ $usageStats['total_cars'] }}</h5>
                                        </div>
                                        <div class="mb-3">
                                            <small class="text-muted">Veicoli Attivi</small>
                                            <h5 class="text-success">{{ $usageStats['active_cars'] }}</h5>
                                        </div>
                                        @if($carProfitAccount->budget_year)
                                            <hr>
                                            <div class="mb-3">
                                                <small class="text-muted">Budget Utilizzato</small>
                                                <h5>{{ $usageStats['budget_usage'] }}%</h5>
                                            </div>
                                            <div>
                                                <small class="text-muted">Budget Rimanente</small>
                                                <h5 class="text-success">
                                                    € {{ number_format($usageStats['remaining_budget'], 2, ',', '.') }}
                                                </h5>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                {{-- Metadati --}}
                                <div class="card">
                                    <div class="card-header">
                                        <i class="bi bi-info-square"></i> Informazioni Sistema
                                    </div>
                                    <div class="card-body small text-muted">
                                        <p class="mb-1">
                                            <strong>Creato:</strong>
                                            {{ $carProfitAccount->created_at->format('d/m/Y H:i') }}
                                            @if($carProfitAccount->creator)
                                                da {{ $carProfitAccount->creator->name }}
                                            @endif
                                        </p>
                                        @if($carProfitAccount->updated_at != $carProfitAccount->created_at)
                                            <p class="mb-1">
                                                <strong>Modificato:</strong>
                                                {{ $carProfitAccount->updated_at->format('d/m/Y H:i') }}
                                                @if($carProfitAccount->updater)
                                                    da {{ $carProfitAccount->updater->name }}
                                                @endif
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
