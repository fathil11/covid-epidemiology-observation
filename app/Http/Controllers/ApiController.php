<?php

namespace App\Http\Controllers;

use App\District;
use App\Person;
use App\Province;
use App\Regency;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function provinces()
    {
        $provinces = Province::all();
        return $provinces;
    }

    public function allRegencies()
    {
        return Regency::all();
    }

    public function regencies($province)
    {
        $province = Province::where('name', $province)->firstOrFail();
        return $province->regencies;
    }

    public function districts($regency)
    {
        $regency = Regency::where('name', $regency)->firstOrFail();
        return $regency->districts;
    }

    public function villages($districts)
    {
        $district = District::where('name', $districts)->firstOrFail();
        return $district->villages;
    }

    public function nikIsExists($nik)
    {
        $person = Person::where('nik', $nik)->first();
        if($person != null){
            return $person;
        }else{
            return 0;
        }
    }
}
