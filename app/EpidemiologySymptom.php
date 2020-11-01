<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class EpidemiologySymptom extends Model
{
    protected $dates = [
        'symptom_at',
    ];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}
