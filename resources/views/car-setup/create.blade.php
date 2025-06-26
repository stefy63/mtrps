@extends('layouts.app')

@section('template_title')
    Nuovo Allestimento
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">
                                <i class="bi bi-tools"></i> {{ __('Nuovo Allestimento') }}
                            </span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('car-setups.index') }}">
                                <i class="bi bi-arrow-left"></i> {{ __('Indietro') }}
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('car-setups.store') }}" role="form" enctype="multipart/form-data">
                            @csrf

                            @include('car-setup.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
