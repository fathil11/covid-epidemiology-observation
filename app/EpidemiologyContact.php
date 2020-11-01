<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EpidemiologyContact extends Model
{
    protected $dates = [
        'start_at',
        'end_at',
    ];

    public function getJenisKelaminAttribute()
    {
        return $this->gender == 'm' ? 'Laki-laki' : 'Perempuan';
    }
}
