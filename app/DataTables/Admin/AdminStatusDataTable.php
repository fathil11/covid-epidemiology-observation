<?php

namespace App\DataTables\Admin;

use App\Test;
use App\Person;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AdminStatusDataTable extends DataTable
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
            //* PERSON SECTION
            ->addColumn('person_display', function($test){
                return '<b>' . Str::title($test->person->name) . "</b><br>{$test->person->nik}";
            })
            ->addColumn('person_gender', function($test){
                return $test->person->gender == 'm' ? 'Laki-laki' : 'Perempuan';
            })

            //* PERSON SECTION
            ->addColumn('status_display', function($test){
                return $test->latestLog != null ? Str::title($test->latestLog->value) : '';
            })

            ->rawColumns(['action', 'person_display'])
            ;

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\AdminStatusDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $model = Test::with(['person', 'latestLog'])->withAndWhereHas('result', function($q){
            $q->where('value', 'positif');
        });
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
                    ->setTableId('adminstatusdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('lBfrtip')
                    ->orderBy(0)
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
            Column::make('person.nik')
                ->name('person.nik')
                ->visible(false),
            Column::make('person_display')
                ->title('Nama')
                ->name('person.name'),
            Column::make('person_gender')
                ->title('Jenis Kelamin')
                ->name('person.gender'),
            Column::make('status_display')
                ->title('Status')
                ->name('latestLog.value')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'AdminStatus_' . date('YmdHis');
    }
}
