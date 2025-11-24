@extends('layouts.app')

@section('template_title')
    Car Brands
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Codici di\'impiego') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('employment-code.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Nuova Marca') }}
                                </a>
                              </div>
                        </div>
                    </div>

                    <div class="card-body bg-white">

                        <div class="col-12">
                            <x-input-search-button
                                    action="{{ route('employment-code.index') }}"
                                    search="{{old('search', $search)}}"
                            />
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>Codice</th>
                                        <th>Descrizione</th>
                                        <th>Vetture</th>
                                        <th>Data Creazione</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carEmploymentCode as $employment)
                                        <tr>
                                            <td>
                                                <strong class="text-primary">{{ $employment->code }}</strong>
                                            </td>
                                            <td>{{ Str::limit($employment->description ?? 'N/A', 60) }}</td>
                                            <td>
                                                <span class="badge bg-info w-50">
                                                    {{ $employment->cars->count() ?? 0 }}
                                                </span>
                                            </td>
                                            <td>{{ $employment->created_at->format('d/m/Y') }}</td>

                                            <td class="text-end">
                                                <x-action-table-button :item="$employment" :label="'Codice d\'impiego'"  itemRoute="employment-code" />
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $carEmploymentCode->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection