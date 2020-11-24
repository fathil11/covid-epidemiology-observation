<!DOCTYPE html>
<html lang="en">

<head>
    {{-- Meta --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700&display=swap"
        rel="stylesheet">

    <script src="{{ asset('js/app.js') }}"></script>

    {{-- Styles --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- Favico --}}
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon">
    <title>E-SWAB</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand font-weight-bold" href="#">
                <img src="{{ asset('img/favicon.png') }}" width="40" height="40" class="d-inline-block align-center"
                    alt="" loading="lazy">
                E-SWAB Melawi
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
                aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    @access('admin')
                    <li class="nav-item {{ Request::url() == route('admin.result.all') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.result.all') }}">Daftar Hasil</a>
                    </li>
                    @endaccess

                    @access('registration')
                    <li class="nav-item {{ Request::url() == route('registration.person.create') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('registration.person.create') }}">Pendaftaran Pasien Baru</a>
                    </li>

                    <li class="nav-item {{ Request::url() == route('registration.pe.people-search') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('registration.pe.people-search') }}">Daftar Pasien</a>
                    </li>

                    <li class="nav-item {{ Request::url() == route('pe.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('pe.index') }}">Daftar PE</a>
                    </li>
                    @endaccess

                    @access('lab')
                    <li class="nav-item {{ Request::url() == route('lab.pe') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('lab.pe') }}">Daftar PE (Hasil Yang Belum Keluar)</a>
                    </li>

                    <li class="nav-item {{ Request::url() == route('lab.pe.all') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('lab.pe.all') }}">Daftar Seluruh PE</a>
                    </li>
                    @endaccess

                    @access('statistic')
                    <li class="nav-item {{ Request::url() == route('statistic') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('statistic') }}">Statistik</a>
                    </li>
                    <li class="nav-item {{ Request::url() == route('statistic.positive') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('statistic.positive') }}">Data Konfirmasi</a>
                    </li>
                    <li class="nav-item {{ Request::url() == route('statistic.negative') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('statistic.negative') }}">Data Negatif</a>
                    </li>
                    @endaccess

                    <li class="nav-item {{ Request::is('hubungi-kami') }}">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>

                </ul>
            </div>

        </div>
    </nav>
    @yield('content')
    @include('sweetalert::alert')
    @stack('scripts')
</body>
</html>
