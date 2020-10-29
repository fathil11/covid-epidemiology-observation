<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function showResult($code)
    {
        return view('public.result');
    }
}
