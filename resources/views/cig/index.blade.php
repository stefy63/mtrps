@extends('layouts.app')

@section('template_title')
    Cigs
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Cigs') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('cigs.create') }}"  data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Create New') }}">
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
                                        
									<th >Car Id</th>
									<th >Maintenance Garage Id</th>
									<th >User Rup Id</th>
									<th >User Support Id</th>
									<th >User Tender Notice Id</th>
									<th >User Tester Id</th>
									<th >Date</th>
									<th >Ce</th>
									<th >Description</th>
									<th >Preventive</th>
									<th >Final Report</th>
									<th >Taxable</th>
									<th >Vat</th>
									<th >Cig</th>
									<th >Note</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cigs as $cig)
                                        <tr>
                                            
										<td >{{ $cig->car_id }}</td>
										<td >{{ $cig->maintenance_garage_id }}</td>
										<td >{{ $cig->user_rup_id }}</td>
										<td >{{ $cig->user_support_id }}</td>
										<td >{{ $cig->user_tender_notice_id }}</td>
										<td >{{ $cig->user_tester_id }}</td>
										<td >{{ $cig->date }}</td>
										<td >{{ $cig->ce }}</td>
										<td >{{ $cig->description }}</td>
										<td >{{ $cig->preventive }}</td>
										<td >{{ $cig->final_report }}</td>
										<td >{{ $cig->taxable }}</td>
										<td >{{ $cig->vat }}</td>
										<td >{{ $cig->cig }}</td>
										<td >{{ $cig->note }}</td>

                                            <td class="text-end">
                                                <div class="btn-group dropstart dropstart-three-dots">
                                                  <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                  </button>
                                                  <ul class="dropdown-menu">
                                                  <form action="{{ route('cigs.destroy', $cig->id) }}" method="POST">
                                                      <li><a class="dropdown-item " href="{{ route('cigs.show', $cig->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a></li>
                                                      <li><a class="dropdown-item" href="{{ route('cigs.edit', $cig->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a></li>
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
                        {!! $cigs->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
