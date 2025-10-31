@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Office
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Office</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('offices.update', $office->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('office.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
