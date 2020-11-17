<?php

namespace App\Http\Controllers;

use App\Test;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showPe()
    {
        $pes = Test::all();
        return view('pe.pe', compact('pes'));
    }
}
