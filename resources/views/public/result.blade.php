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
                    <h2 class="font-weight-bolder d-block d-md-inline mt-2 mt-md-0">E-SWAB Kab. Melawi</h2>
                    <button class="btn btn-outline-light px-5 mt-4" id="btn-show-result"><h5 class="mb-0">Lihat Hasil</h5></button>
                    <div class="text-rainbow" style="display: none" id="result">
                        <hr>
                        <div class="mt-4 text-left">
                            <table class="mx-auto">
                                <tr>
                                    <td class="pr-md-4 pr-1"><p class="h5">Nama</p></td>
                                    <td class="pr-md-3 pr-2"><p class="h5"> : </p></td>
                                    <td><p class="h5"><b>Harianto Gerut</b></p></td>
                                </tr>
                                <tr>
                                    <td class="pr-md-4 pr-1"><p class="h5">Umur</p></td>
                                    <td class="pr-md-3 pr-2"><p class="h5"> : </p></td>
                                    <td><p class="h5"><b>5 tahun</b></p></td>
                                </tr>
                                <tr>
                                    <td class="pr-md-4 pr-1"><p class="h5">Hasil SWAB</p></td>
                                    <td class="pr-md-3 pr-2"><p class="h5"> : </p></td>
                                    <td><p class="h5"><b>Negatif</b></p></td>
                                </tr>
                                <tr>
                                    <td class="pr-md-4 pr-1"><p class="h5">Penanggung Jawab</p></td>
                                    <td class="pr-md-3 pr-2"><p class="h5"> : </p></td>
                                    <td><p class="h5"><b>Agus Nawan</b></p></td>
                                </tr>
                            </table>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col mt-1 mx-5 px-5">
                                <div class="" id="qrcode"></div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <audio id="bgsound1">
        <source src="/sounds/robbert.mp3" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
    @include('sweetalert::alert')
</body>
</html>
