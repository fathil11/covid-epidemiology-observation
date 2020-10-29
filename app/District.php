<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public function regency()
    {
        return $this->belongsTo(Regency::class);
    }

    public function villages()
    {
        return $this->hasMany(Village::class);
    }
}
