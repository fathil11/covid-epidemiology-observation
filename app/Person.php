<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $dates = [
        'birth_at',
    ];


    public function getAgeAttribute()
    {
        return Carbon::make($this->birth_at)->age;
    }

    public function getJenisKelaminAttribute()
    {
        return ($this->gender=='m' ? 'Laki-laki' : 'Perempuan');
    }

    public function getCardProvinceAttribute($value)
    {
        return Str::title($value);
    }

    public function getCardRegencyAttribute($value)
    {
        return Str::title($value);
    }

    public function getCardDistrictAttribute($value)
    {
        return Str::title($value);
    }

    public function getCardVillageAttribute($value)
    {
        return Str::title($value);
    }
}
