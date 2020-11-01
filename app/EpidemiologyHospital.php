<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EpidemiologyHospital extends Model
{
    protected $dates = [
        'start_at',
    ];

    public function getAdditionalAttribute()
    {
        $list = '';
        if($this->icu){
            $list .= "Dirawat di ICU";
        }
        if($this->intubation){
            if($list!=''){
                $list .= ", ";
            }
            $list .= "Intubasi";
        }
        if($this->emco){
            if($list!=''){
                $list .= ", ";
            }
            $list .= "Penggunaan EMCO";
        }
        return $list;
    }
}
