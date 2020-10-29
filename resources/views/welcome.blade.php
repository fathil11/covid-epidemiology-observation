<!DOCTYPE html>
<html lang="en">
<head>
    {{-- Meta --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Scripts --}}
    <script src="{{ asset('js/app.js') }}" defer></script>

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700&display=swap" rel="stylesheet">

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
                <img src="{{ asset('img/favicon.png') }}" width="40" height="40" class="d-inline-block align-center" alt="" loading="lazy">
                E-SWAB Melawi
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
              <ul class="navbar-nav ml-auto mt-2 mt-lg-0">

                <li class="nav-item {{ Request::is('pendaftaran') ? 'active' : '' }}">
                  <a class="nav-link" href="/">Pendaftaran</a>
                </li>

                <li class="nav-item {{ Request::is('qrcode') }}">
                    <a class="nav-link" href="/">Lupa QRCode ?</a>
                </li>

                <li class="nav-item {{ Request::is('hubungi-kami') }}">
                    <a class="nav-link" href="/">Hubungi Kami</a>
                </li>

            </ul>
            </div>

        </div>
      </nav>
      @include('sweetalert::alert')
</body>
</html>
