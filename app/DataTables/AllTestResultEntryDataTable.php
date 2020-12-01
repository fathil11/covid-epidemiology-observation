<?php

namespace App\DataTables;

use App\Test;
use Illuminate\Support\Str;
use App\App\TestResultEntry;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AllTestResultEntryDataTable extends DataTable
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
            ->addColumn('action', function(Test $test){
                return view('components.lab.result-entry-action', ['test' => $test]);
            })

            //* PERSON SECTION
            ->addColumn('person_name_display', function($test){
                return '<b>' . Str::title($test->person->name) . "</b><br>{$test->person->nik}";
            })
            ->addColumn('person_age_display', function($test){
                return $test->person->birth_at->age;
            })
            ->addColumn('person_gender_print', function($test){
                return $test->person->gender == 'm' ? 'Laki-laki' : 'Perempuan';
            })

            //* TEST SECTION
            ->addColumn('test_at_display', function(Test $test){
                return [
                    'format' => $test->test_at != null ? $test->test_at->isoFormat('DD MMMM Y') : '',
                    'timestamp' => $test->test_at != null ? $test->test_at->timestamp : '',
                ];
            })
            ->addColumn('test_at_print', function(Test $test){
                return $test->test_at != null ? $test->test_at->isoFormat('DD MMMM Y') : '';
            })

            //* RESULT SECTION
            ->addColumn('result_display', function(Test $test){
                return $test->result != null ? Str::title($test->result->value) : '';
            })

            ->addColumn('result_created_at_display', function(Test $test){
                return [
                    'format' => $test->result != null ? $test->result->created_at->isoFormat('DD MMMM Y') : '',
                    'timestamp' => $test->result != null ? $test->result->created_at->timestamp : '',
                ];
            })
            ->addColumn('result_created_at_print', function(Test $test){
                return $test->result != null ? $test->result->created_at->isoFormat('DD MMMM Y') : '';
            })

            ->rawColumns(['person_name_display', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\TestResultEntry $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $model = Test::whereNotNull(['tube_code','test_at'])->where('location', 'internal')->with(['person', 'user', 'result'])->select('tests.*');
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
                    ->setTableId('testresultentry-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Blfrtip')
                    ->buttons([
                        Button::make('excel')->text('Download Excel'),
                        Button::make('print')->text('Cetak'),
                        Button::make('reset')->text('Muat Ulang'),
                    ])
                    ->orderBy(3);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('test_at_print')
                ->title('Tanggal SWAB')
                ->name('test_at')
                ->visible(false),
            Column::make('tube_code')
                ->title('Nomor Tabung'),
            Column::make('person_name_display')
                ->title('Nama (NIK)')
                ->name('person.name')
                ->printable(false)
                ->exportable(false),
            Column::make('person.name')
                ->title('Nama')
                ->name('person.name')
                ->visible(false),
            Column::make('person.nik')
                ->title('NIK')
                ->name('person.nik')
                ->visible(false),
            Column::make('person_gender_print')
                ->title('Jenis Kelamin')
                ->name('person.gender')
                ->visible(false),
            Column::make('person_age_display')
                ->title('Umur')
                ->name('person.birth_at'),
            Column::make('person.phone')
                ->title('Nomor HP')
                ->name('person.phone')
                ->visible(false),
            Column::make('living_province')
                ->title('Provinsi')
                ->name('living_province')
                ->visible(false),
            Column::make('living_regency')
                ->title('Kabupaten/Kota')
                ->name('living_regency')
                ->visible(false),
            Column::make('living_district')
                ->title('Kecamatan')
                ->name('living_district')
                ->visible(false),
            Column::make('living_village')
                ->title('Desa')
                ->name('living_village')
                ->visible(false),
            Column::make('test_at_display')
                ->title('Tanggal SWAB')
                ->name('test_at')
                ->data(["_" => 'test_at_display.format', "sort" => 'test_at_display.timestamp'])
                ->orderable(true)
                ->searchable(true)
                ->printable(false)
                ->exportable(false),
            Column::make('result_created_at_display')
                ->title('Tanggal Hasil')
                ->name('result.created_at')
                ->data(["_" => 'result_created_at_display.format', "sort" => 'result_created_at_display.timestamp'])
                ->orderable(true)
                ->searchable(true)
                ->printable(false)
                ->exportable(false),
            Column::make('result_created_at_print')
                ->title('Tanggal Hasil')
                ->name('result.value'),
            Column::make('result_display')
                ->title('Hasil')
                ->name('result.value'),
            Column::make('action')
                ->title('Aksi')
                ->searchable(false)
                ->orderable(false)
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
        return 'TestResultEntry_' . date('YmdHis');
    }
}
