<p>Apakah pasien memiliki <b>kondisi penyerta</b> seperti hamil, diabetes, jantung, darah tinggi, gangguan imun, dll ?</p>
<div class="form-group">
    <div id="comorbidities_toggle">
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" name="comorbidities_toggle" value="yes" class="custom-control-input" id="comorbidities_toggle_yes">
            <label class="custom-control-label" for="comorbidities_toggle_yes">Ya</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" name="comorbidities_toggle" value="no" class="custom-control-input" id="comorbidities_toggle_no">
            <label class="custom-control-label" for="comorbidities_toggle_no">Tidak</label>
        </div>
    </div>
</div>

<div class="text-left" id="comorbidities_target" style="display: none">
    <div class="row">

        <div class="col-md-6 col-sm-12 mt-3">
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" name="comorbidities[]" class="custom-control-input" value="hamil" id="hamil">
                <label class="custom-control-label" for="hamil">Hamil</label>
            </div>
        </div>

        <div class="col-md-6 col-sm-12 mt-3">
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" name="comorbidities[]" class="custom-control-input" value="diabetes" id="diabetes">
                <label class="custom-control-label" for="diabetes">Diabetes</label>
            </div>
        </div>

        <div class="col-md-6 col-sm-12 mt-3">
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" name="comorbidities[]" class="custom-control-input" value="penyakit jantung"
                    id="penyakit_jantung">
                <label class="custom-control-label" for="penyakit_jantung">Penyakit Jantung</label>
            </div>
        </div>

        <div class="col-md-6 col-sm-12 mt-3">
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" name="comorbidities[]" class="custom-control-input" value="hipertensi"
                    id="hipertensi">
                <label class="custom-control-label" for="hipertensi">Darah Tinggi</label>
            </div>
        </div>

        <div class="col-md-6 col-sm-12 mt-3">
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" name="comorbidities[]" class="custom-control-input" value="keganasan"
                    id="keganasan">
                <label class="custom-control-label" for="keganasan">Keganasan</label>
            </div>
        </div>

        <div class="col-md-6 col-sm-12 mt-3">
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" name="comorbidities[]" class="custom-control-input" value="gangguan imunologi" id="gangguan_imunologi">
                <label class="custom-control-label" for="gangguan_imunologi">Gangguan Imonologi</label>
            </div>
        </div>

        <div class="col-md-6 col-sm-12 mt-3">
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" name="comorbidities[]" class="custom-control-input" value="gagal ginjal"
                    id="gagal_ginjal">
                <label class="custom-control-label" for="gagal_ginjal">Gagal Ginjal</label>
            </div>
        </div>

        <div class="col-md-6 col-sm-12 mt-3">
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" name="comorbidities[]" class="custom-control-input" value="gagal hati"
                    id="gagal_hati">
                <label class="custom-control-label" for="gagal_hati">Gagal Hati</label>
            </div>
        </div>

        <div class="col-md-6 col-sm-12 mt-3">
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" name="comorbidities[]" class="custom-control-input" value="ppok" id="ppok">
                <label class="custom-control-label" for="ppok">PPOK</label>
            </div>
        </div>

        <div class="col-md-6 col-sm-12 mt-3">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" name="comorbidities[]" class="custom-control-input ignore" value="else" id="comorbidities_else_toggle">
                <label class="custom-control-label" for="comorbidities_else_toggle">Lainnya</label>
            </div>
        </div>

        <div class="col-md-12 col-sm-12 mt-2" id="comorbidities_else_target" style="display: none">
            <div class="form-group">
                <input type="text" name="comorbidities_else" class="form-control rounded-pill" placeholder="Masukan gejala lainnya">
            </div>
        </div>

        <label for="comorbidities[]" class="mt-2"></label>
    </div>
</div>
