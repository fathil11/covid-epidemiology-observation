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

            //* RESULT SECTION
            ->addColumn('result_at_display', function($test){
                return [
                    'format' => $test->result->created_at->isoFormat('DD MMMM Y'),
                    'timestamp' => $test->result->created_at->timestamp,
                ];
            })
            ->addColumn('result_at_print', function($test){
                return $test->result->created_at->isoFormat('DD MMMM Y');
            })

            //* TEST SECTION
            ->editColumn('test_at_display', function($test){
                return [
                    'format' => $test->test_at != '' ? $test->test_at->isoFormat('DD MMMM Y') : '',
                    'timestamp' => $test->test_at != '' ? $test->test_at->timestamp : '',
                ];
            })
            ->addColumn('test_at_print', function($test){
                return $test->test_at != '' ? $test->test_at->isoFormat('DD MMMM Y') : '';
            })

            //* STATUS LOG SECTION
            ->addColumn('status_display', function($test){
                return $test->latestLog != null ? Str::title($test->latestLog->value) : 'Isolasi';
            })
            ->setRowClass(function($test){
                if($test->latestLog == null){
                    return 'text-danger';
                }else{
                    if($test->latestLog->value == 'sembuh'){
                        return 'text-success';
                    }elseif($test->latestLog->value == 'meninggal'){
                        return 'text-secondary';
                    }
                }
            })

            ->addColumn('action', function($test){
                $isolate_btn = '<a href="' . route('admin.status.isolate', $test->code) . '" class="btn btn-danger mr-2">Isolasi</a>';
                $recover_btn = '<a href="' . route('admin.status.recover', $test->code) . '" class="btn btn-success mr-2">Sembuh</a>';
                $die_btn = '<a href="' . route('admin.status.die', $test->code) . '" class="btn btn-secondary mr-2">Meninggal</a>';

                if($test->latestLog == null){
                    return $recover_btn . $die_btn;
                }else{
                    if($test->latestLog->value == 'sembuh'){
                        return $isolate_btn . $die_btn;
                    }elseif($test->latestLog->value == 'meninggal'){
                        return $isolate_btn . $recover_btn;
                    }
                }
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
        })->select(['tests.*']);
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
                    ->orderBy(8, 'asc')
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
                ->title('NIK')
                ->name('person.nik')
                ->visible(false),

            Column::make('person.name')
                ->title('Nama')
                ->name('person.name')
                ->visible(false),

            Column::make('person_display')
                ->title('Nama')
                ->name('person.name')
                ->printable(false)
                ->exportable(false),

            Column::make('person_gender')
                ->title('Jenis Kelamin')
                ->name('person.gender'),

            Column::make('test_at')
                ->title('Tanggal Tes')
                ->name('test_at')
                ->data(["_" => 'test_at_display.format', "sort" => 'test_at_display.timestamp'])
                ->orderable(true)
                ->searchable(true)
                ->printable(false)
                ->exportable(false),

            Column::make('test_at_print')
                ->title('Tanggal Tes')
                ->name('created_at')
                ->visible(false),

            Column::make('result_at_display')
                ->title('Tanggal Hasil')
                ->name('result.created_at')
                ->data(["_" => 'result_at_display.format', "sort" => 'result_at_display.timestamp'])
                ->orderable(true)
                ->searchable(true)
                ->printable(false)
                ->exportable(false),

            Column::make('result_at_print')
                ->title('Tanggal Hasil')
                ->name('result.created_at')
                ->visible(false),

            Column::make('status_display')
                ->title('Status')
                ->name('latestLog.value'),

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
        return 'AdminStatus_' . date('YmdHis');
    }
}
