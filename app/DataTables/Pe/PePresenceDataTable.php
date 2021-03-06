<?php

namespace App\DataTables\Pe;

use App\Test;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PePresenceDataTable extends DataTable
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
            ->addColumn('action', 'components.presence.tube-code-entry-action')

            //* TEST SECTION
            ->addColumn('created_at_display', function(Test $test){
                return [
                    'format' => $test->created_at->isoFormat('DD MMMM Y'),
                    'timestamp' => $test->created_at->timestamp,
                ];
            })

            ->addColumn('test_at_display', function(Test $test){
                return [
                    'format' => $test->test_at != null ? $test->test_at->isoFormat('DD MMMM Y') : '',
                    'timestamp' => $test->test_at != null ? $test->test_at->timestamp : '',
                ];
            })

            //* PERSON SECTION
            ->addColumn('name_display', function(Test $test){
                return '<b>' . Str::title($test->person->name) . "</b><br>{$test->person->nik}";
            })

            //* USER SECTION
            ->addColumn('user.instance', function(Test $test){
                return $test->user->instance;
            })

            ->rawColumns(['name_display', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\PePresence $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        /** @var App\User */
        $user = Auth::user();
        if($user->isPe() || $user->isAdmin())
        {
            $model = Test::where('location', 'internal')->whereDate('created_at', '>=', Carbon::now()->subDays(6))->with(['person', 'user'])->select('tests.*');
        }
        elseif($user->isSecondPe())
        {
            $map = [
                "Ulak Muid" => "Tanah Pinoh Barat",
                "Kota Baru" => "Tanah Pinoh",
                "Pemuar" => "Belimbing",
                "Tiong Keranjik" => "Belimbing Hulu",
                "Manggala" => "Pinoh Selatan",
                "Ella" => "Ella Hilir"
            ];

            $district = Auth::user()->instance_place;

            foreach ($map as $key => $value) {
                if(Auth::user()->instance_place == $key){
                    $district = $value;
                }
            }

            $model = Test::where('living_district', $district)->whereDate('created_at', '>=', Carbon::now()->subDays(6))->with(['person', 'user'])->select('tests.*');
        }
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
                    ->setTableId('pepresence-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->responsive(true)
                    ->dom('lfrtip')
                    ->orderBy(2, 'desc');
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
                ->title('Nama (NIK)')
                ->name('person.name')
                ->exportable(false)
                ->printable(false),
            Column::make('tube_code')
                ->title('Nomor Tabung'),
            Column::make('created_at_display')
                ->title('Tanggal PE')
                ->name('created_at')
                ->data(["_" => 'created_at_display.format', "sort" => 'created_at_display.timestamp'])
                ->orderable(true)
                ->searchable(true)
                ->printable(false)
                ->exportable(false),
            Column::make('test_at_display')
                ->title('Tanggal Tes')
                ->name('test_at')
                ->data(["_" => 'test_at_display.format', "sort" => 'test_at_display.timestamp'])
                ->orderable(true)
                ->searchable(false)
                ->printable(false)
                ->exportable(false),
            Column::make('action')
                ->title('Aksi')
                ->searchable(false)
                ->orderable(false)
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
        return 'PePresence_' . date('YmdHis');
    }
}
