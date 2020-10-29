<p>Apakah pasien sedang dirawat di <b>rumah sakit</b> ?</p>
<div class="form-group">
    <div id="hospital_toggle">
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" name="hospital_toggle" value="yes" class="custom-control-input" id="hospital_toggle_yes">
            <label class="custom-control-label" for="hospital_toggle_yes">Ya</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" name="hospital_toggle" value="no" class="custom-control-input" id="hospital_toggle_no">
            <label class="custom-control-label" for="hospital_toggle_no">Tidak</label>
        </div>
    </div>
</div>

<div class="text-left row" id="hospital_target" style="display: none">
    <div class="form-group col-md-6 col-sm-12 mt-3">
        <label for="hospitaled_at">Tanggal Masuk</label>
        <input type="text" name="hospital_start_at" class="form-control rounded-pill datedropper"
            placeholder="Tanggal terakhir masuk rumah sakit">
    </div>

    <div class="form-group col-md-6 col-sm-12 mt-3">
        <label for="hospital_name">Nama Rumah Sakit</label>
        <input type="text" name="hospital_name" class="form-control rounded-pill"
            placeholder="Nama rumah sakit terakhir">
    </div>

    <div class="col-md-12 mt-3">
        <p class="pb-0 mb-0">Keterangan</p>
    </div>

    <div class="col-md-6 col-sm-12 mt-3">
        <div class="custom-control custom-checkbox custom-control-inline">
            <input type="checkbox" name="hospital_additions[]" class="custom-control-input" value="icu" id="icu">
            <label class="custom-control-label" for="icu">Dirawat di ICU</label>
        </div>
    </div>

    <div class="col-md-6 col-sm-12 mt-3">
        <div class="custom-control custom-checkbox custom-control-inline">
            <input type="checkbox" name="hospital_additions[]" class="custom-control-input" value="intubation" id="intubation">
            <label class="custom-control-label" for="intubation">Tindakan perawatan Intubasi</label>
        </div>
    </div>

    <div class="col-md-12 col-sm-12 mt-3">
        <div class="custom-control custom-checkbox custom-control-inline">
            <input type="checkbox" name="hospital_additions[]" class="custom-control-input" value="emco" id="emco">
            <label class="custom-control-label" for="emco">Tindakan perawatan EMCO</label>
        </div>
    </div>

    <div class="form-group col-md-12 col-sm-12 mt-3">
        <label for="hospital_name_history">Nama-nama rumah sakit sebelumnya</label>
        <input type="text" name="hospital_name_history" class="form-control rounded-pill"
            placeholder="Pisahkan nama nama dengan koma">
    </div>

    <div class="col-md-12 mt-3">
        <div class="form-group">
            <label for="hospital_status" class="d-block">Status Terakhir</label>
            <select name="hospital_status" class="form-control" data-style="bg-white rounded-pill"
                title="Pilih status terakhir pasien" id="hospital_statuses" data-live-search="true">
                <option value="sakit">Masih Sakit</option>
                <option value="sembuh">Sembuh</option>
                <option value="isolasi">Isolasi</option>
                <option value="meninggal">Meninggal</option>
            </select>
        </div>
    </div>
</div>
