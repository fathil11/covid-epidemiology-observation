<?php

namespace App\DataTables;

use App\Result;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ResultDataTable extends DataTable
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
            ->editColumn('value', function($result){
                return Str::title($result->value);
            })
            ->addColumn('test', function($result){
                return $result->test;
            })
            ->addColumn('test.person', function($result){
                return $result->test->person;
            })
            ->editColumn('test.person.name', function($result){
                return Str::title($result->test->person->name);
            })
            ->editColumn('created_at', function($result){
                return [
                    'format' => $result->created_at->isoFormat('DD MMMM Y'),
                    'timestamp' => $result->created_at->timestamp,
                ];
            })
            ->addColumn('action', function($result){
                $mail_btn = '<a href="' . route('public.result', $result->test->code) . '" class="btn btn-success mr-2" target="_blank">Lihat Keterangan</a>';
                return $mail_btn;
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\Result $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $model = Result::with(['test', 'test.person']);
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
                    ->dom('lfrtip')
                    ->orderBy(2);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('test.person.name')
                ->name('test.person.name')
                ->title('Nama'),
            Column::make('value')
                ->title('Hasil'),
                Column::make('created_at')
                ->title('Tanggal Keluar Hasil')
                ->data(["_" => 'created_at.format', "sort" => 'created_at.timestamp'])
                ->title('Tanggal SWAB')
                ->orderable(true)
                ->searchable(false),
            Column::make('action')
                ->title('Aksi'),
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
