@extends('layouts.app')

@section('template_title')
    {{ __('Nuova Manutenzione') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="card-title">
                                <i class="bi bi-wrench"></i> {{ __('Nuova Manutenzione') }}
                            </span>
                            <a class="btn btn-primary btn-sm" href="{{ route('maintenances.index') }}">
                                <i class="bi bi-arrow-left"></i> {{ __('Torna alla Lista') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('maintenances.store') }}" role="form" enctype="multipart/form-data">
                            @csrf

                            @include('maintenance.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
