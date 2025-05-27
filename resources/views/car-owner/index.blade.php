@extends('layouts.app')

@section('template_title')
    Car Owners
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Car Owners') }} (Proprietari)
                            </span>

                             <div class="float-right">
                                <a href="{{ route('car-owners.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Tipo</th>
                                        <th>Proprietario</th>
                                        <th>Descrizione</th>
                                        <th>Veicoli</th>
                                        <th>Valore Flotta</th>
                                        <th>Data Creazione</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carOwners as $carOwner)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>
                                                <!-- Icona tipo proprietario -->
                                                @php
                                                    $ownerName = strtolower($carOwner->name);
                                                    if (str_contains($ownerName, 'stato') || str_contains($ownerName, 'ministero') || str_contains($ownerName, 'governo')) {
                                                        $icon = 'fas fa-landmark text-primary';
                                                        $bgColor = 'bg-primary';
                                                        $badge = 'Pubblico';
                                                        $badgeClass = 'primary';
                                                    } elseif (str_contains($ownerName, 'comune') || str_contains($ownerName, 'provincia') || str_contains($ownerName, 'regione')) {
                                                        $icon = 'fas fa-city text-info';
                                                        $bgColor = 'bg-info';
                                                        $badge = 'Ente Locale';
                                                        $badgeClass = 'info';
                                                    } elseif (str_contains($ownerName, 'polizia') || str_contains($ownerName, 'carabinieri') || str_contains($ownerName, 'guardia')) {
                                                        $icon = 'fas fa-shield-alt text-danger';
                                                        $bgColor = 'bg-danger';
                                                        $badge = 'Forze Ordine';
                                                        $badgeClass = 'danger';
                                                    } elseif (str_contains($ownerName, 'azienda') || str_contains($ownerName, 'spa') || str_contains($ownerName, 'srl')) {
                                                        $icon = 'fas fa-building text-success';
                                                        $bgColor = 'bg-success';
                                                        $badge = 'Privato';
                                                        $badgeClass = 'success';
                                                    } else {
                                                        $icon = 'fas fa-user text-secondary';
                                                        $bgColor = 'bg-secondary';
                                                        $badge = 'Generico';
                                                        $badgeClass = 'secondary';
                                                    }
                                                @endphp
                                                
                                                <div class="d-flex flex-column align-items-center">
                                                    <div class="owner-icon d-flex align-items-center justify-content-center {{ $bgColor }} bg-opacity-10 rounded-circle mb-1" style="width: 35px; height: 35px;">
                                                        <i class="{{ $icon }}"></i>
                                                    </div>
                                                    <span class="badge badge-{{ $badgeClass }} badge-sm">{{ $badge }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <strong class="text-primary">{{ $carOwner->name }}</strong>
                                            </td>
                                            <td>{{ Str::limit($carOwner->description ?? 'N/A', 60) }}</td>
                                            <td class="text-center">
                                                @if($carOwner->cars_count > 0)
                                                <span class="badge badge-info badge-lg">
                                                    <i class="fas fa-car"></i> {{ $carOwner->cars_count }}
                                                </span>
                                                @else
                                                <span class="badge badge-secondary">
                                                    <i class="fas fa-minus"></i> 0
                                                </span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($carOwner->cars_count > 0)
                                                @php
                                                    // Simulazione valore flotta (in un'app reale avresti i prezzi)
                                                    $estimatedValue = $carOwner->cars_count * 25000; // €25k medio per veicolo
                                                @endphp
                                                <span class="text-success">
                                                    <i class="fas fa-euro-sign"></i> {{ number_format($estimatedValue, 0, ',', '.') }}
                                                </span>
                                                @else
                                                <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>{{ $carOwner->created_at->format('d/m/Y') }}</td>

                                            <td>
                                                <form action="{{ route('car-owners.destroy', $carOwner->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('car-owners.show', $carOwner->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('car-owners.edit', $carOwner->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Sei sicuro di voler eliminare questo proprietario? Questa azione è possibile solo se non ci sono veicoli associati.') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $carOwners->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection