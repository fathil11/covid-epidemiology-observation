<?php

namespace App\Http\Controllers;

use App\DataTables\StatisticPeopleDataTable;
use App\Person;
use App\Test;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index()
    {
        $statistic['positive'] = $this->getPositivePeople()->count();
        $statistic['last_positive'] =$this->getLastWeekPositivePeople()->count();

        $statistic['negative'] = $this->getNegativePeople()->count();
        $statistic['last_negative'] =$this->getLastWeekNegativePeople()->count();

        $statistic['swab_total'] = $this->getTests()->count();
        $statistic['swab_unresulted'] = $this->getUnresultedTests()->count();

        return view('statistics.index', compact('statistic'));
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

        return Person::whereHas('tests', function($query) use ($date){
            return $query->whereDate('created_at', '>=', $date)->whereHas('result', function($query){
                return $query->where('value', 'Positif');
            });
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

        return Person::whereHas('tests', function($query) use ($date){
            return $query->whereDate('created_at', '>=', $date)->whereHas('result', function($query){
                return $query->where('value', 'Negatif');
            });
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
}
