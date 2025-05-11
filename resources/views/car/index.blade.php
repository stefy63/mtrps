@extends('layouts.app')

@section('template_title')
    Cars
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Cars') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('cars.create') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Create New') }}">
                                    <i class="bi bi-plus-circle"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                <tr>

                                    <th>Targa</th>
                                    <th>Tipo</th>
                                    <th>Proprietà</th>
                                    <th>Marca</th>
                                    <th>Alimentazione</th>
                                    <th>Account</th>
                                    <th>Nome</th>
                                    <th>Modello</th>
                                    <th>Colore</th>
                                    <th>Codice MOdello</th>
                                    <th>Account</th>
                                    <th>Serbatoio</th>
                                    <th>Km</th>
                                    <th>Descrizione</th>
                                    <th>Invernali</th>
                                    <th>Pneumatici</th>
                                    <th>Garanzia</th>
                                    <th>Tel Assistenza</th>
                                    <th>Telaio</th>
                                    <th>Data Revisione</th>
                                    <th>Documenti</th>
                                    <th>Note</th>

                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($cars as $car)

                                    <tr>
                                        <td class="list-">
{{--                                            <ul class="nav">--}}
                                                <x-item-link :href="route('cars.show', $car->id)">
                                                    {{ $car->carPlates[0]->name ?? '' }}
                                                </x-item-link>
{{--                                            </ul>--}}
                                        </td>
                                        <td>{{ $car->carType->name ?? '' }}</td>
                                        <td>{{ $car->carOwner->name ?? '' }}</td>
                                        <td>{{ $car->carBrand->name ?? '' }}</td>
                                        <td>{{ $car->carPower->name ?? '' }}</td>
                                        <td>{{ $car->carProfitAccount->name ?? '' }}</td>
                                        <td>{{ $car->name }}</td>
                                        <td>{{ $car->model }}</td>
                                        <td>{{ $car->color }}</td>
                                        <td>{{ $car->cod_model }}</td>
                                        <td>{{ $car->profit_account }}</td>
                                        <td>{{ $car->tank }}</td>
                                        <td>{{ $car->km }}</td>
                                        <td>{{ $car->description }}</td>
                                        <td>{{ $car->winter_wheels }}</td>
                                        <td>{{ $car->wheels_type }}</td>
                                        <td>{{ $car->warranty }}</td>
                                        <td>{{ $car->tel_warranty }}</td>
                                        <td>{{ $car->chassis }}</td>
                                        <td>{{ $car->date_revision }}</td>
                                        <td>{{ $car->doc }}</td>
                                        <td>{{ $car->note }}</td>

                                        <td class="text-end">
                                            <div class="btn-group dropstart dropstart-three-dots">
                                                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <form action="{{ route('cars.destroy', $car->id) }}" method="POST">
                                                        <li><a class="dropdown-item " href="{{ route('cars.show', $car->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a></li>
                                                        <li><a class="dropdown-item" href="{{ route('cars.edit', $car->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a></li>
                                                        @csrf
                                                        @method('DELETE')
                                                        <li>
                                                            <button type="submit" class="dropdown-item" data-confirm-delete="true"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                        </li>
                                                    </form>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    {!! $cars->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
