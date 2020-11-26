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

            //* RESULT SECTION
            ->editColumn('value', function($result){
                return Str::title($result->value);
            })

            ->editColumn('created_at', function($result){
                return [
                    'format' => $result->created_at->isoFormat('DD MMMM Y'),
                    'timestamp' => $result->created_at->timestamp,
                ];
            })

            //* TEST SECTION
            ->addColumn('test', function($result){
                return [
                    'format' => $result->test->test_at != '' ? $result->test->test_at->isoFormat('DD MMMM Y') : '',
                    'timestamp' => $result->test->test_at != '' ? $result->test->test_at->timestamp : '',
                ];
            })

            //* PERSON SECTION
            ->addColumn('name_display', function($result){
                return '<b>' . Str::title($result->test->person->name) . "</b><br>{$result->test->person->nik}";
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
                    ->dom('lfrtip')
                    ->orderBy(3, 'desc');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('name_display')
                ->name('test.person.name')
                ->title('Nama')
                ->orderable(true),
            Column::make('value')
                ->title('Hasil'),

            Column::make('test')
                ->title('Tanggal Tes')
                ->name('test.test_at')
                ->data(["_" => 'test.format', "sort" => 'test.timestamp'])
                ->orderable(true)
                ->searchable(false),

            Column::make('created_at')
                ->title('Tanggal Keluar Hasil')
                ->name('created_at')
                ->data(["_" => 'created_at.format', "sort" => 'created_at.timestamp'])
                ->orderable(true)
                ->searchable(false),

            Column::make('action')
                ->title('Aksi')
                ->orderable(false)
                ->searchable(false)
                ->printable(false),
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
