<?php

namespace App\Http\Controllers;

use App\District;
use App\Person;
use App\Province;
use App\Regency;
use App\Test;
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
        if($districts == 'BELIMBING'){
            $district = District::find(6110040);
        }else{
            $district = District::where('name', $districts)->firstOrFail();
        }
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

    public function idCardIsExists($name)
    {
        $person = Person::where('name', $name)->first();
        if($person->card_path != null){
            return 1;
        }else{
            return 0;
        }
    }

    public function tubeCodeIsExists($code)
    {
        $test = Test::where('tube_code', $code)->first();
        if($test != null){
            return 1;
        }else{
            return 0;
        }
    }
}
