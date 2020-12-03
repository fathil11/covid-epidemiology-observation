<?php

namespace App\DataTables\Pe;

use App\Test;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Person;
use Carbon\Carbon;

class PeTestDataTable extends DataTable
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

            //* TEST SECTION
            ->editColumn('cito', function(Test $test){
                return $test->cito ? 'CITO' : '';
            })
            ->addColumn('created_at_print', function(Test $test){
                return $test->created_at->isoFormat('DD MMMM Y');
            })
            ->addColumn('created_at_display', function(Test $test){
                return [
                    'format' => $test->created_at->isoFormat('DD MMMM Y'),
                    'timestamp' => $test->created_at->timestamp,
                ];
            })

            //* PERSON SECTION
            ->editColumn('person.nik', function(Test $test){
                return $test->person->nik != null ? "'" . $test->person->nik : '';
            })
            ->editColumn('person.name_modified', function(Test $test){
                return '<b>' . Str::title($test->person->name) . "</b><br>{$test->person->nik}";
            })
            ->editColumn('person.gender', function(Test $test){
                return $test->person->gender == 'm' ? 'Laki-laki' : 'Perempuan';
            })
            ->editColumn('person.birth_at', function(Test $test){
                return $test->person->birth_at != null ? $test->person->birth_at->isoFormat('DD MMMM Y') : '';
            })

            //* USER SECTION
            ->addColumn('user.instance', function(Test $test){
                return $test->user->instance;
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
        $model = Test::with(['person', 'user']);
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
                    ->orderBy(14, 'desc')
                    ->buttons(
                        Button::make('excel')
                        ->text('Download Excel')
                        ->customize(''),
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
            Column::make('tube_code')
                ->title('Nomor Tabung')
                ->visible(false),
            Column::make('person.name_modified')
                ->name('person.name')
                ->exportable(false)
                ->printable(false)
                ->title('Nama (NIK)'),
            Column::make('person.name')
                ->title('Nama')
                ->visible(false),
            Column::make('person.nik')
                ->name('person.nik')
                ->title('NIK')
                ->visible(false),
            Column::make('person.phone')
                ->name('person.phone')
                ->title('Nomor HP')
                ->visible(false),
            Column::make('person.gender')
                ->title('Jenis Kelamin'),
            Column::make('person.birth_at')
                ->title('Tanggal Lahir')
                ->visible(false),
            Column::make('living_province')
                ->title('Provinsi')
                ->visible(false),
            Column::make('living_regency')
                ->title('Kota/Kabupaten')
                ->visible(false),
            Column::make('living_district')
                ->title('Kecamatan')
                ->visible(false),
            Column::make('living_village')
                ->title('Desa')
                ->visible(false),
            Column::make('living_street')
                ->title('Alamat')
                ->visible(false),
            Column::make('living_rt')
                ->title('RT')
                ->visible(false),
            Column::make('living_rw')
                ->title('RW')
                ->visible(false),
            Column::make('created_at_display')
                ->title('Tanggal PE')
                ->name('created_at')
                ->data(["_" => 'created_at_display.format', "sort" => 'created_at_display.timestamp'])
                ->orderable(true)
                ->searchable(true)
                ->printable(false)
                ->exportable(false),
            Column::make('created_at_print')
                ->title('Tanggal PE')
                ->visible(false),
            Column::make('type')
                ->title('Jenis SWAB')
                ->visible(false),
            Column::make('user.instance')
                ->title('Asal Sampel')
                ->visible(false),
            Column::make('criteria')
                ->title('Alasan SWAB')
                ->visible(false),
            Column::make('cito')
                ->title('Prioritas')
                ->visible(false),
            Column::computed('action')
                ->title('Aksi')
                ->addClass('text-center')
                ->exportable(false)
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
        return 'Test_' . date('YmdHis');
    }
}
