@extends('layouts.app')

@section('template_title')
    Offices
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Offices') }}
                            </span>
                            <div class="float-right">
                                <a href="{{ route('offices.create') }}" class="btn btn-primary btn-sm float-right"
                                   data-bs-toggle="tooltip" data-bs-placement="top" title="Nuovo Ufficio">
                                    <i class="bi bi-plus-circle"></i> {{ __('Nuovo Ufficio') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-12">
                                <x-input-search-button
                                        acttion="{{ route('movements.index') }}"
                                        search="{{$search}}"
                                />
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                <tr>

                                    <th>Ente</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Mail</th>
                                    <th>Address</th>
                                    <th>Description</th>
                                    <th>Note</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($offices as $office)
                                    <tr>

                                        <td>{{ $office->ente }}</td>
                                        <td>{{ $office->name }}</td>
                                        <td>{{ $office->phone }}</td>
                                        <td>{{ $office->mail }}</td>
                                        <td>{{ $office->address }}</td>
                                        <td>{{ $office->description }}</td>
                                        <td>{{ $office->note }}</td>

                                        <td class="text-end">
                                            <x-action-table-button :item="$office" :label="'Ufficio'"/>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    {!! $offices->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
