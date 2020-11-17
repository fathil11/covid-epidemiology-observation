<div class="row justify-content-center">
    <div class="col-md-6 col-sm-12 mt-3">
        <p>Apakah pasien termasuk cluster <b>ISPA berat</b> (demam dan penumonia
            membutuhkan perawatan Rumah Sakit) yang tidak diketahui penyebabnya ?</p>
        <div class="form-group">
            <div id="ispa">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" name="ispa" value="yes" class="custom-control-input" id="ispa_yes">
                    <label class="custom-control-label" for="ispa_yes">Ya</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" name="ispa" value="no" class="custom-control-input" id="ispa_no">
                    <label class="custom-control-label" for="ispa_no">Tidak</label>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-12 mt-3">
        <p>Apakah pasien memiliki <b>hewan peliharaan</b> ?</p>
        <div class="form-group">
            <div id="pet_toggle">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" name="pet_toggle" value="yes" class="custom-control-input" id="pet_toggle_yes">
                    <label class="custom-control-label" for="pet_toggle_yes">Ya</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" name="pet_toggle" value="no" class="custom-control-input" id="pet_toggle_no">
                    <label class="custom-control-label" for="pet_toggle_no">Tidak</label>
                </div>
            </div>
        </div>

        <div class="mt-3" id="pet_target" style="display: none">
            <div class="form-group text-left">
                <label for="pet">Sebutkan hewan peliharaan</label>
                <input type="text" name="pet" class="form-control rounded-pill"
                    placeholder="Contoh: Anjing, Kucing, ...">
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-12 mt-3">
        <p>Apakah pasien merupakan seorang <b>petugas kesehatan</b> ?</p>
        <div class="form-group">
            <div id="health_worker_toggle">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" name="health_worker_toggle" value="yes" class="custom-control-input"
                        id="health_worker_toggle_yes">
                    <label class="custom-control-label" for="health_worker_toggle_yes">Ya</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" name="health_worker_toggle" value="no" class="custom-control-input"
                        id="health_worker_toggle_no">
                    <label class="custom-control-label" for="health_worker_toggle_no">Tidak</label>
                </div>
            </div>
        </div>

        <div class="mt-3" id="health_worker_target" style="display: none">
            <div class="form-group">
                <p>Pilih <b>alat pelindung</b> yang digunakan :</p>
                <div class="row text-left">
                    <div class="col-md-6 col-sm-12 mt-3">
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" name="protectors[]" class="custom-control-input" value="gown"
                                id="gown">
                            <label class="custom-control-label" for="gown">Gown</label>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12 mt-3">
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" name="protectors[]" class="custom-control-input" value="masker medis"
                                id="masker_medis">
                            <label class="custom-control-label" for="masker_medis">Masker Medis</label>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12 mt-3">
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" name="protectors[]" class="custom-control-input"
                                value="sarung tangan" id="sarung_tangan">
                            <label class="custom-control-label" for="sarung_tangan">Sarung Tangan</label>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12 mt-3">
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" name="protectors[]" class="custom-control-input" value="masker niosh"
                                id="masker_niosh">
                            <label class="custom-control-label" for="masker_niosh">Masker NIOSH N-95</label>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12 mt-3">
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" name="protectors[]" class="custom-control-input" value="ffp3"
                                id="ffp3">
                            <label class="custom-control-label" for="ffp3">FFP3</label>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12 mt-3">
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" name="protectors[]" class="custom-control-input"
                                value="kaca mata google" id="kaca_mata_google">
                            <label class="custom-control-label" for="kaca_mata_google">Kaca Mata Google</label>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 mt-3">
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" name="protectors[]" class="custom-control-input" value="tidak ada"
                                id="tidak_ada">
                            <label class="custom-control-label" for="tidak_ada">Tidak memakai APD</label>
                        </div>
                    </div>

                    <label for="protectors[]" class="mt-2"></label>

                    <div class="col-md-12 mt-3 text-center">
                        <p>Apakah pasien melakukan prosedur yang menimbulkan <b>aerosol</b> ?</p>
                        <div class="form-group">
                            <div id="health_worker_toggle">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="aerosol" value="yes"
                                        class="custom-control-input" id="aerosol_yes">
                                    <label class="custom-control-label" for="aerosol_yes">Ya</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="aerosol" value="no"
                                        class="custom-control-input" id="aerosol_no">
                                    <label class="custom-control-label" for="aerosol_no">Tidak</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
