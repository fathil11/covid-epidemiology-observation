@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="text-primary text-center mt-5">Tambah PE Manual <br class="d-block d-md-none">E-SWAB</h1>
    <h5 class="text-primary text-center">Powered by Melawi Software Dev</h5>

    <form action="{{ route('admin.pe.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off" id="admin_pe_create">

    @csrf
    @method('POST')

    <div class="container">
        <div class="row mt-5">

                <div class="col-md-6 col-sm-12 mt-3">
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" name="nik" class="form-control rounded-pill" placeholder="Masukan NIK pasien">
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 mt-3">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" id="name" class="form-control rounded-pill" placeholder="Masukan nama lengkap">
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 mt-3">
                    <div class="form-group">
                        <label for="nik">Nomor HP (WhatsApp)</label>
                        <input type="text" name="phone" class="form-control rounded-pill" placeholder="Masukan nomor hp WA pasien">
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 mt-3">
                    <div class="form-group">
                        <label for="gender" class="d-block mb-3">Jenis Kelamin</label>
                        <div id="gender">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="gender" class="custom-control-input" id="male">
                                <label class="custom-control-label" for="male">Laki-laki</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="gender" class="custom-control-input" id="female">
                                <label class="custom-control-label" for="female">Perempuan</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mt-3">
                    <label for="id_card_file" class="d-block">Foto KTP/Identitas lain</label>
                    <div class="custom-file rounded-pill">
                        <input name="id_card_file" type="file" class="custom-file-input" id="id_card_file" accept="image/*">
                        <label class="custom-file-label rounded-pill" for="id_card_file" data-browse="Ambil File">Masukan foto KTP/Identitas lain</label>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 mt-3">
                    <img src="" id="card_view" class="img-fluid" alt="">
                </div>

                @include('components.form-section-end')
                @include('components.form-header', ['title' => 'Tempat Tanggal Lahir'])

                <div class="col-md-6 mt-3">
                    <div class="form-group">
                        <label for="birth_regency">Tempat Lahir (Kota / Kabupaten)</label>
                        <input type="text" name="birth_regency" class="form-control rounded-pill" placeholder="Masukan tempat lahir">
                    </div>
                </div>

                <div class="col-md-6 mt-3">
                    <div class="form-group">
                        <label for="birth_at">Tanggal Lahir</label>
                        <input type="text" name="birth_at" class="form-control rounded-pill datedropper"
                            placeholder="Masukan tanggal lahir pasien">
                    </div>
                </div>

                @include('components.form-section-end')

                <div class="col-md-12 mt-3">
                    <div class="form-group">
                        <label for="parent_name">Nama Orang Tua</label>
                        <input type="text" name="parent_name" class="form-control rounded-pill"
                            placeholder="Masukan nama lengkap ibu kandung">
                    </div>
                </div>

                @include('components.form-section-end')
                @include('components.form-header', ['title' => 'Informasi Pekerjaan'])

                <div class="col-md-6 mt-3">
                    <div class="form-group">
                        <label for="work" class="d-block">Pekerjaan</label>
                        <select name="work" class="form-control" data-style="bg-white rounded-pill"
                            title="Pilih jenis pekerjaan pasien" id="works" data-live-search="true">
                        </select>
                    </div>
                </div>

                <div class="col-md-6 mt-3">
                    <div class="form-group">
                        <label for="work_instance">Instansi Kerja</label>
                        <input type="text" name="work_instance" class="form-control rounded-pill"
                            placeholder="Masukan instansi kerja pasien">
                    </div>
                </div>

                @include('components.form-section-end')
                @include('components.form-header', ['title' => 'Alamat KTP'])

                <div class="col-md-6 col-sm-12 mt-3">
                    <div class="form-group">
                        <label for="card_province">Provinsi</label>
                        <select name="card_province" title="Pilih Provinsi" id="card_provinces" class="form-control"
                            data-live-search="true" data-style="bg-white rounded-pill">
                        </select>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 mt-3">
                    <div class="form-group">
                        <label for="card_regency">Kota/Kabupaten</label>
                        <select name="card_regency" title="Pilih Kota/Kabupaten" id="card_regencies" class="form-control"
                            data-live-search="true" data-style="bg-white rounded-pill">
                        </select>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 mt-3">
                    <div class="form-group">
                        <label for="card_district">Kecamatan</label>
                        <select name="card_district" title="Pilih Kecamatan" id="card_districts" class="form-control"
                            data-live-search="true" data-style="bg-white rounded-pill">
                        </select>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 mt-3">
                    <div class="form-group">
                        <label for="card_village">Desa/Dusun</label>
                        <select name="card_village" title="Pilih Desa/Dusun" id="card_villages" class="form-control"
                            data-live-search="true" data-style="bg-white rounded-pill">
                        </select>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 mt-3">
                    <div class="form-group">
                        <label for="card_street">Alamat</label>
                        <input type="text" name="card_street" class="form-control rounded-pill"
                            placeholder="Masukan alamat Dusun/Jalan/Gang">
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 mt-3">
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="card_rt">RT</label>
                            <input type="text" name="card_rt" class="form-control rounded-pill" placeholder="Nomor RT">
                        </div>

                        <div class="form-group col">
                            <label for="card_rw">RW</label>
                            <input type="text" name="card_rw" class="form-control rounded-pill" placeholder="Nomor RW">

                        </div>
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
                        <select name="living_regency" title="Pilih Kota/Kabupaten" id="living_regencies" class="form-control"
                            data-live-search="true" data-style="bg-white rounded-pill">
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
                        <label for="living_street">Alamat</label>
                        <input type="text" name="living_street" class="form-control rounded-pill"
                            placeholder="Masukan alamat Dusun/Jalan/Gang">
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 mt-3">
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="living_rt">RT</label>
                            <input type="text" name="living_rt" class="form-control rounded-pill"  placeholder="Nomor RT">
                        </div>

                        <div class="form-group col">
                            <label for="living_rw">RW</label>
                            <input type="text" name="living_rw" class="form-control rounded-pill"  placeholder="Nomor RW">

                        </div>
                    </div>
                </div>

                @include('components.form-section-end')
                @include('components.form-header', ['title' => 'Informasi SWAB'])

                <div class="col-md-6 mt-3">
                    <div class="form-group">
                        <label for="swab_priority">Prioritas SWAB</label>
                        <select name="swab_priority" class="form-control selectpicker" data-style="bg-white rounded-pill"
                            title="Pilih prioritas SWAB" id="swab_priorities" data-live-search="true">
                        </select>
                    </div>
                </div>

                <div class="col-md-6 mt-3">
                    <div class="form-group">
                        <label for="swab_type">Jenis SWAB</label>
                        <select name="swab_type" class="form-control selectpicker" data-style="bg-white rounded-pill"
                            title="Pilih jenis SWAB" id="swab_types" data-live-search="true">
                        </select>
                    </div>
                </div>

                <div class="col-md-6 mt-3">
                    <div class="form-group">
                        <label for="swab_location">Lokasi Lab SWAB</label>
                        <select name="swab_location" class="form-control selectpicker" data-style="bg-white rounded-pill"
                            title="Pilih loaksi lab SWAB" id="swab_locations" data-live-search="true">
                        </select>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 mt-3">
                    <div class="form-group">
                        <label for="note">Catatan</label>
                        <textarea type="text" name="note" class="form-control rounded-pill"
                            placeholder="Masukan catatan (dapat dikosongkan)"></textarea>
                    </div>
                </div>

                <div class="col-md-6 mt-3">
                    <div class="form-group">
                        <label for="test_at">Tanggal Tes</label>
                        <input type="text" name="test_at" class="form-control rounded-pill datedropper"
                            placeholder="Masukan tanggal tes pasien">
                    </div>
                </div>

                <div class="col-md-6 mt-3">
                    <div class="form-group">
                        <label for="result_at">Tanggal Hasil</label>
                        <input type="text" name="result_at" class="form-control rounded-pill datedropper"
                            placeholder="Masukan tanggal hasil pasien">
                    </div>
                </div>

                <div class="col-md-12 mt-3">
                    <div class="form-group">
                        <label for="swab_result">Hasil</label>
                        <select name="swab_result" class="form-control selectpicker" data-style="bg-white rounded-pill"
                            title="Pilih hasil SWAB pasien" id="swab_result" data-live-search="true">
                        </select>
                    </div>
                </div>


                <div class="col-md-12 mt-3 mb-5">
                    <button class="btn btn-primary rounded-pill btn-block">Edit</button>
                </div>

            </div>
        </div>
    </form>
</div>
@push('scripts')
<script>
    var reader = new FileReader();
    reader.onload = function (e) {
        $('#card_view').attr('src', e.target.result);
    }

   function readURL(input) {
        if (input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#id_card_file").change(function(){
        console.log('tes');
        readURL(this);
    });
</script>
@endpush
@endsection
