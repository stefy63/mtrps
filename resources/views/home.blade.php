@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Dashboard') }}
                            </span>

                    <div class="float-right" id="spinner">
                        <div class="spinner-grow text-info" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="w-100 table table-striped table-bordered">
                    <thead>
                    <tr class="">
                        <th class="text-bg-info fw-bold">
                            ENTE
                        </th>
                        <th class="text-bg-info fw-bold ">TOTALI</th>
                        <th class="text-bg-info fw-bold">PRESTATE</th>
                        <th class="text-bg-info fw-bold">IN PRESTITO</th>
                        <th class="text-bg-info fw-bold">IN RIPARAZIONE</th>
                        <th class="text-bg-info fw-bold">DISPONIBILI</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $d)
                        <tr class="">
                            <td class="fw-bold text-truncate">
                                {{$d->ente}}
                            </td>
                            <td class="fw-bold">{{$d->active_cars_count}}</td>
                            <td class="fw-bold text-danger">{{$d->movements_to_count}}</td>
                            <td class="fw-bold text-info">{{$d->movements_from_count}}</td>
                            <td class="fw-bold text-muted">{{$d->active_maintenance_count}}</td>
                            <td class="fw-bold text-success">{{($d->active_cars_count + $d->movements_from_count) - ($d->active_maintenance_count + $d->movements_to_count)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="module">
        $('#spinner').hide();
        setTimeout(() => {
            $('#spinner').show();
            location.reload();
        }, 30000)
    </script>

@endpush