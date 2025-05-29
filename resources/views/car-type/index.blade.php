@extends('layouts.app')

@section('template_title')
    Car Types
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Car Types') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('car-types.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        <th>Nome</th>
                                        <th>Descrizione</th>
                                        <th>Data Creazione</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carTypes as $carType)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td><strong>{{ $carType->name }}</strong></td>
                                            <td>{{ Str::limit($carType->description ?? 'N/A', 50) }}</td>
                                            <td>{{ $carType->created_at->format('d/m/Y') }}</td>

                                            <td>
                                                <form action="{{ route('car-types.destroy', $carType->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('car-types.show', $carType->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('car-types.edit', $carType->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $carTypes->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection