<?php

namespace App\Http\Controllers;

use App\Test;
use App\Person;
use App\Result;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\AdminPeUpdateRequest;
use App\DataTables\Admin\AdminTestDataTable;
use App\DataTables\Admin\AdminResultDataTable;

class AdminController extends Controller
{
    public function showAllPe(AdminTestDataTable $dataTable)
    {
        return $dataTable->render('admin.results');
    }

    public function createPe()
    {
        return view('admin.pe-create');
    }

    public function storePe(Request $request)
    {
        dd($request);
    }

    public function editPe($code)
    {
        $test = Test::with(['person'])->where('code', $code)->firstOrFail();
        return view('admin.pe-edit', compact('test'));
    }

    public function updatePe(AdminPeUpdateRequest $request, $code)
    {
        $test = Test::with(['person'])->where('code', $code)->firstOrFail();
        $request->validated();

        $person = $test->person;

        $person->user_id = Auth::user()->id;

        $person->nik = $request->nik;
        $person->name = Str::title($request->name);
        $person->phone = $request->phone;
        $person->gender = $request->gender;

        // Store Person ID Card File
        if($request->file('id_card_file') != null){
            $path = $request->file('id_card_file')->store('public/id_cards');

            $path_proc = explode('/',$path);
            $file_path = end($path_proc);

            // Store Person ID Card File Path
            $person->card_path = $file_path;
        }

        $person->birth_regency = Str::upper($request->birth_regency);
        $person->birth_at = Carbon::make($request->birth_at);
        $person->parent_name = Str::upper($request->parent_name);
        $person->work = Str::upper($request->work);
        $person->work_instance = Str::upper($request->work_instance);
        $person->card_province = Str::lower($request->card_province);
        $person->card_regency = Str::lower($request->card_regency);
        $person->card_district = Str::lower($request->card_district);
        $person->card_village = Str::lower($request->card_village);
        $person->card_street = Str::upper($request->card_street);
        $person->card_rt = $request->card_rt;
        $person->card_rw = $request->card_rw;

        if($person->save()){
            $test->living_province = Str::lower($request->living_province);
            $test->living_regency = Str::lower($request->living_regency);
            $test->living_district = Str::lower($request->living_district);
            $test->living_village = Str::lower($request->living_village);
            $test->living_street = Str::upper($request->living_street);
            $test->living_rt = $request->living_rt;
            $test->living_rw = $request->living_rw;

            $test->test_at = Carbon::make($request->test_at);
            $test->cito = $request->swab_priority == 'Cito';
            $test->type = Str::lower($request->swab_type);
            $test->location = Str::lower($request->swab_location);
            $test->note = Str::upper($request->note);

            $test->result->created_at = Carbon::make($request->result_at);

            if($test->save() && $test->result->save()){
                Alert('Hore', 'Berhasil merubah data Pasien dan PE', 'success');
                return redirect()->back();
            }
            return abort(501);
        }
        return abort(501);
    }

    public function deletePe($code)
    {
        $test = Test::where('code', $code)->firstOrFail();
        if($test->delete()){
            Alert('Jos', 'Berhasil menghapus data PE', 'success');
            return redirect()->back();
        }
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
