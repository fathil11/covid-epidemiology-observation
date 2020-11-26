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
    <title>E-SWAB {{ Str::title($test->person->name) }} ({{ Str::upper($test->result->value) }})</title>
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
                                    <td><p class="h5"><b>{{ Str::title($test->person->name) }}</b></p></td>
                                </tr>
                                <tr>
                                    <td class="pr-md-4 pr-1"><p class="h5">Tanggal Lahir</p></td>
                                    <td class="pr-md-3 pr-2"><p class="h5"> : </p></td>
                                    <td><p class="h5"><b>{{ $test->person->birth_at != null ? $test->person->birth_at->isoFormat('DD MMMM Y') : '-'}}</b></p></td>
                                </tr>
                                <tr>
                                    <td class="pr-md-4 pr-1"><p class="h5">Alamat</p></td>
                                    <td class="pr-md-3 pr-2"><p class="h5"> : </p></td>
                                    <td><p class="h5"><b>{{ $test->living_village .', '. $test->living_district . ', ' . $test->living_regency}}</b></p></td>
                                </tr>
                                @if ($test->test_at != $test->result->created_at)
                                <tr>
                                    <td class="pr-md-4 pr-1"><p class="h5">Tanggal Tes SWAB</p></td>
                                    <td class="pr-md-3 pr-2"><p class="h5"> : </p></td>
                                    <td><p class="h5"><b>{{ $test->test_at != null ? $test->test_at->isoFormat('DD MMMM Y') : '-'}}</b></p></td>
                                </tr>
                                @endif
                                <tr>
                                    <td class="pr-md-4 pr-1"><p class="h5">Tanggal Keluar Hasil</p></td>
                                    <td class="pr-md-3 pr-2"><p class="h5"> : </p></td>
                                    <td><p class="h5"><b>{{ $test->result != null ? $test->result->created_at->isoFormat('DD MMMM Y') : '-'}}</b></p></td>
                                </tr>
                                <tr>
                                    <td class="pr-md-4 pr-1"><p class="h5">Hasil SWAB</p></td>
                                    <td class="pr-md-3 pr-2"><p class="h5"> : </p></td>
                                    <td><p class="h5"><b>{{ $test->result != null ? Str::title($test->result->value) : 'Belum keluar hasil' }}</b></p></td>
                                </tr>
                                <tr>
                                    <td class="pr-md-4 pr-1"><p class="h5">Penanggung Jawab</p></td>
                                    <td class="pr-md-3 pr-2"><p class="h5"> : </p></td>
                                    <td><p class="h5"><b>dr. Ahmad Jawahir</b></p></td>
                                </tr>
                            </table>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-12 mt-1 px-0 px-md-15 px-15" id="qrcode" data-link="{{ route('public.result', $test->code) }}">
                            </div>
                            @if ($test->result != null)
                            <div class="col-md-12 mt-3">
                                <a href="{{ route('public.result.mail.download', $test->code) }}" class="btn btn-outline-light btn-block">Download Surat Keterangan</a>
                            </div>
                            @endif
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    {{-- <audio id="bgsound1">
        <source src="/sounds/robbert.mp3" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio> --}}
    @include('sweetalert::alert')

</body>
</html>
