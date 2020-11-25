<?php

namespace App\DataTables;

use App\Test;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AdminTestDataTable extends DataTable
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
            ->addColumn('person_name', function($test){
                return Str::title($test->person->name);
            })
            ->addColumn('person_gender', function($test){
                return $test->person->gender == 'm' ? 'Laki-laki' : 'Perempuan';
            })

            //* TEST SECTION
            ->addColumn('created_at_display', function(Test $test){
                return [
                    'format' => $test->created_at->isoFormat('DD MMMM Y'),
                    'timestamp' => $test->created_at->timestamp,
                ];
            })

            //* RESULT SECTION
            ->addColumn('result', function($test){
                return $test->result;
            })
            ->addColumn('result_value', function($test){
                if($test->result != null){
                    return $test->result->value == 'negatif' ? 'Negatif' : 'Positif';
                }
                return '';
            })
            ->addColumn('result_created_at_display', function(Test $test){
                return [
                    'format' => $test->result != null ? $test->result->created_at->isoFormat('DD MMMM Y') : '',
                    'timestamp' => $test->result != null ? $test->result->created_at->timestamp : '',
                ];
            })
            ->addColumn('action', function($test){
                $positive_btn = '<a href="' . route('admin.pe.result.positive', $test->code) . '" class="btn btn-danger mr-2"><p class="mb-0">+</p></a>';
                $negative_btn = '<a href="' . route('admin.pe.result.negative', $test->code) . '" class="btn btn-success mr-2"><p class="mb-0">-</p></a>';
                $delete_btn = '';
                if($test->result != null){
                    $delete_btn = '<a href="' . route('admin.pe.result.delete', $test->code) . '" class="btn btn-secondary mr-2"><p class="mb-0">x</p></a>';
                }
                return $positive_btn . $negative_btn . $delete_btn;
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\AdminTest $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $model = Test::with(['person', 'result'])->select('tests.*');
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
                    ->setTableId('admintest-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Blfrtip')
                    ->orderBy(2)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
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
                ->title('Id'),
            Column::make('person_name')
                ->title('Nama')
                ->name('person.name'),
            Column::make('person_gender')
                ->title('Jenis Kelamin')
                ->name('person.gender'),
            Column::make('created_at_display')
                ->title('Tanggal SWAB')
                ->name('created_at')
                ->data(["_" => 'created_at_display.format', "sort" => 'created_at_display.timestamp'])
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
            Column::make('result_value')
                ->title('Hasil')
                ->name('result.value'),
            Column::make('action')
                ->title('Aksi')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'AdminTest_' . date('YmdHis');
    }
}
