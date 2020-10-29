import Swal from 'sweetalert2'

function radioShowHideToggle(name) {
    $("input[name='" + name + "_toggle']").on('change', function () {
        var val = $("input[name='" + name + "_toggle']:checked").val();
        if (val == 'yes') {
            $('div#' + name + '_target').show()
        } else if (val == 'no') {
            $('div#' + name + '_target').hide()
        }
    })
}

function checkboxShowHideToggle(id) {
    $("#" + id + "_toggle").on('change', function () {
        var elem = $("#" + id + "_toggle");
        if (elem.is(':checked')) {
            $('#' + id + '_target').show()
        } else {
            $('#' + id + '_target').hide()
        }
    })
}

function nikCheck() {
    $("input[name='nik_check']").on('keyup', function () {
        var value = $(this).val();
        if (value.length == 16) {
            $.ajax({
                url: '/api/person/nik/is-exists/' + value,
                method: 'GET',
                asyncy: true,
                dataType: 'json',
                success: function (data) {
                    if (data !== 0) {
                        $('button#btn_nik_check').removeAttr('disabled');
                        Swal.fire({
                            title: 'Sip, Identitas sudah terdaftar',
                            html: '<b>Nama: ' + data.name + '<br>Orang tua: ' + data.parent_name + '<br>Nomor HP: ' + data.phone + '</b><br><br><span class="text-success font-weight-bold">Apabila data sesuai, silahkan lanjut ke form PE</span><br><br><span class="text-danger">*Apabila data tidak sesuai, silahkan hubungi tim data COVID-19 Melawi</span>',
                            icon: 'success',
                            confirmButtonText: `Lanjut ke Form PE`,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('button#btn_nik_check').click();
                            }
                        })
                        $("input[name='nik_check']").on('keyup', function () {
                            $('button#btn_nik_check').attr('disabled', true);
                        })
                    } else {
                        Swal.fire({
                            title: 'Ups',
                            text: 'NIK tidak terdaftar. Cek kembali NIK pasien. Jika pasien belum pernah mendaftar, silahkan lakukan pendaftaran orang baru',
                            icon: 'error'
                        })
                    }
                }
            })
        }
    })
}

export {
    radioShowHideToggle,
    checkboxShowHideToggle,
    nikCheck
}
