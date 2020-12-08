<?php

namespace App\DataTables\Lab;

use App\Test;
use Illuminate\Support\Str;
use App\App\TestResultEntry;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LabTestResultEntryDataTable extends DataTable
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

            //* TEST SECTION
            ->addColumn('test_at_display', function(Test $test){
                return [
                    'format' => $test->test_at != null ? $test->test_at->isoFormat('DD MMMM Y') : '',
                    'timestamp' => $test->test_at != null ? $test->test_at->timestamp : '',
                ];
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
        $model = Test::whereNotNull(['tube_code','test_at'])->where('location', 'internal')->whereDoesntHave('result')->with(['person', 'user'])->select('tests.*');
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
                    ->dom('lfrtip')
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
            Column::make('tube_code')
                ->title('Nomor Tabung'),
            Column::make('person_name_display')
                ->title('Nama (NIK)')
                ->name('person.name'),
            Column::make('person_age_display')
                ->title('Umur')
                ->name('person.birth_at'),
            Column::make('test_at_display')
                ->title('Tanggal SWAB')
                ->name('test_at')
                ->data(["_" => 'test_at_display.format', "sort" => 'test_at_display.timestamp'])
                ->orderable(true)
                ->searchable(true)
                ->printable(false)
                ->exportable(false),
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
