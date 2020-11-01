<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EpidemiologyTravel extends Model
{
    protected $dates = [
        'departure_at',
        'arrive_at',
    ];

}
