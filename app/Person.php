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

    protected $guarded = [];

    public function tests()
    {
        return $this->hasMany(Test::class);
    }

    public function latestTest()
    {
        return $this->hasOne(Test::class)->orderBy('created_at', 'desc')->limit(1);
    }

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

    public function scopeWithAndWhereHas($query, $relation, $callback = null)
    {
        if (is_callable($callback)) {
            return $query->with([$relation => $callback])
                ->whereHas($relation, $callback);
        }

        return $query->with($relation)->has($relation);
    }
}
