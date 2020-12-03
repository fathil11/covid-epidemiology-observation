<?php

namespace App\Http\Controllers;

use App\DataTables\Admin\AdminResultDataTable;
use App\DataTables\Admin\AdminTestDataTable;
use App\Test;
use App\Person;
use App\Result;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function showAllPe(AdminTestDataTable $dataTable)
    {
        return $dataTable->render('admin.results');
    }

    public function showAllResults(AdminResultDataTable $dataTable)
    {
        return $dataTable->render('datatables.index', [
            'title' => 'Daftar Hasil PE',
            'sub_title' => 'Seluruh PE yang sudah ada hasil',
        ]);
    }

    public function positiveTestResult($code)
    {
        $test = Test::where('code', $code)->firstOrFail();
        $result = new Result();
        if($test->result != null){
            $result = $test->result;
        }

        $result->test_id = $test->id;
        $result->value = 'positif';
        $result->save();
        Alert('Hore', 'Berhasil merubah hasil pasien', 'success');
        return redirect()->back();
    }

    public function negativeTestResult($code)
    {
        $test = Test::where('code', $code)->firstOrFail();
        $result = new Result();
        if($test->result != null){
            $result = $test->result;
        }

        $result->test_id = $test->id;
        $result->value = 'negatif';
        $result->save();
        Alert('Hore', 'Berhasil merubah hasil pasien', 'success');
        return redirect()->back();
    }

    public function deleteTestResult($code)
    {
        $test = Test::where('code', $code)->firstOrFail();
        if($test->result != null){
            $result = $test->result;
            $result->delete();
            Alert('Hore', 'Berhasil merubah hasil pasien', 'success');
            return redirect()->back();
        }
        return abort(404);
    }

}
