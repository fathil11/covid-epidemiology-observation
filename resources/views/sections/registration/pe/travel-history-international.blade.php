<p>Apakah dalam 14 hari terkahir, pasien pernah melakukan <b>perjalanan luar negeri</b> ?</p>
<div class="form-group">
    <div id="travel_history_international_toggle">
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" name="travel_history_international_toggle" value="yes" class="custom-control-input"
                id="travel_history_international_toggle_yes">
            <label class="custom-control-label" for="travel_history_international_toggle_yes">Ya</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" name="travel_history_international_toggle" value="no" class="custom-control-input" id="travel_history_international_toggle_no">
            <label class="custom-control-label" for="travel_history_international_toggle_no">Tidak</label>
        </div>
    </div>
</div>

<div class="text-left" id="travel_history_international_target" style="display: none">
    <div id="travel_history_international_container">
        <div class="row travel_history_international_section">
            <div class="col-md-6 col-sm-12 mt-3">
                <div class="form-group">
                    <label for="travel_history_international_country" class="d-block">Pilih Negara</label>
                    <select name="travel_history_international_country" class="form-control"
                        data-style="btn-outline-success rounded-pill ignore" title="Pilih negara" data-live-search="true"
                        id="travel_history_international_countries">
                    </select>
                </div>
            </div>

            <div class="col-md-6 col-sm-12 mt-3">
                <div class="form-group">
                    <label for="travel_history_international_regency">Kota</label>
                    <input type="text" name="travel_history_international_regency" class="form-control rounded-pill" placeholder="Masukan kota">
                </div>
            </div>

            <div class="col-md-6 col-sm-12 mt-3">
                <div class="form-group">
                    <label for="travel_history_international_departure_at">Tanggal Keberangkatan</label>
                    <input type="text" name="travel_history_international_departure_at"
                        class="form-control rounded-pill datedropper" placeholder="Masukan tanggal keberangkatan">
                </div>
            </div>

            <div class="col-md-6 col-sm-12 mt-3">
                <div class="form-group ">
                    <label for="travel_history_international_arrive_at">Tanggal Kepulangan</label>
                    <input type="text" name="travel_history_international_arrive_at"
                        class="form-control rounded-pill datedropper" placeholder="Masukan tanggal kepulangan">
                </div>
            </div>
        </div>
    </div>

</div>
