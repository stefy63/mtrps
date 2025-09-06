@extends('layouts.app')

@section('template_title')
    Nuovo Centro di Costo
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="card-title">
                                <i class="bi bi-plus-circle"></i> {{ __('Nuovo Centro di Costo') }}
                            </span>
                            <a href="{{ route('car-profit-accounts.index') }}" class="btn btn-sm btn-secondary">
                                <i class="bi bi-arrow-left"></i> Torna alla lista
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('car-profit-accounts.store') }}" role="form" enctype="multipart/form-data">
                            @csrf

                            @include('car-profit-account.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
