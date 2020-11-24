<?php

namespace App\Http\Controllers;

use App\DataTables\ResultDataTable;
use App\Result;
use App\Test;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showPe()
    {
        $pes = Test::all();
        return view('pe.pe', compact('pes'));
    }

    public function showAllResults(ResultDataTable $dataTable)
    {
        return $dataTable->render('admin.results');
    }
}
