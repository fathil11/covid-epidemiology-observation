<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusLog extends Model
{
    protected $guarded = [];
    public function test()
    {
        return $this->belongsTo(Test::class);
    }

}
