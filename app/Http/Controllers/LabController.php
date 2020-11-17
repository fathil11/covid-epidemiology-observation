<?php

namespace App\Http\Controllers;

use App\Result;
use App\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LabController extends Controller
{
    public function showPe()
    {
        $pes = Test::with('person')->doesntHave('result')->get();
        return view('lab.pe', compact('pes'));
    }

    public function showAllPe()
    {
        $pes = Test::with('person')->get();
        return view('lab.pe', compact('pes'));
    }

    public function positive($code)
    {
        $pe = Test::where('code', $code)->firstOrFail();

        if($pe->result == null){
            $result = new Result();
        }else{
            $result = $pe->result;
        }
        $result->test_id = $pe->id;
        $result->value = "positif";
        $result->doctor = Auth::user()->name;

        if($result->save()){
            Alert::success('Yeay', "Berhasil memeberikan hasil POSITIF kepada pasien dengan nomor tabung {$pe->tube_code}, atas nama {$pe->person->name}");
            return redirect()->back();
        }else{
            Alert::error('Ups,', "Terjadi kesalahan, silahkan coba kembali");
            return redirect()->back();

        }
    }

    public function negative($code)
    {
        $pe = Test::where('code', $code)->firstOrFail();

        if($pe->result == null){
            $result = new Result();
        }else{
            $result = $pe->result;
        }
        $result->test_id = $pe->id;
        $result->value = "negatif";
        $result->doctor = Auth::user()->name;

        if($result->save()){
            Alert::success('Yeay', "Berhasil memeberikan hasil NEGATIF kepada pasien dengan nomor tabung {$pe->tube_code}, atas nama {$pe->person->name}");
            return redirect()->back();
        }else{
            Alert::error('Ups,', "Terjadi kesalahan, silahkan coba kembali");
            return redirect()->back();

        }
    }

    public function retire($code)
    {
        $pe = Test::where('code', $code)->firstOrFail();

        if($pe->result == null){
            Alert::error('Ups,', "Pasien memang belum mendapatkan hasil");
            return redirect()->back();
        }else{
            $result = $pe->result;
        }

        if($result->delete()){
            Alert::success('Yeay', "Berhasil menarik hasil {$result->result} kepada pasien dengan nomor tabung {$pe->tube_code}, atas nama {$pe->person->name}");
            return redirect()->back();
        }else{
            Alert::error('Ups,', "Terjadi kesalahan, silahkan coba kembali");
            return redirect()->back();
        }
    }


}
