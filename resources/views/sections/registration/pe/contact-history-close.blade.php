<p>Apakah dalam 14 hari terkahir, pasien memiliki <b>riwayat kontak erat</b> dengan orang yang ber-status
    <b>konfirmasi</b> dan <b>probabel</b> ?</p>
<div class="form-group">
    <div id="contact_history_close_toggle">
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" name="contact_history_close_toggle" value="yes" class="custom-control-input"
                id="contact_history_close_toggle_yes">
            <label class="custom-control-label" for="contact_history_close_toggle_yes">Ya</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" name="contact_history_close_toggle" value="no" class="custom-control-input"
                id="contact_history_close_toggle_no">
            <label class="custom-control-label" for="contact_history_close_toggle_no">Tidak</label>
        </div>
    </div>
</div>

<div class="text-left" id="contact_history_close_target" style="display: none">
    <div class="row">
        <div class="col-md-3 col-sm-12 mt-3">
            <div class="form-group">
                <label for="contact_history_close_name">Nama</label>
                <input type="text" name="contact_history_close_name" class="form-control rounded-pill"
                    placeholder="Masukan nama">
                </input>
            </div>
        </div>

        <div class="col-md-3 col-sm-12 mt-3">
            <div class="form-group">
                <label for="contact_history_close_address">Alamat</label>
                <input type="text" name="contact_history_close_address" class="form-control rounded-pill"
                    placeholder="Kota/Kecamatan/Desa/Jalan">
                </input>
            </div>
        </div>

        <div class="col-md-3 col-sm-12 mt-3">
            <div class="form-group">
                <label for="contact_history_close_phone">No HP</label>
                <input type="text" name="contact_history_close_phone" class="form-control rounded-pill"
                    placeholder="Masukan nomor HP">
                </input>
            </div>
        </div>

        <div class="col-md-3 col-sm-12 mt-3">
            <div class="form-group">
                <label for="contact_history_close_gender" class="d-block">Jenis Kelamin</label>
                <div id="contact_history_close_gender">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" name="contact_history_close_gender" class="custom-control-input"
                            id="contact_history_close_gender_male" value="m">
                        <label class="custom-control-label" for="contact_history_close_gender_male">Laki-laki</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" name="contact_history_close_gender" class="custom-control-input"
                            id="contact_history_close_gender_female" value="f">
                        <label class="custom-control-label" for="contact_history_close_gender_female">Perempuan</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-12 mt-3">
            <div class="form-group">
                <label for="contact_history_close_status" class="d-block">Hubungan</label>
                <select name="contact_history_close_status" class="form-control"
                    data-style="bg-white rounded-pill" title="Pilih jenis hubungan"
                    id="contact_history_close_statuses">
                    <option value="suami/istri">Suami/Istri</option>
                    <option value="anak">Anak</option>
                    <option value="orang tua">Orang Tua</option>
                    <option value="saudara">Saudara</option>
                    <option value="teman">Teman</option>
                    <option value="rekan kerja">Rekan Kerja</option>
                </select>
            </div>
        </div>

        <div class="col-md-4 col-sm-12 mt-3">
            <div class="form-group">
                <label for="contact_history_close_start_at">Tanggal Mulai Kontak</label>
                <input type="text" name="contact_history_close_start_at"
                    class="form-control rounded-pill datedropper" placeholder="Tanggal mulai kontak">
            </div>
        </div>

        <div class="col-md-4 col-sm-12 mt-3">
            <div class="form-group ">
                <label for="contact_history_close_end_at">Tanggal Terakhir Kontak</label>
                <input type="text" name="contact_history_close_end_at"
                class="form-control rounded-pill datedropper" placeholder="Tanggal akhir kontak">
            </div>
        </div>
    </div>
</div>
