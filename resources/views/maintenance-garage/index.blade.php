@extends('layouts.app')

@section('template_title')
    Maintenance Garages
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Maintenance Garages') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('maintenance-garages.create') }}"  data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Create New') }}">
                                  <i class="bi bi-plus-circle"></i>
                                </a>
                              </div>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        
									<th >Maintenance Id</th>
									<th >Name</th>
									<th >Piva</th>
									<th >Cf</th>
									<th >Iban</th>
									<th >Pec</th>
									<th >Acc</th>
									<th >Anti Mafia</th>
									<th >Durc</th>
									<th >Description</th>
									<th >Note</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($maintenanceGarages as $maintenanceGarage)
                                        <tr>
                                            
										<td >{{ $maintenanceGarage->maintenance_id }}</td>
										<td >{{ $maintenanceGarage->name }}</td>
										<td >{{ $maintenanceGarage->piva }}</td>
										<td >{{ $maintenanceGarage->cf }}</td>
										<td >{{ $maintenanceGarage->iban }}</td>
										<td >{{ $maintenanceGarage->pec }}</td>
										<td >{{ $maintenanceGarage->acc }}</td>
										<td >{{ $maintenanceGarage->anti_mafia }}</td>
										<td >{{ $maintenanceGarage->durc }}</td>
										<td >{{ $maintenanceGarage->description }}</td>
										<td >{{ $maintenanceGarage->note }}</td>

                                            <td class="text-end">
                                                <div class="btn-group dropstart dropstart-three-dots">
                                                  <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                  </button>
                                                  <ul class="dropdown-menu">
                                                  <form action="{{ route('maintenance-garages.destroy', $maintenanceGarage->id) }}" method="POST">
                                                      <li><a class="dropdown-item " href="{{ route('maintenance-garages.show', $maintenanceGarage->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a></li>
                                                      <li><a class="dropdown-item" href="{{ route('maintenance-garages.edit', $maintenanceGarage->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a></li>
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
                        {!! $maintenanceGarages->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
