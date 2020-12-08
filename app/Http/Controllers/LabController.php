<?php

namespace App\Http\Controllers;

use App\DataTables\Lab\LabAllTestDataTable;
use App\DataTables\Lab\LabTestResultEntryDataTable;
use App\Result;
use App\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LabController extends Controller
{
    public function showPe(LabTestResultEntryDataTable $dataTable)
    {
        return $dataTable->render('datatables.index', [
            'title' => 'Data PE',
            'sub_title' => 'Daftar PE yang belum mendapatkan hasil',
        ]);
    }

    public function showAllPe(LabAllTestDataTable $dataTable)
    {
        return $dataTable->render('datatables.index', [
            'title' => 'Data PE',
            'sub_title' => 'Daftar seluruh PE',
        ]);
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
