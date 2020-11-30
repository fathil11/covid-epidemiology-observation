import validate from 'jquery-validation';
import {
    method
} from 'lodash';
import {
    plural
} from 'pluralize';
import Swal from 'sweetalert2';

require('./jquery-validation-extension/accept');
require('./jquery-validation-extension/letterswithbasicpunc');
var file_required;

function createPersonValidationInit() {
    $('#person_create').validate({
        debug: false,
        rules: {
            nik: {
                required: true,
                digits: true,
                minlength: 16,
                maxlength: 16
            },
            name: {
                required: true,
                letterswithbasicpunc: true,
                minlength: 3,
                maxlength: 70
            },
            phone: {
                required: true,
                digits: true,
                minlength: 9,
                maxlength: 13
            },
            gender: {
                required: true
            },
            id_card_file: {
                required: true,
                accept: "image/*"
            },
            birth_regency: {
                required: true
            },
            birth_at: {
                required: true,
            },
            parent_name: {
                required: false,
                letterswithbasicpunc: true,
                minlength: 3,
                maxlength: 70
            },
            work: {
                required: true
            },
            work_instance: {
                required: false,
            },
            card_province: {
                required: true
            },
            card_regency: {
                required: true
            },
            card_district: {
                required: true
            },
            card_village: {
                required: true
            },
            card_street: {
                required: true
            },
            card_rt: {
                number: true
            },
            card_rw: {
                number: true
            }

        },
        messages: {
            nik: {
                required: "NIK/Nomor identitas tidak boleh kosong",
                digits: "NIK/Nomor identitas hanya boleh berisikan angka",
                minlength: "NIK/Nomor identitas harus berisikan 16 karakter",
                maxlength: "NIK/Nomor identitas tidak boleh melebihi 16 karakter"
            },
            name: {
                required: "Nama tidak boleh kosong",
                letterswithbasicpunc: "Nama hanya boleh berisikan huruf",
                minlength: "Nama tidak boleh kurang dari 3 karakter",
                maxlength: "Nama tidak boleh melebihi 70 karakter"
            },
            phone: {
                required: "Nomor HP tidak boleh kosong",
                digits: "Nomor HP hanya boleh berisikan angka",
                minlength: "Nomor HP tidak boleh kurang dari 9 digit",
                maxlength: "Nomor HP tidak boleh melebihi 13 digit"
            },
            gender: {
                required: "Jenis kelamin harus dipilih"
            },
            id_card_file: {
                required: "Foto harus dimasukan",
                accept: "Foto harus berbentuk gambar"
            },
            birth_regency: {
                required: "Tempat lahir harus diisi"
            },
            birth_at: {
                required: "Tanggal lahir harus diisi"
            },
            parent_name: {
                required: "Nama orang tua tidak boleh kosong",
                letterswithbasicpunc: "Nama orang tua hanya boleh berisikan huruf",
                minlength: "Nama orang tua tidak boleh kurang dari 3 karakter",
                maxlength: "Nama orang tua tidak boleh melebihi 70 karakter"
            },
            work: {
                required: "Pekerjaan harus diisi"
            },
            work_instance: {
                required: "Instansi pekerjaan harus diisi, apabila tidak ada maka isikan tidak ada",
                minlength: "Instansi pekerjaan tidak boleh kurang dari 3 karakter",
                maxlength: "Nama orang tua tidak boleh melebihi 70 karakter"
            },
            card_province: {
                required: "Provinsi KTP harus diisi"
            },
            card_regency: {
                required: "Kota/Kabupaten KTP harus diisi"
            },
            card_district: {
                required: "Kecamatan KTP harus diisi"
            },
            card_village: {
                required: "Desa KTP harus diisi"
            },
            card_street: {
                required: "Alamat KTP harus diisi"
            },
            card_rt: {
                number: "Nomor RT KTP harus dalam format angka"
            },
            card_rw: {
                number: "Nomor RW KTP harus dalam format angka"
            },
            living_province: {
                required: "Provinsi tinggal harus diisi"
            },
            living_regency: {
                required: "Kota/Kabupaten tinggal harus diisi"
            },
            living_district: {
                required: "Kecamatan tinggal harus diisi"
            },
            living_village: {
                required: "Desa tinggal harus diisi"
            },
            living_street: {
                required: "Jalan tinggal harus diisi"
            },
            living_rt: {
                number: "Nomor RT tinggal harus dalam format angka"
            },
            living_rw: {
                number: "Nomor RW tinggal harus dalam format angka"
            },

        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            // Add the `invalid-feedback` class to the error element
            error.addClass("invalid-feedback");

            if (element.prop("type") === "checkbox") {
                error.insertAfter(element.next("label"));
            } else if (element.prop("type") === "radio") {
                error.insertAfter('#' + element.attr("name"));
            } else if (element.prop("tagName") === "SELECT") {
                error.insertAfter("button[data-id='" + plural(element.attr("name")) + "']");
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function (element, errorClass, validClass) {
            if ($(element).prop("type") === "radio") {
                $("label[for=" + $(element).attr('name') + "]").addClass('text-danger');
            } else if ($(element).prop("tagName") === "SELECT") {
                $("button[data-id='" + plural($(element).attr("name")) + "']").css('border-color', '#e3342f')
            } else {
                $(element).addClass("is-invalid").removeClass("is-valid");
            }
        },
        unhighlight: function (element, errorClass, validClass) {
            if ($(element).prop("type") === "radio") {
                $("label[for=" + $(element).attr('name') + "]").removeClass('text-danger');
            } else if ($(element).prop("tagName") === "SELECT") {
                $("button[data-id='" + plural($(element).attr("name")) + "']").css('border-color', '#42B168')
            } else {
                $(element).addClass("is-valid").removeClass("is-invalid");
            }
        }

    });

    $("input[name='nik']").on('keyup', function () {
        var value = $(this).val();
        if (value.length == 16) {
            $.ajax({
                url: '/api/person/nik/is-exists/' + value,
                method: 'GET',
                asyncy: true,
                dataType: 'json',
                success: function (data) {
                    if (data !== 0) {
                        Swal.fire({
                            title: 'Ups, Identitas sudah terdaftar',
                            html: '<b>Nama: ' + data.name + '<br>Nama orang tua: ' + data.parent_name + '<br>Nomor HP: ' + data.phone + '</b><br><br><span class="text-danger">*Apabila data tersebut tidak sesuai, silahkan hubungi tim data COVID-19 Melawi</span>',
                            icon: 'error'
                        })
                    }
                }
            })
        }
    })

    $('select.form-control').on('change', function () {
        $(this).valid();
    });

    $('input.datedropper').on('change', function () {
        $(this).valid();
    });
}

function updatePersonValidationInit() {
    $('#person_update').validate({
        debug: false,
        rules: {
            nik: {
                required: true,
                digits: true,
                minlength: 16,
                maxlength: 16
            },
            name: {
                required: true,
                letterswithbasicpunc: true,
                minlength: 3,
                maxlength: 70
            },
            phone: {
                required: true,
                digits: true,
                minlength: 9,
                maxlength: 13
            },
            gender: {
                required: true
            },
            id_card_file: {
                required: function () {
                    var result = null
                    $.ajax({
                        url: '/api/person/id-card/is-exists/' + $('input[name="name"]').val(),
                        method: 'GET',
                        async: false,
                        dataType: 'json',
                        success: function (data) {
                            result = data
                        }
                    })

                    return result == 0
                },
                accept: "image/*"
            },
            birth_regency: {
                required: true
            },
            birth_at: {
                required: true,
            },
            parent_name: {
                required: false,
                letterswithbasicpunc: true,
                minlength: 3,
                maxlength: 70
            },
            work: {
                required: true
            },
            work_instance: {
                required: false,
            },
            card_province: {
                required: true
            },
            card_regency: {
                required: true
            },
            card_district: {
                required: true
            },
            card_village: {
                required: true
            },
            card_street: {
                required: true
            },
            card_rt: {
                number: true
            },
            card_rw: {
                number: true
            }

        },
        messages: {
            nik: {
                required: "NIK/Nomor identitas tidak boleh kosong",
                digits: "NIK/Nomor identitas hanya boleh berisikan angka",
                minlength: "NIK/Nomor identitas harus berisikan 16 karakter",
                maxlength: "NIK/Nomor identitas tidak boleh melebihi 16 karakter"
            },
            name: {
                required: "Nama tidak boleh kosong",
                letterswithbasicpunc: "Nama hanya boleh berisikan huruf",
                minlength: "Nama tidak boleh kurang dari 3 karakter",
                maxlength: "Nama tidak boleh melebihi 70 karakter"
            },
            phone: {
                required: "Nomor HP tidak boleh kosong",
                digits: "Nomor HP hanya boleh berisikan angka",
                minlength: "Nomor HP tidak boleh kurang dari 9 digit",
                maxlength: "Nomor HP tidak boleh melebihi 13 digit"
            },
            gender: {
                required: "Jenis kelamin harus dipilih"
            },
            id_card_file: {
                required: "Foto harus dimasukan",
                accept: "Foto harus berbentuk gambar"
            },
            birth_regency: {
                required: "Tempat lahir harus diisi"
            },
            birth_at: {
                required: "Tanggal lahir harus diisi"
            },
            parent_name: {
                required: "Nama orang tua tidak boleh kosong",
                letterswithbasicpunc: "Nama orang tua hanya boleh berisikan huruf",
                minlength: "Nama orang tua tidak boleh kurang dari 3 karakter",
                maxlength: "Nama orang tua tidak boleh melebihi 70 karakter"
            },
            work: {
                required: "Pekerjaan harus diisi"
            },
            work_instance: {
                required: "Instansi pekerjaan harus diisi, apabila tidak ada maka isikan tidak ada",
                minlength: "Instansi pekerjaan tidak boleh kurang dari 3 karakter",
                maxlength: "Nama orang tua tidak boleh melebihi 70 karakter"
            },
            card_province: {
                required: "Provinsi KTP harus diisi"
            },
            card_regency: {
                required: "Kota/Kabupaten KTP harus diisi"
            },
            card_district: {
                required: "Kecamatan KTP harus diisi"
            },
            card_village: {
                required: "Desa KTP harus diisi"
            },
            card_street: {
                required: "Alamat KTP harus diisi"
            },
            card_rt: {
                number: "Nomor RT KTP harus dalam format angka"
            },
            card_rw: {
                number: "Nomor RW KTP harus dalam format angka"
            },
            living_province: {
                required: "Provinsi tinggal harus diisi"
            },
            living_regency: {
                required: "Kota/Kabupaten tinggal harus diisi"
            },
            living_district: {
                required: "Kecamatan tinggal harus diisi"
            },
            living_village: {
                required: "Desa tinggal harus diisi"
            },
            living_street: {
                required: "Jalan tinggal harus diisi"
            },
            living_rt: {
                number: "Nomor RT tinggal harus dalam format angka"
            },
            living_rw: {
                number: "Nomor RW tinggal harus dalam format angka"
            },

        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            // Add the `invalid-feedback` class to the error element
            error.addClass("invalid-feedback");

            if (element.prop("type") === "checkbox") {
                error.insertAfter(element.next("label"));
            } else if (element.prop("type") === "radio") {
                error.insertAfter('#' + element.attr("name"));
            } else if (element.prop("tagName") === "SELECT") {
                error.insertAfter("button[data-id='" + plural(element.attr("name")) + "']");
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function (element, errorClass, validClass) {
            if ($(element).prop("type") === "radio") {
                $("label[for=" + $(element).attr('name') + "]").addClass('text-danger');
            } else if ($(element).prop("tagName") === "SELECT") {
                $("button[data-id='" + plural($(element).attr("name")) + "']").css('border-color', '#e3342f')
            } else {
                $(element).addClass("is-invalid").removeClass("is-valid");
            }
        },
        unhighlight: function (element, errorClass, validClass) {
            if ($(element).prop("type") === "radio") {
                $("label[for=" + $(element).attr('name') + "]").removeClass('text-danger');
            } else if ($(element).prop("tagName") === "SELECT") {
                $("button[data-id='" + plural($(element).attr("name")) + "']").css('border-color', '#42B168')
            } else {
                $(element).addClass("is-valid").removeClass("is-invalid");
            }
        }

    });

    $("input[name='nik']").on('keyup', function () {
        var value = $(this).val();
        if (value.length == 16) {
            $.ajax({
                url: '/api/person/nik/is-exists/' + value,
                method: 'GET',
                asyncy: true,
                dataType: 'json',
                success: function (data) {
                    if (data !== 0) {
                        Swal.fire({
                            title: 'Ups, Identitas sudah terdaftar',
                            html: '<b>Nama: ' + data.name + '<br>Nama orang tua: ' + data.parent_name + '<br>Nomor HP: ' + data.phone + '</b><br><br><span class="text-danger">*Apabila data tersebut tidak sesuai, silahkan hubungi tim data COVID-19 Melawi</span>',
                            icon: 'error'
                        })
                    }
                }
            })
        }
    })

    $('select.form-control').on('change', function () {
        $(this).valid();
    });

    $('input.datedropper').on('change', function () {
        $(this).valid();
    });
}

function createPeValidationInit() {
    require('./localization/messages_id')
    $('#pe_create').validate({
        lang: 'id',
        debug: false,
        rules: {
            swab_type: {
                required: true
            },
            swab_location: {
                required: true
            },
            note: {
                required: false
            },
            "criteria[]": {
                required: true
            },
            living_province: {
                required: true
            },
            living_regency: {
                required: true
            },
            living_district: {
                required: true
            },
            living_village: {
                required: true
            },
            living_street: {
                required: true
            },
            living_rt: {
                number: true
            },
            living_rw: {
                number: true
            },
            symptoms_toggle: {
                required: true,
            },
            symptoms_at: {
                required: "#symptoms_toggle_yes:checked",
            },
            "symptoms[]": {
                required: "#symptoms_toggle_yes:checked",
            },
            fever_temperature: {
                required: "#demam_toggle:checked"
            },
            symptoms_else: {
                required: "#symptoms_else_toggle:checked",
            },
            comorbidities_toggle: {
                required: true,
            },
            "comorbidities[]": {
                required: "#comorbidities_toggle_yes:checked",
            },
            comorbidities_else: {
                required: "#comorbidities_else_toggle:checked",
            },
            diagnoses_toggle: {
                required: true,
            },
            "diagnoses[]": {
                required: "#diagnoses_toggle_yes:checked",
            },
            diagnoses_else: {
                required: "#diagnoses_else_toggle:checked",
            },
            hospital_toggle: {
                required: true,
            },
            hospital_start_at: {
                required: "#hospital_toggle_yes:checked",
            },
            hospital_name: {
                required: "#hospital_toggle_yes:checked",
            },
            hospital_additions: {
                required: false,
            },
            hospital_name_history: {
                required: false,
            },
            hospital_status: {
                required: "#hospital_toggle_yes:checked",
            },
            travel_history_international_toggle: {
                required: true,
            },
            travel_history_international_country: {
                required: "#travel_history_international_toggle_yes:checked",
            },
            travel_history_international_regency: {
                required: "#travel_history_international_toggle_yes:checked",
            },
            travel_history_international_departure_at: {
                required: "#travel_history_international_toggle_yes:checked",
            },
            travel_history_international_arrive_at: {
                required: "#travel_history_international_toggle_yes:checked",
            },
            travel_history_domestic_toggle: {
                required: true,
            },
            travel_history_domestic_regency: {
                required: "#travel_history_domestic_toggle_yes:checked",
            },
            travel_history_domestic_departure_at: {
                required: "#travel_history_domestic_toggle_yes:checked",
            },
            travel_history_domestic_arrive_at: {
                required: "#travel_history_domestic_toggle_yes:checked",
            },
            travel_history_living_toggle: {
                required: true,
            },
            travel_history_living_regency: {
                required: "#travel_history_living_toggle_yes:checked",
            },
            travel_history_living_departure_at: {
                required: "#travel_history_living_toggle_yes:checked",
            },
            travel_history_living_arrive_at: {
                required: "#travel_history_living_toggle_yes:checked",
            },
            contact_history_normal_toggle: {
                required: true,
            },
            contact_history_normal_name: {
                required: "#contact_history_normal_toggle_yes:checked",
            },
            contact_history_normal_address: {
                required: "#contact_history_normal_toggle_yes:checked",
            },
            contact_history_normal_phone: {
                required: "#contact_history_normal_toggle_yes:checked",
            },
            contact_history_normal_gender: {
                required: "#contact_history_normal_toggle_yes:checked",
            },
            contact_history_normal_status: {
                required: "#contact_history_normal_toggle_yes:checked",
            },
            contact_history_normal_start_at: {
                required: "#contact_history_normal_toggle_yes:checked",
            },
            contact_history_normal_end_at: {
                required: "#contact_history_normal_toggle_yes:checked",
            },
            contact_history_close_toggle: {
                required: true,
            },
            contact_history_close_name: {
                required: "#contact_history_close_toggle_yes:checked",
            },
            contact_history_close_address: {
                required: "#contact_history_close_toggle_yes:checked",
            },
            contact_history_close_phone: {
                required: "#contact_history_close_toggle_yes:checked",
            },
            contact_history_close_gender: {
                required: "#contact_history_close_toggle_yes:checked",
            },
            contact_history_close_status: {
                required: "#contact_history_close_toggle_yes:checked",
            },
            contact_history_close_start_at: {
                required: "#contact_history_close_toggle_yes:checked",
            },
            contact_history_close_end_at: {
                required: "#contact_history_close_toggle_yes:checked",
            },
            ispa: {
                required: true,
            },
            pet_toggle: {
                required: true,
            },
            pet: {
                required: "#pet_toggle_yes:checked",
            },
            health_worker_toggle: {
                required: true,
            },
            "protectors[]": {
                required: "#health_worker_toggle_yes:checked",
            },
            tube_code: {
                required: false,
            },
            group_code: {
                required: false,
            },
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            // Add the `invalid-feedback` class to the error element
            error.addClass("invalid-feedback");

            if (element.prop("type") === "checkbox") {
                error.appendTo(('label[for="' + element.attr('name') + '"]'));
            } else if (element.prop("type") === "radio") {
                error.insertAfter('#' + element.attr("name"));
            } else if (element.prop("tagName") === "SELECT") {
                error.insertAfter("button[data-id='" + plural(element.attr("name")) + "']");
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function (element, errorClass, validClass) {
            if ($(element).prop("type") === "radio") {
                $("label[for=" + $(element).attr('name') + "]").addClass('text-danger');
            } else if ($(element).prop("tagName") === "SELECT") {
                $("button[data-id='" + plural($(element).attr("name")) + "']").css('border-color', '#e3342f')
            } else if ($(element).prop("type") === "checkbox") {
                // Do nothing
            } else {
                $(element).addClass("is-invalid").removeClass("is-valid");
            }
        },
        unhighlight: function (element, errorClass, validClass) {
            if ($(element).prop("type") === "radio") {
                $("label[for=" + $(element).attr('name') + "]").removeClass('text-danger');
            } else if ($(element).prop("tagName") === "SELECT") {
                $("button[data-id='" + plural($(element).attr("name")) + "']").css('border-color', '#42B168')
            } else if ($(element).prop("type") === "checkbox") {
                // Do nothing
            } else {
                $(element).addClass("is-valid").removeClass("is-invalid");
            }
        }
    })

    $('select.form-control').on('change', function () {
        $(this).valid();
    });

    $('input.datedropper').on('change', function () {
        $(this).valid();
    });

    $('#tube_code').on('keyup', function () {
        var value = $(this).val();
        if (value.length > 2) {
            $.ajax({
                url: '/api/pe/tube-code/is-exists/' + value,
                method: 'GET',
                asyncy: true,
                dataType: 'json',
                success: function (data) {
                    if (data === 1) {
                        Swal.fire({
                            title: 'Nomor Tabung Tidak Bisa Dipakai',
                            text: 'Nomor tabung sudah pernah dimasukan. Cek kembali nomor tabung. ',
                            icon: 'error'
                        })
                    }
                }
            })
        }
    })
}

export {
    createPersonValidationInit,
    createPeValidationInit,
    updatePersonValidationInit
}
