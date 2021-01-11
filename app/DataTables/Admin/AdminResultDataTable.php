<?php

namespace App\DataTables\Admin;

use App\Result;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AdminResultDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)

            //! RESULT SECTION
            ->editColumn('value', function($result){
                return Str::title($result->value);
            })

            ->editColumn('created_at', function($result){
                return [
                    'format' => $result->created_at->isoFormat('DD MMMM Y'),
                    'timestamp' => $result->created_at->timestamp,
                ];
            })

            ->addColumn('created_at_print', function($result){
                return $result->created_at->isoFormat('DD MMMM Y');
            })

            //! TEST SECTION
            ->addColumn('test', function($result){
                return [
                    'format' => $result->test->test_at != '' ? $result->test->test_at->isoFormat('DD MMMM Y') : '',
                    'timestamp' => $result->test->test_at != '' ? $result->test->test_at->timestamp : '',
                ];
            })

            ->addColumn('criteria_print', function($result){
                return $result->test->criteria;
            })

            ->addColumn('symptom_at_print', function($result){
                return $result->test->symptoms->count() > 0 ? $result->test->symptoms->first()->symptom_at->isoFormat('DD MMMM Y') : '';
            })

            ->addColumn('symptoms_print', function($result){
                return $result->test->symptoms->count() > 0 ? $result->test->symptoms_list : '';
            })

            ->addColumn('test_at_print', function($result){
                return $result->test->test_at != '' ? $result->test->test_at->isoFormat('DD MMMM Y') : '';
            })

            ->addColumn('province_display', function($result){
                return $result->test->living_province;
            })

            ->addColumn('regency_display', function($result){
                return $result->test->living_regency;
            })

            ->addColumn('district_display', function($result){
                return $result->test->living_district;
            })

            ->addColumn('village_display', function($result){
                return $result->test->living_village;
            })

            ->addColumn('living_address_print', function($result){
                $address = "";
                if($result->test->living_street != null){
                    $address = $result->test->living_street;
                }
                if($result->test->living_village != null){
                    $address .= " " . $result->test->living_village;
                }
                if($result->test->living_district != null){
                    $address .= " " . $result->test->living_district;
                }
                if($result->test->living_regency != null){
                    $address .= " " . $result->test->living_regency;
                }
                if($result->test->living_province != null){
                    $address .= " " . $result->test->living_province;
                }
                return $address;
            })

            //! PERSON SECTION
            ->addColumn('name_print', function($result){
                return Str::title($result->test->person->name);
            })

            ->addColumn('nik_print', function($result){
                return $result->test->person->nik != null ? $result->test->person->nik . " " : '';
            })

            ->addColumn('work_print', function($result){
                return $result->test->person->work != null ? Str::title($result->test->person->work) : '';
            })

            ->addColumn('work_instance_print', function($result){
                return $result->test->person->work_instance != null ? Str::title($result->test->person->work_instance) : '';
            })

            ->addColumn('card_address_print', function($result){
                $address = "";

                if($result->test->person->card_street != null){
                    $address = $result->test->person->card_street;
                }
                if($result->test->person->card_village != null){
                    $address .= " " . $result->test->person->card_village;
                }
                if($result->test->person->card_district != null){
                    $address .= " " . $result->test->person->card_district;
                }
                if($result->test->person->card_regency != null){
                    $address .= " " . $result->test->person->card_regency;
                }
                if($result->test->person->card_province != null){
                    $address .= " " . $result->test->person->card_province;
                }
                return $address;
            })

            ->addColumn('name_display', function($result){
                return '<b>' . Str::title($result->test->person->name) . "</b><br>{$result->test->person->nik}";
            })

            ->addColumn('gender_display', function($result){
                return $result->test->person->gender == 'm' ? 'Laki-laki' : 'Perempuan';
            })

            ->addColumn('age_display', function($result){
                return $result->test->person->birth_at != null ? Carbon::parse($result->test->person->birth_at)->age : '' ;
            })

            ->addColumn('phone_display', function($result){
                return $result->test->person->phone != null ? $result->test->person->phone : '' ;
            })

            ->addColumn('action', function($result){
                $mail_btn = '<a href="' . route('public.result', $result->test->code) . '" class="btn btn-success mr-2" target="_blank">Lihat Keterangan</a>';
                return $mail_btn;
            })
            ->rawColumns(['action', 'name_display']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\Result $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $model = Result::with(['test', 'test.person'])->select('results.*');
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('result-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->responsive(true)
                    ->dom('Blfrtip')
                    ->buttons([
                        Button::make('excel')->text('Download Excel'),
                        Button::make('print')->text('Cetak'),
                        Button::make('reload')->text('Reload'),
                        Button::make('reset')->text('Reset'),
                    ])
                    // ->initComplete("
                    // function () {
                    //     this.api().columns([1,5,21]).every(function () {
                    //         var column = this;
                    //         var input = document.createElement(\"input\");
                    //         $(input).appendTo($(column.footer()).empty())
                    //         $(input).addClass('form-control')
                    //         $(input).attr('placeholder', this.header().innerHTML)
                    //         .on('keyup', function () {
                    //             column.search($(this).val(), false, false, true).draw();
                    //         });
                    //     });

                    //     this.api().columns([4]).every(function () {
                    //         var column = this;
                    //         var input = document.createElement(\"input\");
                    //         $(input).appendTo($(column.footer()).empty())
                    //         $(input).addClass('form-control')
                    //         $(input).attr('placeholder', this.header().innerHTML)
                    //         .on('keyup', function () {
                    //             if($(this).val().length == 0){
                    //                 this.api().clear();
                    //                 this.api().reload();
                    //             }
                    //             column.search((2020-$(this).val()), false, false, true).draw();
                    //         });
                    //     });

                    //     this.api().columns([13,15]).every(function () {
                    //         var column = this;
                    //         var input = document.createElement(\"input\");
                    //         $(input).appendTo($(column.footer()).empty())
                    //         $(input).addClass('form-control')
                    //         $(input).attr('placeholder', 'Th-Bln-Tg')
                    //         .on('keyup', function () {
                    //             if($(this).val().length >= 7){
                    //                 column.search($(this).val(), false, false, true).draw();
                    //             }
                    //         });
                    //     });

                    //     this.api().column(3).every( function () {
                    //         var column = this;
                    //         var select = $('<select class=\"custom-select\"><option value=\"\">--Jenis Kelamin--</option></select>')
                    //             .appendTo( $(column.footer()).empty() )
                    //             .on( 'change', function () {
                    //                 var val = $.fn.dataTable.util.escapeRegex(
                    //                     $(this).val()
                    //                 );

                    //                 column
                    //                     .search( val ? '^'+val+'$' : '', true, false )
                    //                     .draw();
                    //             } );

                    //         $.each([['Laki-laki','m'], ['Perempuan','f']] , function ( key, gender ) {
                    //             select.append( '<option value=\"'+gender[1]+'\">'+gender[0]+'</option>' )
                    //         } );
                    //     } );

                    //     this.api().column(17).every( function () {
                    //         var column = this;
                    //         var select = $('<select class=\"custom-select\"><option value=\"\">--Hasil--</option></select>')
                    //             .appendTo( $(column.footer()).empty() )
                    //             .on( 'change', function () {
                    //                 var val = $.fn.dataTable.util.escapeRegex(
                    //                     $(this).val()
                    //                 );

                    //                 column
                    //                     .search( val ? '^'+val+'$' : '', true, false )
                    //                     .draw();
                    //             } );

                    //         $.each(['positif', 'negatif'] , function ( key, result ) {
                    //             select.append( '<option style=\"text-transform:capitalize;\" value=\"'+result+'\">'+result+'</option>' )
                    //         } );
                    //     } );

                    //     this.api().column(20).every( function () {
                    //         var column = this;
                    //         var select = $('<select class=\"custom-select\"><option value=\"\">--Kecamatan--</option></select>')
                    //             .appendTo( $(column.footer()).empty() )
                    //             .on( 'change', function () {
                    //                 var val = $.fn.dataTable.util.escapeRegex(
                    //                     $(this).val()
                    //                 );

                    //                 column
                    //                     .search( val ? '^'+val+'$' : '', true, false )
                    //                     .draw();
                    //             } );
                    //         var districts = ['sokan', 'tanah pinoh', 'tanah pinoh barat', 'sayan', 'belimbing', 'belimbing hulu', 'nanga pinoh', 'pinoh selatan', 'pinoh utara', 'ella hilir', 'menukung'];
                    //         $.each(districts , function ( key, district ) {
                    //             select.append( '<option style=\"text-transform:capitalize;\" value=\"'+district+'\">'+district+'</option>' )
                    //         } );
                    //     } );
                    // }
                    // ")
                    ->orderBy(15, 'desc');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            //! 1
        Column::make('nik_print')
                ->name('test.person.nik')
                ->title('NIK')
                ->visible(false)
                ->orderable(false),

            //! 2
            Column::make('name_display')
                ->title('Nama')
                ->name('test.person.name')
                ->printable(false)
                ->exportable(false)
                ->orderable(true),

            //! 3
            Column::make('name_print')
                ->name('test.person.name')
                ->title('Nama')
                ->visible(false)
                ->orderable(false),

            //! 4
            Column::make('gender_display')
                ->name('test.person.gender')
                ->title('Jenis Kelamin')
                ->orderable(true),

            //! 5
            Column::make('age_display')
                ->name('test.person.birth_at')
                ->title('Umur')
                ->orderable(false)
                ->searchable(true),

            //! 6
            Column::make('phone_display')
                ->name('test.person.phone')
                ->title('Nomor HP')
                ->orderable(false),

            //! 7
            Column::make('work_print')
                ->name('test.person.work')
                ->title('Pekerjaan')
                ->searchable(false)
                ->orderable(false)
                ->visible(false),

            //! 8
            Column::make('work_instance_print')
                ->name('test.person.work_instance')
                ->title('Instansi')
                ->searchable(false)
                ->orderable(false)
                ->visible(false),

            //! 9
            Column::make('card_address_print')
                ->title('Alamat KTP')
                ->searchable(false)
                ->orderable(false)
                ->visible(false),

            //! 10
            Column::make('living_address_print')
                ->title('Alamat Tinggal')
                ->searchable(false)
                ->orderable(false)
                ->visible(false),

            //! 11
            Column::make('criteria_print')
                ->title('Alasan')
                ->searchable(false)
                ->orderable(false)
                ->visible(false),

            //! 12
            Column::make('symptom_at_print')
                ->name('test.symptoms.symptom_at')
                ->title('Tanggal Munculnya Gejala')
                ->searchable(false)
                ->orderable(false)
                ->visible(false),

            //! 13
            Column::make('symptoms_print')
                ->name('test.symptoms')
                ->title('Keluhan')
                ->searchable(false)
                ->orderable(false)
                ->visible(false),

            //! 14
            Column::make('test')
                ->title('Tanggal Tes')
                ->name('test.test_at')
                ->data(["_" => 'test.format', "sort" => 'test.timestamp'])
                ->orderable(true)
                ->searchable(true)
                ->printable(false)
                ->exportable(false),

            //! 15
            Column::make('test_at_print')
                ->title('Tanggal Tes')
                ->visible(false),

            //! 16
            Column::make('created_at')
                ->title('Tanggal Keluar Hasil')
                ->name('created_at')
                ->data(["_" => 'created_at.format', "sort" => 'created_at.timestamp'])
                ->orderable(true)
                ->searchable(true)
                ->printable(false)
                ->exportable(false),

            //! 17
            Column::make('created_at_print')
                ->title('Tanggal Keluar Hasil')
                ->visible(false),

            //! 18
            Column::make('value')
                ->title('Hasil'),

            //! 19
            Column::make('province_display')
                ->title('Provinsi')
                ->name('test.living_province')
                ->searchable(false)
                ->orderable(false)
                ->visible(false),

            //! 20
            Column::make('regency_display')
                ->title('Kota/Kabupaten')
                ->name('test.living_regency')
                ->searchable(false)
                ->orderable(false)
                ->visible(false),

            //! 21
            Column::make('district_display')
                ->title('Kecamatan')
                ->name('test.living_district'),

            //! 22
            Column::make('village_display')
                ->title('Desa')
                ->name('test.living_village'),

            //! 23
            Column::make('action')
                ->title('Aksi')
                ->orderable(false)
                ->searchable(false)
                ->printable(false)
                ->exportable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Result_' . date('YmdHis');
    }
}
