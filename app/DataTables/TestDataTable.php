<?php

namespace App\DataTables;

use App\Test;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Person;

class TestDataTable extends DataTable
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
            ->addColumn('action', function($test){
                $view_btn = '<a href="' . route('pe.view', ['code'=>$test->code]) . '" class="btn btn-warning mr-2" target="_blank">Lihat</a>';
                $download_btn = '<a href="' . route('pe.download', ['code'=>$test->code]) . '" class="btn btn-success" target="_blank">Download PE</a>';
                return $view_btn . $download_btn;
            })
            ->editColumn('person.name', function(Test $test){
                return '<b>' . Str::title($test->person->name) . "</b><br>{$test->person->nik}";
            })
            ->editColumn('person.gender', function(Test $test){
                return $test->person->gender == 'm' ? 'Laki-laki' : 'Perempuan';
            })
            ->editColumn('created_at', function(Test $test){
                return $test->created_at->isoFormat('DD MMMM Y');
            })
            ->rawColumns(['person.name', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\Test $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $tests = Test::whereNotNull('code')->with('person');
        return $tests->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('test-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Blfrtip')
                    ->responsive(true)
                    ->orderBy(0, 'desc')
                    ->buttons(
                        Button::make('excel')->text('Download Excel'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')
                ->title('Id')
                ->visible(false),
            Column::make('person.nik')
                ->title('NIK')
                ->visible(false),
            Column::make('person.name')
                ->title('Nama (NIK)'),
            Column::make('person.gender')
                ->title('Jenis Kelamin'),
            Column::make('created_at')
                ->title('Tanggal SWAB')
                ->orderable(false),
            // Column::make('tube_code')
            //     ->name('tube_code')
            //     ->title('Kode Tabung'),
            // Column::make('created_at'),
            // Column::make('updated_at'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Test_' . date('YmdHis');
    }
}
