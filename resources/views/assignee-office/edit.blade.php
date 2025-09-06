@extends('layouts.app')

@section('template_title')
    {{ __('Modifica') }} Ufficio Assegnatario
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Modifica') }} Ufficio Assegnatario</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('assignee-offices.index') }}">
                                <i class="bi bi-arrow-left"></i> {{ __('Indietro') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('assignee-offices.update', $assigneeOffice->id) }}" role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('assignee-office.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
