@extends('layouts.app')

@section('template_title')
    Modifica Centro di Costo {{ $carProfitAccount->code }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="card-title">
                                <i class="bi bi-pencil"></i> {{ __('Modifica Centro di Costo') }}: <strong>{{ $carProfitAccount->code }}</strong>
                            </span>
                            <div>
                                <a href="{{ route('car-profit-accounts.show', $carProfitAccount->id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i> Visualizza
                                </a>
                                <a href="{{ route('car-profit-accounts.index') }}" class="btn btn-sm btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Torna alla lista
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('car-profit-accounts.update', $carProfitAccount->id) }}" role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('car-profit-account.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
