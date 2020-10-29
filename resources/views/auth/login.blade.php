<!DOCTYPE html>
<html lang="en" class="login-page">
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
<body class="bg-primary login-page">

    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-md-5 col-sm-12 text-white">

                <div class="text-center">
                    <img src="{{ asset('img/favicon.png') }}" class="img-fluid" alt="">
                    <h2 class="font-weight-bolder text-white d-block d-md-inline mt-2 mt-md-0">E-SWAB Kab. Melawi</h2>
                </div>

                <form method="POST" action="{{ route('login') }}" class="mt-4">
                    @csrf

                    <div class="form-group">
                        <label for="email" class="font-weight-bold">Email</label>
                        <input type="email" name="email" class="form-control rounded-pill" id="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    </div>

                    <div class="form-group">
                        <label for="password" class="font-weight-bold">Password</label>
                        <input type="password" name="password" class="form-control rounded-pill" id="password" placeholder="Password" required autocomplete="current-password">
                    </div>

                    <button type="submit" class="btn btn-outline-light rounded-pill btn-block mt-4">Login</button>

                </form>

            </div>
        </div>
    </div>
    @include('sweetalert::alert')
</body>
</html>
