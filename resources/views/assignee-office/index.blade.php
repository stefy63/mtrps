@extends('layouts.app')

@section('template_title')
    Assignee Offices
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
                                <a href="{{ route('assignee-offices.create') }}"  data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Create New') }}">
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

									<th >Ufficio</th>
									<th >Nome</th>
									<th >Descrizione</th>
									<th >Note</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($assigneeOffices as $assigneeOffice)
                                        <tr>

										<td >{{ $assigneeOffice->carAssignee->name ?? '' }}</td>
										<td >{{ $assigneeOffice->name }}</td>
										<td >{{ $assigneeOffice->description }}</td>
										<td >{{ $assigneeOffice->note }}</td>

                                            <td class="text-end">
                                                <div class="btn-group dropstart dropstart-three-dots">
                                                  <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                  </button>
                                                  <ul class="dropdown-menu">
                                                  <form action="{{ route('assignee-offices.destroy', $assigneeOffice->id) }}" method="POST">
                                                      <li><a class="dropdown-item " href="{{ route('assignee-offices.show', $assigneeOffice->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a></li>
                                                      <li><a class="dropdown-item" href="{{ route('assignee-offices.edit', $assigneeOffice->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a></li>
                                                      @csrf
                                                      @method('DELETE')
                                                      <li><button type="submit" class="dropdown-item" data-confirm-delete="true"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button></li>
                                                  </form>
                                                  </ul>
                                            </td>
                                        </tr>
                                    @endforeach
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
