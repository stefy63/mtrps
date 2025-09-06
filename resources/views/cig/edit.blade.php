@extends('layouts.app')

@section('template_title')
    {{ __('Modifica CIG') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="card-title">
                                <i class="bi bi-pencil"></i> {{ __('Modifica CIG') }}
                            </span>
                            <a class="btn btn-primary btn-sm" href="{{ route('cigs.index') }}">
                                <i class="bi bi-arrow-left"></i> {{ __('Torna alla Lista') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('cigs.update', $cig->id) }}" role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('cig.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
