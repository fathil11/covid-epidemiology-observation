@extends('layouts.registration')
@section('content')
<div class="container">
    <h1 class="text-primary text-center mt-5">Pendaftaran PE <br class="d-block d-md-none">E-SWAB</h1>
    <h5 class="text-primary text-center">Powered by Melawi Software Dev</h5>

    <div class="container">
        <div class="row mt-5 justify-content-center">
            @include('components.form-header', ['title' => 'Keterangan Wawancara'])
            <div class="col-md-12 mb-4">
                <div class="card shadow rounded">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table>
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Nama Fasyankes</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->user->instance }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Tempat Fasyankes</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{  $pe->user->instance_place }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Tanggal Wawancara</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->created_at->isoFormat('DD MMMM Y') }}</p>
                                        </td>
                                    </tr>

                                </table>
                            </div>
                            <div class="col-md-6">
                                <table>

                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Nama Petugas PE</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->user->name }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>No HP Petugas PE</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->user->phone }}</p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('components.form-header', ['title' => 'Identitas Pasien'])
            <div class="col-md-12 mb-4">
                <div class="card shadow rounded">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table>
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Nama</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->person->name }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>NIK</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->person->nik }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Tanggal Lahir (Umur)</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{  $pe->person->birth_at->isoFormat('DD MMMM Y') }} ({{ $pe->person->age }} tahun)
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Jenis Kelamin</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->person->jenis_kelamin }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Nomor HP</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->person->phone }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Instansi (Pekerjaan)</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->person->work }} ({{ $pe->person->work_instance }})</p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table>
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Provinsi</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->person->card_province }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Kota / Kabupaten</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->person->card_regency }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Kecamatan</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->person->card_district }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Desa</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->person->card_village }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Jalan</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->person->card_street }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>RT/RW</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->person->card_rt }}/{{ $pe->person->card_rw }}</p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('components.form-header', ['title' => 'Informasi Tes'])
            <div class="col-md-12 mb-4">
                <div class="card shadow rounded">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table>
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Jenis Tes</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->test }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Kategori {{ $pe->test }}</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{  $pe->type }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Lokasi SWAB</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->location }}</p>
                                        </td>
                                    </tr>

                                </table>
                            </div>
                            <div class="col-md-6">
                                <table>
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Nomor Tabung</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->tube_code }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Kode Kelompok</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->group_code }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Kriteria</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->criteria }}</p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('components.form-header', ['title' => 'Informasi Epidemiologi'])
            <div class="col-md-12 mb-4">
                <div class="card shadow rounded">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="text-success"><u><b>Gejala</u></b></h4>

                                @if ($pe->symptoms->count() > 0)
                                <table class="mt-2">
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Awal gejala</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->symptoms->first()->symptom_at->isoFormat('DD MMMM Y') }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Gejala</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->symptoms_list }}</p>
                                        </td>
                                    </tr>
                                </table>
                                @else
                                <h5 class="mt-2">Tidak ada</h5>
                                @endif
                            </div>

                            <div class="col-md-6 mt-4 mt-md-0">
                                <h4 class="text-success"><u><b>Kondisi Penyerta</u></b></h4>

                                @if ($pe->comorbidities->count() > 0)
                                <h5 class="mt-2">{{ $pe->comorbidities_list }}</h5>
                                @else
                                <h5 class="mt-2">Tidak ada</h5>
                                @endif
                            </div>

                            <div class="col-md-6 mt-4">
                                <h4 class="text-success"><u><b>Diagnosa</u></b></h4>

                                @if ($pe->diagnoses->count() > 0)
                                <h5 class="mt-2">{{ $pe->diagnoses_list }}</h5>
                                @else
                                <h5 class="mt-2">Tidak ada</h5>
                                @endif
                            </div>

                            <div class="col-md-6 mt-4">
                                <h4 class="text-success"><u><b>Riwayat Rumah Sakit</u></b></h4>

                                @if ($pe->hospital != null)
                                <table class="mt-2">
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Tanggal masuk</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->hospital->start_at->isoFormat('DD MMMM Y') }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Nama RS</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->hospital->name }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Keterangan Tambahan</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->hospital->additional }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Status Terakhir</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->hospital->status }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Riwayat RS Lainnya</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->hospital->name_histories != null ? 'Tidak ada' : $pe->hospital->name_histories }}</p>
                                        </td>
                                    </tr>
                                </table>
                                @else
                                <h5 class="mt-2">Tidak ada</h5>
                                @endif
                            </div>

                            <div class="col-md-12">
                                @include('components.form-section-end')
                            </div>

                            <div class="col-md-6 mt-4">
                                <h4 class="text-success"><u><b>Perjalanan Internasional</u></b></h4>

                                @if ($pe->international_travels->count() > 0)
                                <table class="mt-2">
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Negara</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->international_travels->first()->country }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Kota</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->international_travels->first()->regency }}</p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Tanggal Berangkat</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->international_travels->first()->departure_at->isoFormat('DD MMMM Y') }}</p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Tanggal Berangkat</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->international_travels->first()->arrive_at->isoFormat('DD MMMM Y') }}</p>
                                        </td>
                                    </tr>
                                </table>
                                @else
                                <h5 class="mt-2">Tidak ada</h5>
                                @endif
                            </div>

                            <div class="col-md-6 mt-4">
                                <h4 class="text-success"><u><b>Perjalanan Domestik</u></b></h4>

                                @if ($pe->domestic_travels->count() > 0)
                                <table class="mt-2">
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Provinsi</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->domestic_travels->first()->province }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Kota / Kabupaten</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->domestic_travels->first()->regency }}</p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Tanggal Berangkat</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->domestic_travels->first()->departure_at->isoFormat('DD MMMM Y') }}</p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Tanggal Berangkat</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->domestic_travels->first()->arrive_at->isoFormat('DD MMMM Y') }}</p>
                                        </td>
                                    </tr>
                                </table>
                                @else
                                <h5 class="mt-2">Tidak ada</h5>
                                @endif
                            </div>

                            <div class="col-md-12 mt-4">
                                <h4 class="text-success"><u><b>Riwayat Tinggal</u></b></h4>

                                @if ($pe->living_travels->count() > 0)
                                <table class="mt-2">
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Provinsi</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->living_travels->first()->province }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Kota / Kabupaten</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->living_travels->first()->regency }}</p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Tanggal Mulai</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->living_travels->first()->departure_at->isoFormat('DD MMMM Y') }}</p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Tanggal Selesai</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->domestic_travels->first()->arrive_at->isoFormat('DD MMMM Y') }}</p>
                                        </td>
                                    </tr>
                                </table>
                                @else
                                <h5 class="mt-2">Tidak ada</h5>
                                @endif
                            </div>

                            <div class="col-md-12">
                                @include('components.form-section-end')
                            </div>

                            <div class="col-md-6 mt-4">
                                <h4 class="text-success"><u><b>Kontak Biasa</u></b></h4>

                                @if ($pe->normal_contacts->count() > 0)
                                <table class="mt-2">
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Nama</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->normal_contacts->first()->name }}</p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Jenis Kelamin</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->normal_contacts->first()->jenis_kelamin }}</p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Alamat</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->normal_contacts->first()->address }}</p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>No HP</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->normal_contacts->first()->phone }}</p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Hubungan</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->normal_contacts->first()->status }}</p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Tanggal Mulai</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->normal_contacts->first()->start_at->isoFormat('DD MMMM Y') }}</p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Tanggal Selesai</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->normal_contacts->first()->end_at->isoFormat('DD MMMM Y') }}</p>
                                        </td>
                                    </tr>
                                </table>
                                @else
                                <h5 class="mt-2">Tidak ada</h5>
                                @endif
                            </div>

                            <div class="col-md-6 mt-4">
                                <h4 class="text-success"><u><b>Kontak Erat</u></b></h4>

                                @if ($pe->close_contacts->count() > 0)
                                <table class="mt-2">
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Nama</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->close_contacts->first()->name }}</p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Jenis Kelamin</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->close_contacts->first()->jenis_kelamin }}</p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Alamat</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->close_contacts->first()->address }}</p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>No HP</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->close_contacts->first()->phone }}</p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Hubungan</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->close_contacts->first()->status }}</p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Tanggal Mulai</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->close_contacts->first()->start_at->isoFormat('DD MMMM Y') }}</p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Tanggal Selesai</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->close_contacts->first()->end_at->isoFormat('DD MMMM Y') }}</p>
                                        </td>
                                    </tr>
                                </table>
                                @else
                                <h5 class="mt-2">Tidak ada</h5>
                                @endif
                            </div>

                            <div class="col-md-12">
                                @include('components.form-section-end')
                            </div>

                            <div class="col-md-12">
                                <h4 class="text-success"><u><b>Keterangan Tambahan</u></b></h4>
                                <table class="mt-2">
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Termasuk ISPA Berat</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->additional->ispa ? 'Ya' : 'Tidak' }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Hewan Peliharaan</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->additional->pet == null ? 'Tidak ada' : $pe->additional->pet }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Merupakan Tenaga Kesehatan</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->additional->health_worker ? 'Ya' : 'Tidak' }}</p>
                                        </td>
                                    </tr>
                                    @if ($pe->additional->health_worker)
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Alat Pelindung</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->protectors_list }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pr-md-4 pr-1">
                                            <p class="h5"><b>Melakukan Tindakan Aerosol</b></p>
                                        </td>
                                        <td class="pr-md-3 pr-2">
                                            <p class="h5"> : </p>
                                        </td>
                                        <td>
                                            <p class="h5">{{ $pe->additional->aerosol ? 'Ya' : 'Tidak' }}</p>
                                        </td>
                                    </tr>

                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <tr>
        <td class="pr-md-4 pr-1"><p class="h5"><b>Provinsi</b></p></td>
        <td class="pr-md-3 pr-2"><p class="h5"> : </p></td>
        <td><p class="h5">{{ $pe->living_province }}</p>
</td>
</tr>
<tr>
    <td class="pr-md-4 pr-1">
        <p class="h5"><b>Kota / Kabupaten</b></p>
    </td>
    <td class="pr-md-3 pr-2">
        <p class="h5"> : </p>
    </td>
    <td>
        <p class="h5">{{ $pe->living_regency }}</p>
    </td>
</tr>
<tr>
    <td class="pr-md-4 pr-1">
        <p class="h5"><b>Kecamatan</b></p>
    </td>
    <td class="pr-md-3 pr-2">
        <p class="h5"> : </p>
    </td>
    <td>
        <p class="h5">{{ $pe->living_district }}</p>
    </td>
</tr>
<tr>
    <td class="pr-md-4 pr-1">
        <p class="h5"><b>Desa</b></p>
    </td>
    <td class="pr-md-3 pr-2">
        <p class="h5"> : </p>
    </td>
    <td>
        <p class="h5">{{ $pe->living_village }}</p>
    </td>
</tr>
<tr>
    <td class="pr-md-4 pr-1">
        <p class="h5"><b>Jalan</b></p>
    </td>
    <td class="pr-md-3 pr-2">
        <p class="h5"> : </p>
    </td>
    <td>
        <p class="h5">{{ $pe->living_street }}</p>
    </td>
</tr>
<tr>
    <td class="pr-md-4 pr-1">
        <p class="h5"><b>RT/RW</b></p>
    </td>
    <td class="pr-md-3 pr-2">
        <p class="h5"> : </p>
    </td>
    <td>
        <p class="h5">{{ $pe->living_rt }}/{{ $pe->living_rw }}</p>
    </td>
</tr> --}}
@endsection
