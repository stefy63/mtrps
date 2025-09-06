@extends('layouts.app')

@section('template_title')
    {{ __('Nuovo Tipo Intervento') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="card-title">
                                <i class="bi bi-tools"></i> {{ __('Nuovo Tipo Intervento') }}
                            </span>
                            <a class="btn btn-primary btn-sm" href="{{ route('maintenance-types.index') }}">
                                <i class="bi bi-arrow-left"></i> {{ __('Torna alla Lista') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('maintenance-types.store') }}" role="form" enctype="multipart/form-data">
                            @csrf

                            @if(request()->has('maintenance_id'))
                                <input type="hidden" name="redirect_to_maintenance" value="1">
                            @endif

                            @include('maintenance-type.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
