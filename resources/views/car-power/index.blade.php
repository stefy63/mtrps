@extends('layouts.app')

@section('template_title')
    Car Powers
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Car Powers') }} (Alimentazioni)
                            </span>

                             <div class="float-right">
                                <a href="{{ route('car-powers.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        <th>Icona</th>
                                        <th>Alimentazione</th>
                                        <th>Descrizione</th>
                                        <th>Veicoli</th>
                                        <th>Impatto Ambientale</th>
                                        <th>Data Creazione</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carPowers as $carPower)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>
                                                <!-- Icone specifiche per tipo di alimentazione -->
                                                @php
                                                    $powerName = strtolower($carPower->name);
                                                    if (str_contains($powerName, 'benzina')) {
                                                        $icon = 'fas fa-gas-pump text-warning';
                                                        $bgColor = 'bg-warning';
                                                    } elseif (str_contains($powerName, 'diesel')) {
                                                        $icon = 'fas fa-oil-can text-dark';
                                                        $bgColor = 'bg-secondary';
                                                    } elseif (str_contains($powerName, 'elettric') || str_contains($powerName, 'electric')) {
                                                        $icon = 'fas fa-bolt text-primary';
                                                        $bgColor = 'bg-primary';
                                                    } elseif (str_contains($powerName, 'ibrido') || str_contains($powerName, 'hybrid')) {
                                                        $icon = 'fas fa-leaf text-success';
                                                        $bgColor = 'bg-success';
                                                    } elseif (str_contains($powerName, 'gpl')) {
                                                        $icon = 'fas fa-fire text-info';
                                                        $bgColor = 'bg-info';
                                                    } elseif (str_contains($powerName, 'metano')) {
                                                        $icon = 'fas fa-wind text-success';
                                                        $bgColor = 'bg-success';
                                                    } else {
                                                        $icon = 'fas fa-cog text-muted';
                                                        $bgColor = 'bg-light';
                                                    }
                                                @endphp
                                                
                                                <div class="power-icon d-flex align-items-center justify-content-center {{ $bgColor }} bg-opacity-10 rounded" style="width: 40px; height: 40px;">
                                                    <i class="{{ $icon }}"></i>
                                                </div>
                                            </td>
                                            <td>
                                                <strong class="text-primary">{{ $carPower->name }}</strong>
                                            </td>
                                            <td>{{ Str::limit($carPower->description ?? 'N/A', 80) }}</td>
                                            <td>
                                                <span class="badge badge-info">
                                                    {{ $carPower->cars->count() ?? 0 }}
                                                </span>
                                            </td>
                                            <td>
                                                @php
                                                    if (str_contains($powerName, 'elettric') || str_contains($powerName, 'electric')) {
                                                        $envClass = 'success';
                                                        $envText = 'Eco-friendly';
                                                    } elseif (str_contains($powerName, 'ibrido') || str_contains($powerName, 'hybrid') || str_contains($powerName, 'gpl') || str_contains($powerName, 'metano')) {
                                                        $envClass = 'warning';
                                                        $envText = 'Medio impatto';
                                                    } else {
                                                        $envClass = 'danger';
                                                        $envText = 'Alto impatto';
                                                    }
                                                @endphp
                                                <span class="badge badge-{{ $envClass }}">{{ $envText }}</span>
                                            </td>
                                            <td>{{ $carPower->created_at->format('d/m/Y') }}</td>

                                            <td>
                                                <form action="{{ route('car-powers.destroy', $carPower->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('car-powers.show', $carPower->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('car-powers.edit', $carPower->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Sei sicuro di voler eliminare questa alimentazione?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $carPowers->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection