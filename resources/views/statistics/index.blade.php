@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="text-primary text-center mt-5">Statistik COVID-19 <br class="d-block d-md-none">E-SWAB</h1>
    <h5 class="text-primary text-center">Powered by Melawi Software Dev</h5>

    <div class="row mt-5">
        <div class="col-md-3 col-6">
            <div class="bg-danger rounded text-center text-white py-3">
                <h4 class="">Total <br>Konfirmasi</h4>
                <h2 class="font-weight-bold">{{ $statistic['positive'] }}</h2>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="bg-danger rounded text-center text-white py-3">
                <h4 class="">Konfirmasi <br>Terbaru</h4>
                <h2 class="font-weight-bold">{{ $statistic['last_positive'] }}</h2>
            </div>
        </div>
        <div class="col-md-3 col-6 mt-md-0 mt-3">
            <div class="bg-success rounded text-center text-white py-3">
                <h4 class="">Total <br>Negatif</h4>
                <h2 class="font-weight-bold">{{ $statistic['negative'] }}</h2>
            </div>
        </div>
        <div class="col-md-3 col-6 mt-md-0 mt-3">
            <div class="bg-success rounded text-center text-white py-3">
                <h4 class="">Negatif <br>Terbaru</h4>
                <h2 class="font-weight-bold">{{ $statistic['last_negative'] }}</h2>
            </div>
        </div>
        <div class="col-md-3 col-6 mt-md-3 mt-3">
            <div class="bg-secondary rounded text-center text-white py-3">
                <h4 class="">Total <br>SWAB</h4>
                <h2 class="font-weight-bold">{{ $statistic['swab_total'] }}</h2>
            </div>
        </div>
        <div class="col-md-3 col-6 mt-md-3 mt-3">
            <div class="bg-secondary rounded text-center text-white py-3">
                <h4 class="">SWAB <br>Tanpa Hasil</h4>
                <h2 class="font-weight-bold">{{ $statistic['swab_unresulted'] }}</h2>
            </div>
        </div>
    </div>

    <div class="row mt-5 mb-5">
        <div class="col-md-6">
            <canvas id="district_chart"></canvas>
        </div>
    </div>
</div>
@endsection
