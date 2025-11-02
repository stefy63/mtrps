@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Car
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Modifica Vettura') }} : {{ $car->carBrand?->name }}</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('cars.update', $car->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('car.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.select-check')
            .forEach((container) => {
                const select = container.querySelector('input[name$="_plate_id"]');
                const checkbox = container.querySelector('input[type="checkbox"]')
                // checkbox.disabled = true;
                select.addEventListener('change', function() {
                    setTimeout(() => {
                        checkbox.disabled = !this.value;
                    });
                });

            })
    </script>
@endpush
