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
                                <a href="{{ route('cars.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        <th>Proprietario</th>
                                        <th>Marca</th>
                                        <th>Nome</th>
                                        <th>Modello</th>
                                        <th>Colore</th>
                                        <th>Km</th>
                                        <th>Alimentazione</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cars as $car)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $car->carPlates->first()?->name ?? 'N/A' }}</td>
                                            <td>{{ $car->carType?->name ?? 'N/A' }}</td>
                                            <td>{{ $car->carOwner?->name ?? 'N/A' }}</td>
                                            <td>{{ $car->carBrand?->name ?? 'N/A' }}</td>
                                            <td>{{ $car->name }}</td>
                                            <td>{{ $car->model ?? 'N/A' }}</td>
                                            <td>{{ $car->color ?? 'N/A' }}</td>
                                            <td>{{ number_format($car->km ?? 0) }} km</td>
                                            <td>{{ $car->carPower?->name ?? 'N/A' }}</td>

                                            <td>
                                                <form action="{{ route('cars.destroy', $car->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('cars.show', $car->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('cars.edit', $car->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $cars->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
