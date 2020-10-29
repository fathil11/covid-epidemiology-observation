<p>Apakah dalam 14 hari terkahir, pasien pernah melakukan <b>perjalanan domestik</b> ?</p>
<div class="form-group">
    <div id="travel_history_domestic_toggle">
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" name="travel_history_domestic_toggle" value="yes" class="custom-control-input"
                id="travel_history_domestic_toggle_yes">
            <label class="custom-control-label" for="travel_history_domestic_toggle_yes">Ya</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" name="travel_history_domestic_toggle" value="no" class="custom-control-input" id="travel_history_domestic_toggle_no">
            <label class="custom-control-label" for="travel_history_domestic_toggle_no">Tidak</label>
        </div>
    </div>
</div>

<div class="text-left" id="travel_history_domestic_target" style="display: none">
    <div id="travel_history_domestic_container">
        <div class="row travel_history_domestic_section">
            <div class="col-md-12 col-sm-12 mt-3">
                <div class="form-group">
                    <label for="travel_history_domestic_regency" class="d-block">Pilih Kota/Kabupaten</label>
                    <select name="travel_history_domestic_regency" class="form-control"
                        data-style="btn-outline-success rounded-pill" title="Pilih kota/kabupaten" data-live-search="true"
                        id="travel_history_domestic_regencies">
                    </select>
                </div>
            </div>

            <div class="col-md-6 col-sm-12 mt-3">
                <div class="form-group">
                    <label for="travel_history_domestic_departure_at">Tanggal Keberangkatan</label>
                    <input type="text" name="travel_history_domestic_departure_at"
                        class="form-control rounded-pill datedropper" placeholder="Masukan tanggal keberangkatan">
                </div>
            </div>

            <div class="col-md-6 col-sm-12 mt-3">
                <div class="form-group ">
                    <label for="travel_history_domestic_arrive_at">Tanggal Kepulangan</label>
                    <input type="text" name="travel_history_domestic_arrive_at"
                        class="form-control rounded-pill datedropper" placeholder="Masukan tanggal kepulangan">
                </div>
            </div>
        </div>
    </div>

</div>
