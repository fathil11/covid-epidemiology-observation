<?php

namespace App\Http\Controllers;

use App\Test;
use App\Person;
use App\Result;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\DataTables\ResultDataTable;
use App\DataTables\AdminTestDataTable;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{

    public function showAllResults(ResultDataTable $dataTable)
    {
        return $dataTable->render('datatables.index', [
            'title' => 'Daftar Hasil PE',
            'sub_title' => 'Seluruh PE yang sudah ada hasil',
        ]);
    }

    public function showAllPe(AdminTestDataTable $dataTable)
    {
        return $dataTable->render('admin.results');
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

    public function showStatistics()
    {
        $districts = [
            'sokan',
            'tanah pinoh',
            'tanah pinoh barat',
            'sayan', 'belimbing',
            'belimbing hulu',
            'nanga pinoh',
            'pinoh selatan',
            'pinoh utara',
            'ella hilir',
            'menukung'
        ];

        $people = Person::with(['tests', 'tests.result'])->get();
        $tests = Test::with(['person', 'result'])->get();

        //! TOTAL
        $statistics['tests_total'] = $tests->count();

        $statistics['positive_total'] = $this->getPeopleStatistic($people, null, null, 'positif');

        $statistics['negative_total'] = $this->getPeopleStatistic($people, null, null, 'negatif');

        $statistics['tests_unresulted_total'] = $tests->filter(function($item){ return (data_get($item, 'test_at') != null && data_get($item, 'result') == null); })->count();
        $statistics['tests_resulted_total'] = $statistics['tests_total'] - $statistics['tests_unresulted_total'];

        //! MELAWI
        $statistics['melawi_tests_total'] = $tests->filter(function ($test){
            return Str::lower($test->living_regency) == 'kabupaten melawi';
        })->count();

        $statistics['melawi_positive_total'] = $this->getPeopleStatistic($people, 'kabupaten melawi', null, 'positif');

        $statistics['melawi_negative_total'] = $this->getPeopleStatistic($people, 'kabupaten melawi', null, 'negatif');

        $statistics['melawi_tests_unresulted_total'] = $tests->filter(function($item){ return (Str::lower(data_get($item, 'living_regency')) == 'kabupaten melawi' && data_get($item, 'test_at') != null && data_get($item, 'result') == null); })->count();
        $statistics['melawi_tests_resulted_total'] = $statistics['melawi_tests_total'] - $statistics['melawi_tests_unresulted_total'];

        //! EXTERNAL
        $statistics['external_tests_total'] = $statistics['tests_total'] - $statistics['melawi_tests_total'];
        $statistics['external_positive_total'] = $statistics['positive_total'] - $statistics['melawi_positive_total'];
        $statistics['external_negative_total'] = $statistics['negative_total'] - $statistics['melawi_negative_total'];
        $statistics['external_tests_unresulted_total'] = $statistics['tests_unresulted_total'] - $statistics['melawi_tests_unresulted_total'];
        $statistics['external_tests_resulted_total'] = $statistics['tests_resulted_total'] - $statistics['melawi_tests_resulted_total'];

        //! DISTRICTS
        foreach ($districts as $district) {
            $statistics[$district.'_tests_total'] = $tests->filter(function ($test) use ($district) {
                return Str::lower($test->living_district) == Str::lower($district);
            })->count();

            $statistics[$district.'_positive_total'] = $this->getPeopleStatistic($people, null, $district, 'positif');

            $statistics[$district.'_negative_total'] = $this->getPeopleStatistic($people, null, $district, 'negatif');

            $statistics[$district.'_tests_unresulted_total'] = $tests->filter(function($item) use ($district) { return (Str::lower(data_get($item, 'living_district')) == $district && data_get($item, 'test_at') != null && data_get($item, 'result') == null); })->count();

            $statistics[$district.'_tests_resulted_total'] = $statistics[$district.'_tests_total'] - $statistics[$district.'_tests_unresulted_total'];
        }

        return view('admin.statistics', compact(['statistics', 'districts']));
    }

    public function getPeopleStatistic($people, $regency, $district, $result)
    {
        $count = 0;

        $people->each(function($item) use (&$count, $regency, $district, $result) {
            $flag = false;

            $item->tests->each(function($item) use (&$flag, $regency, $district, $result) {
                if(!$flag){
                    if($regency != null && Str::lower($item->living_regency) == $regency){
                        $flag = true;
                    }

                    if($district != null && Str::lower($item->living_district) == $district){
                        $flag = true;
                    }

                    if(($flag || ($regency == null && $district == null)) && $item->result != null){
                        if($item->result->value != $result){
                            $flag = false;
                        }else{
                            $flag = true;
                        }
                    }else $flag = false;
                }
            });

            if($flag){
                $count++;
            }
        });

        return $count;
    }


}
