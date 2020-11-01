@extends('layouts.registration')
@section('content')
<div class="container">
    <h1 class="text-primary text-center mt-5">Pendaftaran PE Lanjutan <br class="d-block d-md-none">E-SWAB</h1>
    <h5 class="text-primary text-center">Powered by Melawi Software Dev</h5>

    <form action="{{ route('registration.pe.redirect-nik') }}" method="POST" autocomplete="off">

    @csrf
    @method('POST')

    <div class="container">
        <div class="row mt-5">

                <div class="col-md-12 col-sm-12 mt-3">
                    <div class="form-group">
                        <label for="nik_check">NIK/Nomor identitas</label>
                        <input type="text" name="nik_check" class="form-control rounded-pill" placeholder="Masukan NIK/Nomor identitas pasien" value="{{ old('nik_check') }}">
                    </div>
                </div>

                <div class="col-md-12 mt-3 mb-5">
                    <button class="btn btn-primary rounded-pill btn-block" id="btn_nik_check" hidden>Lanjut</button>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection
