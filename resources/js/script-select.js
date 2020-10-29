require('bootstrap-select');

function listInit(list, selector) {
    $(selector).last().selectpicker();

    list.forEach(function (value) {
        $(selector).last().append("<option value=\"" + value + "\">" + value + "</option>")
    })

    $(selector).last().selectpicker('refresh');
}

function fullLocationListInit(type) {
    $('#' + type + '_provinces').selectpicker();
    $('#' + type + '_regencies').selectpicker();
    $('#' + type + '_districts').selectpicker();
    $('#' + type + '_villages').selectpicker();
    $.ajax({
        url: '/api/location/provinces',
        method: 'GET',
        async: true,
        dataType: 'json',
        success: function (data) {
            data.forEach(value => {
                $('#' + type + '_provinces').append("<option value=\"" + value.name + "\">" + titleCase(value.name) + "</option>")
            });
            $('#' + type + '_provinces').selectpicker('refresh');
        }
    })

    $('#' + type + '_provinces').on('change', function () {
        $.ajax({
            url: '/api/location/' + $('#' + type + '_provinces').val() + '/regencies',
            method: 'GET',
            async: true,
            dataType: 'json',
            success: function (data) {
                $('#' + type + '_regencies').empty()
                data.forEach(value => {
                    $('#' + type + '_regencies').append("<option value=\"" + value.name + "\">" + titleCase(value.name) + "</option>")
                })
                $('#' + type + '_regencies').selectpicker('refresh');
            }
        })
    })

    $('#' + type + '_regencies').on('change', function () {
        $.ajax({
            url: '/api/location/' + $('#' + type + '_regencies').val() + '/districts',
            method: 'GET',
            async: true,
            dataType: 'json',
            success: function (data) {
                $('#' + type + '_districts').empty()
                data.forEach(value => {
                    $('#' + type + '_districts').append("<option value=\"" + value.name + "\">" + titleCase(value.name) + "</option>")
                })
                $('#' + type + '_districts').selectpicker('refresh');
            }
        })
    })

    $('#' + type + '_districts').on('change', function () {
        $.ajax({
            url: '/api/location/' + $('#' + type + '_districts').val() + '/villages',
            method: 'GET',
            async: true,
            dataType: 'json',
            success: function (data) {
                $('#' + type + '_villages').empty()
                data.forEach(value => {
                    $('#' + type + '_villages').append("<option value=\"" + value.name + "\">" + titleCase(value.name) + "</option>")
                })
                $('#' + type + '_villages').selectpicker('refresh');
            }
        })
    })
}

function regencyLocationListInit(selector) {
    $.ajax({
        url: '/api/location/regencies',
        method: 'GET',
        async: true,
        dataType: 'json',
        success: function (data) {
            data.forEach(value => {
                $(selector).append("<option value=\"" + value.name + "\">" + titleCase(value.name) + "</option>")
            });
            $(selector).selectpicker('refresh');
        }
    })
}

export {
    listInit,
    regencyLocationListInit,
    fullLocationListInit
}

// Helper
function titleCase(str) {
    return str.toLowerCase().split(' ').map(function (word) {
        return (word.charAt(0).toUpperCase() + word.slice(1));
    }).join(' ');
}
