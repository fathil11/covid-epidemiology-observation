@extends('layouts.registration')
@section('content')
<div class="container">
    <h1 class="text-primary text-center mt-5">Ubah Identitas Pasien <br class="d-block d-md-none">E-SWAB</h1>
    <h5 class="text-primary text-center">Powered by Melawi Software Dev</h5>

    <form action="{{ route('registration.person.update', ['id' => $person->id]) }}" method="POST" enctype="multipart/form-data" autocomplete="off" id="person_update">

    @csrf
    @method('POST')

    <div class="container">
        <div class="row mt-5">

                <div class="col-md-6 col-sm-12 mt-3">
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" name="nik" class="form-control rounded-pill" placeholder="Masukan NIK pasien" value="{{ $person->nik }}">
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 mt-3">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" id="name" class="form-control rounded-pill" placeholder="Masukan nama lengkap" value="{{ $person->name }}">
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 mt-3">
                    <div class="form-group">
                        <label for="nik">Nomor HP (WhatsApp)</label>
                        <input type="text" name="phone" class="form-control rounded-pill" placeholder="Masukan nomor hp WA pasien" value="{{ $person->phone }}">
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 mt-3">
                    <div class="form-group">
                        <label for="gender" class="d-block mb-3">Jenis Kelamin</label>
                        <div id="gender">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="gender" class="custom-control-input" id="male" value="m" {{ $person->gender == 'm' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="male">Laki-laki</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="gender" class="custom-control-input" id="female" value="f" {{ $person->gender == 'f' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="female">Perempuan</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mt-3">
                    <label for="id_card_file" class="d-block">Foto KTP/Identitas lain</label>
                    <div class="custom-file rounded-pill">
                        <input name="id_card_file" type="file" class="custom-file-input" id="id_card_file" accept="image/*" value="{{ $person->id_card_file }}">
                        <label class="custom-file-label rounded-pill" for="id_card_file" data-browse="Ambil File">Masukan foto KTP/Identitas lain</label>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 mt-3">
                @if ($person->card_path != null)
                    <img src="{{ asset('storage/id_cards/' . $person->card_path) }}" class="img-fluid" alt="">
                @else
                    <h4>Foto KTP belum ada</h4>
                @endif
                </div>

                @include('components.form-section-end')
                @include('components.form-header', ['title' => 'Tempat Tanggal Lahir'])

                <div class="col-md-6 mt-3">
                    <div class="form-group">
                        <label for="birth_regency">Tempat Lahir (Kota / Kabupaten)</label>
                        <input type="text" name="birth_regency" class="form-control rounded-pill" placeholder="Masukan tempat lahir" value="{{ $person->birth_regency }}">
                    </div>
                </div>

                <div class="col-md-6 mt-3">
                    <div class="form-group">
                        <label for="birth_at">Tanggal Lahir</label>
                        <input type="text" name="birth_at" class="form-control rounded-pill datedropper"
                            placeholder="Masukan tanggal lahir pasien" value="{{ $person->birth_at != null ? $person->birth_at->format('m/d/Y') : '' }}">
                    </div>
                </div>

                @include('components.form-section-end')

                <div class="col-md-12 mt-3">
                    <div class="form-group">
                        <label for="parent_name">Nama Orang Tua</label>
                        <input type="text" name="parent_name" class="form-control rounded-pill"
                            placeholder="Masukan nama lengkap ibu kandung" value="{{ $person->parent_name }}">
                    </div>
                </div>

                @include('components.form-section-end')
                @include('components.form-header', ['title' => 'Informasi Pekerjaan'])

                <div class="col-md-6 mt-3">
                    <div class="form-group">
                        <label for="work" class="d-block">Pekerjaan</label>
                        <select name="work" class="form-control" data-style="bg-white rounded-pill"
                            title="Pilih jenis pekerjaan pasien" id="works" data-live-search="true">
                            <option value="{{ $person->work }}" selected>{{ Str::title($person->work) }}</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6 mt-3">
                    <div class="form-group">
                        <label for="work_instance">Instansi Kerja</label>
                        <input type="text" name="work_instance" class="form-control rounded-pill"
                            placeholder="Masukan instansi kerja pasien" value="{{ $person->work_instance }}">
                    </div>
                </div>

                @include('components.form-section-end')
                @include('components.form-header', ['title' => 'Alamat KTP'])

                <div class="col-md-6 col-sm-12 mt-3">
                    <div class="form-group">
                        <label for="card_province">Provinsi</label>
                        <select name="card_province" title="Pilih Provinsi" id="card_provinces" class="form-control"
                            data-live-search="true" data-style="bg-white rounded-pill">
                            <option value="{{ $person->card_province }}" selected>{{ Str::title($person->card_province) }}</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 mt-3">
                    <div class="form-group">
                        <label for="card_regency">Kota/Kabupaten</label>
                        <select name="card_regency" title="Pilih Kota/Kabupaten" id="card_regencies" class="form-control"
                            data-live-search="true" data-style="bg-white rounded-pill">
                            <option value="{{ $person->card_regency }}" selected>{{ Str::title($person->card_regency) }}</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 mt-3">
                    <div class="form-group">
                        <label for="card_district">Kecamatan</label>
                        <select name="card_district" title="Pilih Kecamatan" id="card_districts" class="form-control"
                            data-live-search="true" data-style="bg-white rounded-pill">
                            <option value="{{ $person->card_district }}" selected>{{ Str::title($person->card_district) }}</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 mt-3">
                    <div class="form-group">
                        <label for="card_village">Desa/Dusun</label>
                        <select name="card_village" title="Pilih Desa/Dusun" id="card_villages" class="form-control"
                            data-live-search="true" data-style="bg-white rounded-pill">
                            <option value="{{ $person->card_village }}" selected>{{ Str::title($person->card_village) }}</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 mt-3">
                    <div class="form-group">
                        <label for="card_street">Alamat</label>
                        <input type="text" name="card_street" class="form-control rounded-pill"
                            placeholder="Masukan alamat Dusun/Jalan/Gang" value="{{ Str::title($person->card_street) }}">
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

                <div class="col-md-12 mt-3 mb-5">
                    <button class="btn btn-primary rounded-pill btn-block">Lanjut</button>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection
