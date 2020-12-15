@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="text-primary text-center mt-5">Publikasi Data <br class="d-block d-md-none">E-SWAB</h1>
    <h5 class="text-primary text-center">Pengaturan rilis data</h5>

    <div class="row">
        <div class="col-md-3 mt-5">
            <div class="bg-danger p-2 rounded text-white text-center">
                <h4>Konfrimasi Rilis</h4>
                <h3>{{ $statistics['positive_release'] }}</h3>
            </div>
        </div>
        <div class="col-md-3 mt-5">
            <div class="bg-danger p-2 rounded text-white text-center">
                <h4>Konfirmasi Terbaru</h4>
                <h3>{{ $statistics['positive_new'] }}</h3>
            </div>
        </div>
        <div class="col-md-3 mt-5">
            <div class="bg-success p-2 rounded text-white text-center">
                <h4>Negatif Rilis</h4>
                <h3>{{ $statistics['negative_release'] }}</h3>
            </div>
        </div>
        <div class="col-md-3 mt-5">
            <div class="bg-success p-2 rounded text-white text-center">
                <h4>Negatif Terbaru</h4>
                <h3>{{ $statistics['negative_new'] }}</h3>
            </div>
        </div>

        <div class="col-md-6 mt-3">
            <div class="bg-danger p-2 rounded text-white text-center">
                <h4>Konfrimasi Total</h4>
                <h3>{{ $statistics['positive_total'] }}</h3>
            </div>
        </div>
        <div class="col-md-6 mt-3">
            <div class="bg-success p-2 rounded text-white text-center">
                <h4>Negatif Total</h4>
                <h3>{{ $statistics['negative_total'] }}</h3>
            </div>
        </div>
        <div class="col-md-12 mt-5">
            <a href="{{ route('admin.publication.publish') }}" class="btn btn-outline-secondary btn-block rounded-pill">RILIS DATA</a>
        </div>
    </div>
</div>
@endsection
