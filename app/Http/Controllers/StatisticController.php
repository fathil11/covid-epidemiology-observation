<?php

namespace App\Http\Controllers;

use App\Test;
use App\Person;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\DataTables\StatisticPeopleDataTable;

class StatisticController extends Controller
{
    public function index()
    {
        $statistics['positive'] = $this->getPositivePeople()->count();
        $statistics['last_positive'] =$this->getLastWeekPositivePeople()->count();

        $statistics['negative'] = $this->getNegativePeople()->count();
        $statistics['last_negative'] =$this->getLastWeekNegativePeople()->count();

        $statistics['swab_total'] = $this->getTests()->count();
        $statistics['swab_unresulted'] = $this->getUnresultedTests()->count();

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

        return view('statistics.super', compact(['statistics', 'districts']));
    }

    public function showPositivePeople(StatisticPeopleDataTable $dataTable)
    {
        return $dataTable
            ->with(['result' => 'positive'])
            ->render('statistics.people', ['title' => 'Konfirmasi']);
    }

    public function showNegativePeople(StatisticPeopleDataTable $dataTable)
    {
        return $dataTable
            ->with(['result' => 'negative'])
            ->render('statistics.people', ['title' => 'Negatif']);
    }

    //! Positive Section
    public function getPositivePeople()
    {
        return Person::whereHas('tests', function($query){
            return $query->whereHas('result', function($query){
                return $query->where('value', 'Positif');
            });
        })->get();
    }

    public function getLastWeekPositivePeople()
    {
        $date = Carbon::today()->subDays(7);

        return Person::whereHas('tests.result', function($query) use ($date){
            return $query->where('value', 'Positif')->whereDate('created_at', '>=', $date);
        })->get();
    }

    //! Negative Section
    public function getNegativePeople()
    {
        return Person::whereHas('tests', function($query){
            return $query->whereHas('result', function($query){
                return $query->where('value', 'Negatif');
            });
        })->get();
    }

    public function getLastWeekNegativePeople()
    {
        $date = Carbon::today()->subDays(7);

        return Person::whereHas('tests.result', function($query) use ($date){
            return $query->where('value', 'Negatif')->whereDate('created_at', '>=', $date);
        })->get();
    }

    public function getTests()
    {
        return Test::all();
    }

    public function getUnresultedTests()
    {
        return Test::doesntHave('result')->get();
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
