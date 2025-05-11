@extends('layouts.app')

@section('template_title')
    Car Profit Accounts
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Car Profit Accounts') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('car-profit-accounts.create') }}"  data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Create New') }}">
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
                                        
									<th >Code</th>
									<th >Name</th>
									<th >Description</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carProfitAccounts as $carProfitAccount)
                                        <tr>
                                            
										<td >{{ $carProfitAccount->code }}</td>
										<td >{{ $carProfitAccount->name }}</td>
										<td >{{ $carProfitAccount->description }}</td>

                                            <td class="text-end">
                                                <div class="btn-group dropstart dropstart-three-dots">
                                                  <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                  </button>
                                                  <ul class="dropdown-menu">
                                                  <form action="{{ route('car-profit-accounts.destroy', $carProfitAccount->id) }}" method="POST">
                                                      <li><a class="dropdown-item " href="{{ route('car-profit-accounts.show', $carProfitAccount->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a></li>
                                                      <li><a class="dropdown-item" href="{{ route('car-profit-accounts.edit', $carProfitAccount->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a></li>
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
                        {!! $carProfitAccounts->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
