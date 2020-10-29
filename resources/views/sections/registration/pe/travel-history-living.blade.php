<p>Apakah dalam 14 hari terkahir, pasien memiliki <b>riwayat tinggal</b> di area transmisi lokal ?</p>
<div class="form-group">
    <div id="travel_history_living_toggle">
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" name="travel_history_living_toggle" value="yes" class="custom-control-input"
                id="travel_history_living_toggle_yes">
            <label class="custom-control-label" for="travel_history_living_toggle_yes">Ya</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" name="travel_history_living_toggle" value="no" class="custom-control-input" id="travel_history_living_toggle_no">
            <label class="custom-control-label" for="travel_history_living_toggle_no">Tidak</label>
        </div>
    </div>
</div>

<div class="text-left" id="travel_history_living_target" style="display: none">
    <div id="travel_history_living_container">
        <div class="row travel_history_living_section">
            <div class="col-md-12 col-sm-12 mt-3">
                <div class="form-group">
                    <label for="travel_history_living_regency" class="d-block">Pilih Kota/Kabupaten</label>
                    <select name="travel_history_living_regency" class="form-control"
                        data-style="btn-outline-success rounded-pill" title="Pilih kota/kabupaten" data-live-search="true"
                        id="travel_history_living_regencies">
                    </select>
                </div>
            </div>

            <div class="col-md-6 col-sm-12 mt-3">
                <div class="form-group">
                    <label for="travel_history_living_departure_at">Tanggal Mulai Tinggal</label>
                    <input type="text" name="travel_history_living_departure_at"
                        class="form-control rounded-pill datedropper" placeholder="Masukan tanggal keberangkatan">
                </div>
            </div>

            <div class="col-md-6 col-sm-12 mt-3">
                <div class="form-group ">
                    <label for="travel_history_living_arrive_at">Tanggal Selesai Tinggal</label>
                    <input type="text" name="travel_history_living_arrive_at"
                        class="form-control rounded-pill datedropper" placeholder="Masukan tanggal kepulangan">
                </div>
            </div>
        </div>
    </div>

</div>
