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
                                {{ __('Uffici') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('car-assignees.create') }}"  data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Create New') }}">
                                  <i class="bi bi-plus-circle"></i>
                                </a>
                              </div>
                        </div>
                    </div>

                    <div class="card-body ">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>

									<th >Autovettura</th>
									<th >Name</th>
									<th >Description</th>
									<th >Dal</th>
									<th >Al</th>
									<th >Note</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carAssignees as $carAssignee)
                                        <tr>

										<td >{{ $carAssignee->car->carPlates[0]->name ?? '' }}</td>
										<td >{{ $carAssignee->name }}</td>
										<td >{{ $carAssignee->description }}</td>
										<td >{{ $carAssignee->date_from }}</td>
										<td >{{ $carAssignee->date_to }}</td>
										<td >{{ $carAssignee->note }}</td>

                                            <td class="text-end">
                                                <div class="btn-group dropstart dropstart-three-dots">
                                                  <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                  </button>
                                                  <ul class="dropdown-menu">
                                                  <form action="{{ route('car-assignees.destroy', $carAssignee->id) }}" method="POST">
                                                      <li><a class="dropdown-item " href="{{ route('car-assignees.show', $carAssignee->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a></li>
                                                      <li><a class="dropdown-item" href="{{ route('car-assignees.edit', $carAssignee->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a></li>
                                                      @csrf
                                                      @method('DELETE')
                                                      <li><button type="submit" class="dropdown-item" data-confirm-delete="true"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button></li>
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
                        {!! $carAssignees->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
