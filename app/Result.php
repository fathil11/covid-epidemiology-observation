<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $guarded = [];
    protected $dates = [
        'published_at',
    ];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

}
