@extends('layouts.app')

@section('template_title')
    Car Equipments
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Car Equipments') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('car-equipments.create') }}"  data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Create New') }}">
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
                                        
									<th >Car Id</th>
									<th >Name</th>
									<th >Description</th>
									<th >Date From</th>
									<th >Date To</th>
									<th >Note</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carEquipments as $carEquipment)
                                        <tr>
                                            
										<td >{{ $carEquipment->car_id }}</td>
										<td >{{ $carEquipment->name }}</td>
										<td >{{ $carEquipment->description }}</td>
										<td >{{ $carEquipment->date_from }}</td>
										<td >{{ $carEquipment->date_to }}</td>
										<td >{{ $carEquipment->note }}</td>

                                            <td class="text-end">
                                                <div class="btn-group dropstart dropstart-three-dots">
                                                  <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                  </button>
                                                  <ul class="dropdown-menu">
                                                  <form action="{{ route('car-equipments.destroy', $carEquipment->id) }}" method="POST">
                                                      <li><a class="dropdown-item " href="{{ route('car-equipments.show', $carEquipment->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a></li>
                                                      <li><a class="dropdown-item" href="{{ route('car-equipments.edit', $carEquipment->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a></li>
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
                        {!! $carEquipments->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
