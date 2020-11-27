@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="text-primary text-center mt-5">Statistik Admin COVID-19 <br class="d-block d-md-none">E-SWAB</h1>
    <h5 class="text-primary text-center">Powered by Melawi Software Dev</h5>

    <div class="row mt-5">
        <div class="col-md-12 table-responsive">
            <h4 class="text-center">Tabel Statistik Per Desa</h4>
            <table class="table table-hover mt-3">
                <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Total SWAB</th>
                      <th scope="col">SWAB Sudah Ada Hasil</th>
                      <th scope="col">SWAB Belum Ada Hasil</th>
                      <th scope="col">Total Positif</th>
                      <th scope="col">Total Negatif</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">Total</th>
                      <td scope="row">{{ $statistics['tests_total'] }}</td>
                      <td scope="row">{{ $statistics['tests_resulted_total'] }}</td>
                      <td scope="row">{{ $statistics['tests_unresulted_total'] }}</td>
                      <td scope="row">{{ $statistics['positive_total'] }}</td>
                      <td scope="row">{{ $statistics['negative_total'] }}</td>
                    </tr>
                    <tr>
                      <th scope="row" class="text-danger">Melawi</th>
                      <td scope="row" class="text-danger">{{ $statistics['melawi_tests_total'] }}</td>
                      <td scope="row" class="text-danger">{{ $statistics['melawi_tests_resulted_total'] }}</td>
                      <td scope="row" class="text-danger">{{ $statistics['melawi_tests_unresulted_total'] }}</td>
                      <td scope="row" class="text-danger">{{ $statistics['melawi_positive_total'] }}</td>
                      <td scope="row" class="text-danger">{{ $statistics['melawi_negative_total'] }}</td>
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
                    <tr>
                        <th scope="row" class="text-secondary">Luar Wilayah</th>
                        <td scope="row" class="text-secondary">{{ $statistics['external_tests_total'] }}</td>
                        <td scope="row" class="text-secondary">{{ $statistics['external_tests_resulted_total'] }}</td>
                        <td scope="row" class="text-secondary">{{ $statistics['external_tests_unresulted_total'] }}</td>
                        <td scope="row" class="text-secondary">{{ $statistics['external_positive_total'] }}</td>
                        <td scope="row" class="text-secondary">{{ $statistics['external_negative_total'] }}</td>
                      </tr>
                  </tbody>
            </table>
        </div>
    </div>


    <div class="row mt-5 mb-5">
        <div class="col-md-12">
            <h4 class="text-center">Grafik Konfirmasi & Total SWAB Per Desa</h4>
            <canvas class="mt-3" id="district_chart"
            data-positive-sokan="{{ $statistics['sokan_positive_total'] }}" data-positive-tanah-pinoh="{{ $statistics['tanah pinoh_positive_total'] }}"
            data-positive-tanah-pinoh-barat="{{ $statistics['tanah pinoh barat_positive_total'] }}"
            data-positive-sayan="{{ $statistics['sayan_positive_total'] }}" data-positive-belimbing="{{ $statistics['belimbing_positive_total'] }}"
            data-positive-belimbing-hulu="{{ $statistics['belimbing hulu_positive_total'] }}"
            data-positive-nanga-pinoh="{{ $statistics['nanga pinoh_positive_total'] }}"
            data-positive-pinoh-selatan="{{ $statistics['pinoh selatan_positive_total'] }}"
            data-positive-pinoh-utara="{{ $statistics['pinoh utara_positive_total'] }}"
            data-positive-ella-hilir="{{ $statistics['ella hilir_positive_total'] }}"
            data-positive-menukung="{{ $statistics['menukung_positive_total'] }}"
            data-test-sokan="{{ $statistics['sokan_tests_total'] }}"
            data-test-tanah-pinoh="{{ $statistics['tanah pinoh_tests_total'] }}" data-test-tanah-pinoh-barat="{{ $statistics['tanah pinoh barat_tests_total'] }}"
            data-test-sayan="{{ $statistics['sayan_tests_total'] }}"
            data-test-belimbing="{{ $statistics['belimbing_tests_total'] }}"
            data-test-belimbing-hulu="{{ $statistics['belimbing hulu_tests_total'] }}"
            data-test-nanga-pinoh="{{ $statistics['nanga pinoh_tests_total'] }}"
            data-test-pinoh-selatan="{{ $statistics['pinoh selatan_tests_total'] }}"
            data-test-pinoh-utara="{{ $statistics['pinoh utara_tests_total'] }}"
            data-test-ella-hilir="{{ $statistics['ella hilir_tests_total'] }}"
            data-test-menukung="{{ $statistics['menukung_tests_total'] }}"></canvas>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
    <script>
    var ctx = $('#district_chart');
    var myChart = new Chart(ctx, {
        type: 'bar',
        plugins: [ChartDataLabels],
        data: {
            labels: [
                'Nanga Pinoh',
                'Pinoh Utara',
                'Pinoh Selatan',
                'Belimbing',
                'Belimbing Hulu',
                'Sokan',
                'Sayan',
                'Tanah Pinoh',
                'Tanah Pinoh Barat',
                'Ella Hilir',
                'Menukung'
            ],
            datasets: [
                {
                    label: 'Total Positif',
                    data: [
                        ctx.data('positive-nanga-pinoh'),
                        ctx.data('positive-pinoh-utara'),
                        ctx.data('positive-pinoh-selatan'),
                        ctx.data('positive-belimbing'),
                        ctx.data('positive-belimbing-hulu'),
                        ctx.data('positive-sokan'),
                        ctx.data('positive-sayan'),
                        ctx.data('positive-tanah-pinoh'),
                        ctx.data('positive-tanah-pinoh-barat'),
                        ctx.data('positive-ella-hilir'),
                        ctx.data('positive-menukung'),
                    ],
                    backgroundColor: 'rgb(224,74,59)',
                    borderWidth: 1
                },
                {
                    label: 'Total SWAB',
                    data: [
                        ctx.data('test-nanga-pinoh'),
                        ctx.data('test-pinoh-utara'),
                        ctx.data('test-pinoh-selatan'),
                        ctx.data('test-belimbing'),
                        ctx.data('test-belimbing-hulu'),
                        ctx.data('test-sokan'),
                        ctx.data('test-sayan'),
                        ctx.data('test-tanah-pinoh'),
                        ctx.data('test-tanah-pinoh-barat'),
                        ctx.data('test-ella-hilir'),
                        ctx.data('test-menukung'),
                    ],
                    backgroundColor: 'rgb(42,146,216)',
                    borderWidth: 1
                },

            ]
        },
        options: {
            plugins: {
                datalabels: {
                    display: 'auto',
                    anchor: 'end',
                    clamp: false,
                    color: '#000000',
                    font: {
                        size: 18,
                        weight: 'bold'
                    }
                }
        },
            legend: {
                position: 'bottom'
            },
            tooltips: {
                mode: 'index',
                intersect: false,
                label: {
                    fontColor: '#000000'
                }

            },
            scales: {
                xAxes: [{
                    stacked: true,
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: false
                    }
                }]
            },
            // "animation": {
            //     "duration": 1,
            //     "onComplete": function() {
            //         var chartInstance = this.chart,
            //         ctx = chartInstance.ctx;

            //         ctx.textAlign = 'center';
            //         ctx.textBaseline = 'bottom';

            //         this.data.datasets.forEach(function(dataset, i) {
            //         var meta = chartInstance.controller.getDatasetMeta(i);
            //         meta.data.forEach(function(bar, index) {
            //             var data = dataset.data[index];
            //             ctx.fillText(data, bar._model.x, bar._model.y - 5);
            //         });
            //         });
            //     }
            // },
        }
    });
</script>
@endpush
@endsection
