<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div id="app">
    @if(Auth::check())
        <x-off-canvas-menu id="offcanvasmenu" label="Menu"></x-off-canvas-menu>
    @endif
    <nav class="navbar navbar-expand-md shadow-sm">

        @if(Auth::check())
            <button class="btn shadow-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasmenu"
                    aria-controls="offcanvasmenu">
                <i class="bi bi-list"></i>
            </button>
        @endif

        <div class="container-fluid w-100">
            <div>
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>
            <div class=" ">

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    {{ __('Profile') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    @if ($message = Session::get('success'))
        <div class="alert-custom alert alert-success m-4">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($message = Session::get('error'))
        <div class="alert-custom alert alert-danger m-4">
            <p>{{ $message }}</p>
        </div>
    @endif

    <main class="py-4">
        @yield('content')
    </main>

    @include('components.generic-select-modal')
</div>

@push('scripts')
    @include('js.dinamic-select')
@endpush
@stack('scripts')
@include('sweetalert::alert')
<script>
    // attende 3 secondi (3000 ms) e poi nasconde l'alert con un effetto fade-out
    setTimeout(function () {
        let alert = document.querySelector('.alert-custom');
        if (alert) {
            alert.style.transition = "opacity 1s ease"; // durata dissolvenza
            alert.style.opacity = 0;
            setTimeout(() => {
                alert.style.display = "none"; // rimuove l'alert dopo il fade
            }, 500); // tempo uguale alla durata della transition
        }
    }, 5000);
</script>
</body>
</html>
