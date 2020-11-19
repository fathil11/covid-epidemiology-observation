<?php

namespace App\DataTables;

use App\User;
use App\Person;
use Illuminate\Support\Str;
use App\App\StatisticPerson;
use App\Result;
use App\Test;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class StatisticPeopleDataTable extends DataTable
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
            ->editColumn('test.person.name', function($result){
                return '<b>' . Str::title($result->test->person->name) . "</b><br>{$result->test->person->nik}";
            })
            ->editColumn('created_at', function($result){
                    return [
                        'format' => $result->created_at->isoFormat('DD MMMM Y'),
                        'timestamp' => $result->created_at->timestamp,
                    ];
            })
            ->editColumn('test.created_at', function($result){
                    return [
                        'format' => $result->test->created_at->isoFormat('DD MMMM Y'),
                        'timestamp' => $result->test->created_at->timestamp,
                    ];
            })
            ->rawColumns(['test.person.name'])
            ->addColumn('action', 'statisticpeople.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\StatisticPerson $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $model = Result::where('value', $this->getResult())->with(['test', 'test.person'])->select('results.*');
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
                    ->setTableId('statisticpeople-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('flrtip')
                    ->orderBy(3)
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
            Column::make('test.person.nik')
                ->title('NIK')
                ->type('string')
                ->visible(false)
                ->orderable(false),
            Column::make('test.person.name')
                ->name('test.person.name')
                ->title('Nama')
                ->printable(false),
            Column::make('test.created_at')
                ->data(["_" => 'test.created_at.format', "sort" => 'test.created_at.timestamp'])
                ->title('Tanggal SWAB')
                ->orderable(true)
                ->searchable(false),
            Column::make('created_at')
                ->data(["_" => 'created_at.format', "sort" => 'created_at.timestamp'])
                ->title('Tanggal Hasil')
                ->orderable(true)
                ->searchable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'StatisticPeople_' . date('YmdHis');
    }

    public function getResult()
    {
        $lists = [
            'positive' => 'Positif',
            'negative' => 'Negatif',
        ];

        return $lists[$this->result];
    }

    public function getTitle()
    {
        $lists = [
            'positive' => 'Konfirmasi',
            'negative' => 'Negatif',
        ];

        return $lists[$this->result];
    }
}
