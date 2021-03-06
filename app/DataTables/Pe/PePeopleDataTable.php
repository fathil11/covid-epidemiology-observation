<?php

namespace App\DataTables\Pe;

use App\Person;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;


class PePeopleDataTable extends DataTable
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
            ->addColumn('action', function($person){
                $next_btn = '<a href="' . route('registration.person.edit', ['id'=>$person->id]) . '" class="btn btn-warning mr-2">Edit</a>';
                $edit_btn = '<a href="' . route('registration.pe.create.check', ['id'=>$person->id]) . '" class="btn btn-success">Lanjutkan</a>';
                return $next_btn . $edit_btn;
            })
            ->addColumn('latestTest', function($person){
                if($person->latestTest != null){
                    return $person->latestTest->test_at != null ? $person->latestTest->test_at->isoFormat('D MMMM Y') : '';
                }
                return '';
            })
            ->addColumn('name_display', function(Person $person){
                return '<b>' . Str::title($person->name) . "</b><br>{$person->nik}";
            })
            ->editColumn('gender', function ($person) {
                return $person->gender == 'm' ? "Laki-laki" : "Perempuan";
            })
            ->rawColumns(['action', 'name_display']);
        }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\Person $model
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public function query()
    {
        $model = Person::with(['latestTest', 'tests']);
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
                    ->setTableId('people-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->responsive(true)
                    ->dom('lfrtip');
    }

    /**
     * Get columns.->created_at->format('d/m/Y')
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('name_display')
                ->title('Nama')
                ->name('name')
                ->responsivePriority(1),
            Column::make('gender')
                ->title('Jenis Kelamin'),
            Column::make('latestTest')
                ->title('Tanggal Terakhir SWAB')
                ->name('latestTest.created_at')
                ->addClass('text-center')
                ->orderable(false)
                ->searchable(false)
                ->responsivePriority(2),
            Column::make('nik')
                ->title('NIK')
                ->visible(false)
                ->orderable(false),
            Column::make('action')
                ->searchable(false)
                ->orderable(false)
                ->title('Aksi')
                ->exportable(false)
                ->printable(false)
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'People_' . date('YmdHis');
    }
}
