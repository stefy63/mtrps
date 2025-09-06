@extends('layouts.app')

@section('template_title')
    {{ __('Nuovo Rifornimento') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="card-title">
                                <i class="bi bi-fuel-pump"></i> {{ __('Nuovo Rifornimento') }}
                            </span>
                            <a class="btn btn-primary btn-sm" href="{{ route('car-fuels.index') }}">
                                <i class="bi bi-arrow-left"></i> {{ __('Torna alla Lista') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('car-fuels.store') }}" role="form" enctype="multipart/form-data">
                            @csrf

                            @include('car-fuel.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
