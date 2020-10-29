<p>Apakah terdapat <b>diagnosa</b> seperti penumonia, ARDS, atau lainnya ?</p>
<div class="form-group">
    <div id="diagnoses_toggle">
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" name="diagnoses_toggle" value="yes" class="custom-control-input" id="diagnoses_toggle_yes">
            <label class="custom-control-label" for="diagnoses_toggle_yes">Ya</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" name="diagnoses_toggle" value="no" class="custom-control-input" id="diagnoses_toggle_no">
            <label class="custom-control-label" for="diagnoses_toggle_no">Tidak</label>
        </div>
    </div>
</div>

<div class="text-left" id="diagnoses_target" style="display: none">
    <div class="row">
        <div class="col-md-6 col-sm-12 mt-3">
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" name="diagnoses[]" class="custom-control-input" value="pneumonia" id="pneumonia">
                <label class="custom-control-label" for="pneumonia">Penumonia (Klinis atau Radiologi)</label>
            </div>
        </div>

        <div class="col-md-6 col-sm-12 mt-3">
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" name="diagnoses[]" class="custom-control-input" value="ards" id="ards">
                <label class="custom-control-label" for="ards">ARDS (Acute Respiratory Distress Syndrome)</label>
            </div>
        </div>


        <div class="col-md-12 col-sm-12 mt-3">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" name="diagnoses[]" class="custom-control-input" value="else" id="diagnoses_else_toggle">
                <label class="custom-control-label" for="diagnoses_else_toggle">Lainnya</label>
            </div>
        </div>

        <div class="col-md-12 col-sm-12 mt-2" id="diagnoses_else_target" style="display: none">
            <div class="form-group">
                <input type="text" name="diagnoses_else" class="form-control rounded-pill" placeholder="Masukan diagnosa lainnya">
            </div>
        </div>

        <label for="diagnoses[]" class="mt-2"></label>
    </div>
</div>
