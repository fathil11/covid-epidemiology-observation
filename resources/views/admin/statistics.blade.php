@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="text-primary text-center mt-5">Statistik Admin COVID-19 <br class="d-block d-md-none">E-SWAB</h1>
    <h5 class="text-primary text-center">Powered by Melawi Software Dev</h5>

    <table class="table table-hover mt-5">
        <thead>
            <tr>
              <th scope="col" class="text-success">#</th>
              <th scope="col" class="text-success">Total SWAB</th>
              <th scope="col" class="text-success">SWAB Sudah Ada Hasil</th>
              <th scope="col" class="text-success">SWAB Belum Ada Hasil</th>
              <th scope="col" class="text-success">Total Positif</th>
              <th scope="col" class="text-success">Total Negatif</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row" class="text-danger">Melawi</th>
              <td scope="row" class="text-danger">{{ $statistics['tests_total'] }}</td>
              <td scope="row" class="text-danger">{{ $statistics['tests_resulted_total'] }}</td>
              <td scope="row" class="text-danger">{{ $statistics['tests_unresulted_total'] }}</td>
              <td scope="row" class="text-danger">{{ $statistics['positive_total'] }}</td>
              <td scope="row" class="text-danger">{{ $statistics['negative_total'] }}</td>
            </tr>
            @foreach ($districts as $district)
            <tr>
                <th scope="row">{{ Str::title($district) }}</th>
                <td>{{ $statistics[$district.'_tests_total'] }}</td>
                <td>{{ $statistics[$district.'_tests_resulted_total'] }}</td>
                <td>{{ $statistics[$district.'_tests_unresulted_total'] }}</td>
                <td>{{ $statistics[$district.'_positive_total'] }}</td>
                <td>{{ $statistics[$district.'_negative_total'] }}</td>
              </tr>
            @endforeach

          </tbody>
    </table>

    <div class="row mt-5 mb-5">
        <div class="col-md-6">
            <canvas id="district_chart"></canvas>
        </div>
    </div>
</div>
@endsection
