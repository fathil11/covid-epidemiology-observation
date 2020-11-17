<p>Apakah pasien memiliki <b>gejala</b> seperti batuk, pilek, sakit kepala, dll ?</p>
<div class="form-group">
    <div id="symptoms_toggle">
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" name="symptoms_toggle" value="yes" class="custom-control-input"
                id="symptoms_toggle_yes">
            <label class="custom-control-label" for="symptoms_toggle_yes">Ya</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" name="symptoms_toggle" value="no" class="custom-control-input" id="symptoms_toggle_no">
            <label class="custom-control-label" for="symptoms_toggle_no">Tidak</label>
        </div>
    </div>
</div>

<div class="text-left" id="symptoms_target" style="display: none">
    <div class="row">
        <div class="col-md-12 mt-3">
            <div class="form-group">
                <label for="symptoms_at">Tanggal munculnya gejala</label>
                <input type="text" name="symptoms_at" class="form-control rounded-pill datedropper"
                    placeholder="Masukan tanggal munculnya gejala">
            </div>
        </div>

        <div class="col-md-12 col-sm-12 mt-3">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" name="symptoms[]" class="custom-control-input" value="demam" id="demam_toggle">
                <label class="custom-control-label" for="demam_toggle">Demam</label>
            </div>
        </div>

        <div class="col-md-12 col-sm-12 mt-2" style="display: none" id="demam_target">
            <div class="form-group">
                <input type="text" name="fever_temperature" class="form-control rounded-pill"
                    placeholder="Masukan suhu tubuh">
            </div>
        </div>

        <div class="col-md-6 col-sm-12 mt-3">
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" name="symptoms[]" class="custom-control-input" value="batuk" id="batuk">
                <label class="custom-control-label" for="batuk">Batuk</label>
            </div>
        </div>

        <div class="col-md-6 col-sm-12 mt-3">
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" name="symptoms[]" class="custom-control-input" value="pilek" id="pilek">
                <label class="custom-control-label" for="pilek">Pilek</label>
            </div>
        </div>

        <div class="col-md-6 col-sm-12 mt-3">
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" name="symptoms[]" class="custom-control-input" value="sakit tenggorakan"
                    id="sakit_tenggorakan">
                <label class="custom-control-label" for="sakit_tenggorakan">Sakit Tenggorokan</label>
            </div>
        </div>

        <div class="col-md-6 col-sm-12 mt-3">
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" name="symptoms[]" class="custom-control-input" value="sesak napas"
                    id="sesak_napas">
                <label class="custom-control-label" for="sesak_napas">Sesak Napas</label>
            </div>
        </div>

        <div class="col-md-6 col-sm-12 mt-3">
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" name="symptoms[]" class="custom-control-input" value="sakit kepala"
                    id="sakit_kepala">
                <label class="custom-control-label" for="sakit_kepala">Sakit Kepala</label>
            </div>
        </div>

        <div class="col-md-6 col-sm-12 mt-3">
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" name="symptoms[]" class="custom-control-input" value="lemah" id="lemah">
                <label class="custom-control-label" for="lemah">Lemah (Malaise)</label>
            </div>
        </div>

        <div class="col-md-6 col-sm-12 mt-3">
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" name="symptoms[]" class="custom-control-input" value="nyeri otot"
                    id="nyeri_otot">
                <label class="custom-control-label" for="nyeri_otot">Nyeri Otot</label>
            </div>
        </div>

        <div class="col-md-6 col-sm-12 mt-3">
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" name="symptoms[]" class="custom-control-input" value="mual muntah"
                    id="mual_muntah">
                <label class="custom-control-label" for="mual_muntah">Mual/Muntah</label>
            </div>
        </div>

        <div class="col-md-6 col-sm-12 mt-3">
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" name="symptoms[]" class="custom-control-input" value="nyeri" id="nyeri">
                <label class="custom-control-label" for="nyeri">Nyeri Abdomen</label>
            </div>
        </div>

        <div class="col-md-6 col-sm-12 mt-3">
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" name="symptoms[]" class="custom-control-input" value="diare" id="diare">
                <label class="custom-control-label" for="diare">Diare</label>
            </div>
        </div>

        <div class="col-md-12 col-sm-12 mt-3">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" name="symptoms[]" class="custom-control-input" value="else" id="symptoms_else_toggle">
                <label class="custom-control-label" for="symptoms_else_toggle">Lainnya</label>
            </div>
        </div>

        <div class="col-md-12 col-sm-12 mt-2" id="symptoms_else_target" style="display: none">
            <div class="form-group">
                <input type="text" name="symptoms_else" class="form-control rounded-pill"
                    placeholder="Masukan gejala lainnya">
            </div>
        </div>

        <label for="symptoms[]" class="mt-2"></label>
    </div>
</div>
