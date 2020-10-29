require('./datedropper')

function dateDropperInit() {
    $.extend($.dateDropperSetup.languages, {
        'id': {
            name: 'Indonesia',
            months: {
                short: [
                    'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember'
                ],
                full: [
                    'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember'
                ]
            },
            weekdays: {
                short: [
                    'Min',
                    'Sen',
                    'Sel',
                    'Rab',
                    'Kam',
                    'Jum',
                    'Sab'
                ],
                full: [
                    'Minggu',
                    'Senin',
                    'Selasa',
                    'Rabu',
                    'Kamis',
                    'Jum\'at',
                    'Sabtu'
                ]
            }
        }
    });

    refreshDateDropper()
}

function refreshDateDropper() {
    $('.datedropper').dateDropper({
        theme: 'leaf',
        lang: 'id',
        large: true,
        // largeDefault: true,
        minYear: '1930',
        maxYear: '2020',
        jump: '1',
    })
}

export {
    dateDropperInit,
    refreshDateDropper
}
