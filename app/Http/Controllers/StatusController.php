<?php

namespace App\Http\Controllers;

use App\DataTables\Admin\AdminStatusDataTable;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index(AdminStatusDataTable $dataTable)
    {
        return $dataTable->render('datatables.index', [
            'title' => 'Data Status Konfirmasi',
            'sub_title' => 'Menu pengaturan status pasien'
        ]);
    }
}
