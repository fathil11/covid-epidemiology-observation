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
                $disabled = false;
                if($test->tube_code == null){
                    $disabled = true;
                }

                if(!$disabled){
                    $view_btn = '<a href="' . route('pe.view', ['code'=>$test->code]) . '" class="btn btn-warning mr-2" target="_blank">Lihat</a>';
                    $download_btn = '<a href="' . route('pe.download', ['code'=>$test->code]) . '" class="btn btn-success" target="_blank">Download PE</a>';
                    return $view_btn . $download_btn;
                }

                return '';
            })
            ->addColumn('person.name', function(Test $test){
                return $test->person->name;
            })
            ->addColumn('person.nik_modified', function(Test $test){
                return "`" . $test->person->nik;
            })
            ->editColumn('person.name_modified', function(Test $test){
                return '<b>' . Str::title($test->person->name) . "</b><br>{$test->person->nik}";
            })
            ->editColumn('person.gender', function(Test $test){
                return $test->person->gender == 'm' ? 'Laki-laki' : 'Perempuan';
            })
            ->addColumn('created_at_print', function($result){
                    return $result->created_at->isoFormat('DD MMMM Y');
            })
            ->addColumn('created_at_display', function($result){
                return [
                    'format' => $result->created_at->isoFormat('DD MMMM Y'),
                    'timestamp' => $result->created_at->timestamp,
                ];
            })
            ->rawColumns(['person.name_modified', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\Test $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $model = Test::whereNotNull('code')->with('person');
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
                    ->setTableId('test-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Blfrtip')
                    ->responsive(true)
                    // ->orderBy(4, 'desc')
                    ->buttons(
                        Button::make('excel')
                            ->text('Download Excel'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload'),
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
            Column::make('person.name')
                ->title('Nama')
                ->visible(false),
            Column::make('person.nik_modified')
                ->name('person.nik')
                ->title('NIK')
                ->type('string')
                ->visible(false),
            Column::make('person.name_modified')
                ->name('person.name')
                ->exportable(false)
                ->printable(false)
                ->title('Nama (NIK)'),
            Column::make('person.gender')
                ->title('Jenis Kelamin'),
            Column::make('created_at_print')
                ->title('Tanggal SWAB')
                ->visible(false),
            Column::make('created_at_display')
                ->title('Tanggal SWAB')
                ->name('created_at')
                ->data(["_" => 'created_at_display.format', "sort" => 'created_at_display.timestamp', "show" => 'created_at'])
                ->printable(false)
                ->exportable(false)
                ->orderable(true)
                ->searchable(true),
            Column::computed('action')
                ->title('Aksi')
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
