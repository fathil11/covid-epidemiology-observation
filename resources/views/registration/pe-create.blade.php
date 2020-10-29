@extends('layouts.registration')
@section('title', 'Pendaftaran')
@section('content')
<div class="container">
    <h1 class="text-primary text-center mt-5">Pendaftaran PE Lanjutan <br class="d-block d-md-none">E-SWAB</h1>
    <h5 class="text-primary text-center">Powered by Melawi Software Dev</h5>

    <form action="{{ route('registration.pe.store', ['nik'=>$person->nik]) }}" method="POST"
        autocomplete="off" id="pe_create">

        @csrf
        @method('POST')

        <div class="container">
            <div class="row mt-5">

                <div class="col-md-6 col-sm-12 mt-3">
                    <div class="form-group">
                        <label for="nik">NIK/Nomor identitas</label>
                        <input type="text" class="form-control rounded-pill" value="{{ $person->nik }}" disabled>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 mt-3">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control rounded-pill" value="{{ $person->name }}" disabled>
                    </div>
                </div>

                @include('components.form-section-end')
                @include('components.form-header', ['title' => 'Alamat Tinggal'])

                <div class="col-md-6 col-sm-12 mt-3">
                    <div class="form-group">
                        <label for="living_province">Provinsi</label>
                        <select name="living_province" title="Pilih Provinsi" id="living_provinces" class="form-control"
                            data-live-search="true" data-style="bg-white rounded-pill">
                        </select>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 mt-3">
                    <div class="form-group">
                        <label for="living_regency">Kota/Kabupaten</label>
                        <select name="living_regency" title="Pilih Kota/Kabupaten" id="living_regencies"
                            class="form-control" data-live-search="true" data-style="bg-white rounded-pill">
                        </select>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 mt-3">
                    <div class="form-group">
                        <label for="living_district">Kecamatan</label>
                        <select name="living_district" title="Pilih Kecamatan" id="living_districts" class="form-control"
                            data-live-search="true" data-style="bg-white rounded-pill">
                        </select>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 mt-3">
                    <div class="form-group">
                        <label for="living_village">Desa/Dusun</label>
                        <select name="living_village" title="Pilih Desa/Dusun" id="living_villages" class="form-control"
                            data-live-search="true" data-style="bg-white rounded-pill">
                        </select>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 mt-3">
                    <div class="form-group">
                        <label for="living_street">Jalan</label>
                        <input type="text" name="living_street" class="form-control rounded-pill"
                            placeholder="Masukan nama jalan">
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 mt-3">
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="living_rt">RT</label>
                            <input type="text" name="living_rt" class="form-control rounded-pill" placeholder="Nomor RT">

                        </div>

                        <div class="form-group col">
                            <label for="living_rw">RW</label>
                            <input type="text" name="living_rw" class="form-control rounded-pill" placeholder="Nomor RW">

                        </div>
                    </div>
                </div>

                @include('components.form-section-end')
                @include('components.form-header', ['title' => 'Informasi Klinis'])

                <div class="col-md-6 col-sm-12 text-center mt-3">
                    @include('components.form-sub-header', ['title' => 'Gejala'])
                    @include('sections.registration.pe.symptoms')
                </div>

                <div class="col-md-6 col-sm-12 text-center mt-3">
                    @include('components.form-sub-header', ['title' => 'Kondisi Penyerta'])
                    @include('sections.registration.pe.comorbidities')
                </div>

                <div class="col-md-6 col-sm-12 text-center mt-3">
                    @include('components.form-sub-header', ['title' => 'Diagnosis Pasien'])
                    @include('sections.registration.pe.diagnoses')
                </div>

                <div class="col-md-6 text-center mt-3">
                    @include('components.form-sub-header', ['title' => 'Riwayat Rumah Sakit'])
                    @include('sections.registration.pe.hospital')
                </div>

                @include('components.form-section-end')
                @include('components.form-header', ['title' => 'Riwayat Perjalanan'])

                <div class="col-md-6 col-sm-12 text-center mt-3">
                    @include('components.form-sub-header', ['title' => 'Perjalanan Luar Negeri'])
                    @include('sections.registration.pe.travel-history-international')
                </div>

                <div class="col-md-6 col-sm-12 text-center mt-3">
                    @include('components.form-sub-header', ['title' => 'Perjalanan Dalam Negeri'])
                    @include('sections.registration.pe.travel-history-domestic')
                </div>

                <div class="col-md-12 col-sm-12 text-center mt-3">
                    @include('components.form-sub-header', ['title' => 'Riwayat Tinggal'])
                    @include('sections.registration.pe.travel-history-living')
                </div>

                @include('components.form-section-end')
                @include('components.form-header', ['title' => 'Riwayat Kontak'])

                <div class="col-md-12 col-sm-12 text-center mt-3">
                    @include('components.form-sub-header', ['title' => 'Kontak'])
                    @include('sections.registration.pe.contact-history-normal')
                </div>

                <div class="col-md-12 col-sm-12 text-center mt-3">
                    @include('components.form-sub-header', ['title' => 'Kontak Erat'])
                    @include('sections.registration.pe.contact-history-close')
                </div>

                @include('components.form-section-end')
                @include('components.form-header', ['title' => 'Informasi Tambahan'])

                <div class="col-md-12 col-sm-12 text-center mt-3">
                    @include('sections.registration.pe.additional')
                </div>

                @include('components.form-section-end')
                @include('components.form-header', ['title' => 'Tabung & Kelompok'])

                <div class="col-md-6 col-sm-12 mt-3">
                    <div class="form-group">
                        <label for="tube_code">Nomor Tabung</label>
                        <input type="text" name="tube_code" placeholder="Masukan nomor tabung" class="form-control rounded-pill">
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 mt-3">
                    <div class="form-group">
                        <label for="group_code">Kode Kelompok</label>
                        <input type="text" name="group_code" placeholder="Wajib diisi jika pasien termasuk tes masal" class="form-control rounded-pill">
                    </div>
                </div>

                <div class="col-md-12 mt-3 mb-5">
                    <button class="btn btn-primary rounded-pill btn-block">Daftarkan</button>
                </div>


            </div>
        </div>
    </form>
</div>
@endsection
