@extends('layouts.app')

@section('template_title')
    Nuovo Movimento
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="card-title">
                                <i class="bi bi-plus-circle"></i> {{ __('Nuovo Movimento Veicolo') }}
                            </span>
                            <a href="{{ route('movements.index') }}" class="btn btn-sm btn-secondary">
                                <i class="bi bi-arrow-left"></i> Torna alla lista
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('movements.store') }}" role="form" enctype="multipart/form-data">
                            @csrf

                            @include('movement.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
