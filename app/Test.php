<?php

namespace App;

use Carbon\Carbon;
use EpidemiologyDiagnoseSeeder;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test extends Model
{

    protected $dates = [
        'test_at',
    ];

    protected $guarded = [];

    public static function boot(){
        parent::boot();

        static::deleting(function($test){
            $test->symptoms()->delete();
            $test->comorbidities()->delete();
            $test->diagnoses()->delete();
            $test->hospital()->delete();
            $test->travels()->delete();
            $test->contacts()->delete();
            $test->additional()->delete();
            $test->protectors()->delete();
            $test->result()->delete();
        });
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function symptoms()
    {
        return $this->hasMany(EpidemiologySymptom::class);
    }

    public function comorbidities()
    {
        return $this->hasMany(EpidemiologyComorbidity::class);
    }

    public function diagnoses()
    {
        return $this->hasMany(EpidemiologyDiagnose::class);
    }

    public function hospital()
    {
        return $this->hasOne(EpidemiologyHospital::class);
    }

    public function travels()
    {
        return $this->hasMany(EpidemiologyTravel::class);
    }

    public function contacts()
    {
        return $this->hasMany(EpidemiologyContact::class);
    }

    public function additional()
    {
        return $this->hasOne(EpidemiologyAdditional::class);
    }

    public function protectors()
    {
        return $this->hasMany(EpidemiologyProtector::class);
    }

    public function result()
    {
        return $this->hasOne(Result::class);
    }

    public function getInternationalTravelsAttribute()
    {
        return $this->travels->where('type', 'international');
    }

    public function getDomesticTravelsAttribute()
    {
        return $this->travels->where('type', 'domestic');
    }

    public function getLivingTravelsAttribute()
    {
        return $this->travels->where('type', 'living');
    }

    public function getNormalContactsAttribute()
    {
        return $this->contacts->where('type', 'normal');
    }

    public function getCloseContactsAttribute()
    {
        return $this->contacts->where('type', 'close');
    }

    public function getSymptomsListAttribute()
    {
        $list = '';

        foreach ($this->symptoms as $key => $value) {
            if($value->value != 'else'){
                $list .= Str::title($value->value);
            }

            if($value->sub_value != null){
                $list .= ' ('. $value->sub_value . ')';
            }

            if($key != ($this->symptoms->count()-1)){
                $list .= ', ';
            }
        }

        return $list;
    }

    public function getComorbiditiesListAttribute()
    {
        $list = '';

        foreach ($this->comorbidities as $key => $value) {
            if($value->value != 'else'){
                $list .= Str::title($value->value);
            }

            if($value->sub_value != null){
                $list .= ' ('. $value->sub_value . ')';
            }

            if($key != ($this->comorbidities->count()-1)){
                $list .= ', ';
            }
        }

        return $list;
    }

    public function getDiagnosesListAttribute()
    {
        $list = '';

        foreach ($this->diagnoses as $key => $value) {
            if($value->value != 'else'){
                $list .= Str::title($value->value);
            }

            if($value->sub_value != null){
                $list .= ' ('. $value->sub_value . ')';
            }

            if($key != ($this->diagnoses->count()-1)){
                $list .= ', ';
            }
        }

        return $list;
    }

    public function getProtectorsListAttribute()
    {
        $list = '';

        foreach ($this->protectors as $key => $value) {
            $list .= Str::title($value->value);

            if($key != ($this->protectors->count()-1)){
                $list .= ', ';
            }
        }

        return $list;
    }

    public function getCriteriaAttribute($value)
    {
        return Str::title($value);
    }

    public function getGroupCodeAttribute($value)
    {
        return $value == '' ? '-' : $value;
    }

    // public function getLocationAttribute($value)
    // {
    //     return $value == 'internal' ? 'Lab KESDA' : Str::title($value);
    // }

    public function getTestAttribute($value)
    {
        return Str::upper($value);
    }

    public function getTypeAttribute($value)
    {
        return Str::title($value);
    }

    public function getLivingProvinceAttribute($value)
    {
        return Str::title($value);
    }

    public function getLivingRegencyAttribute($value)
    {
        return Str::title($value);
    }

    public function getLivingDistrictAttribute($value)
    {
        return Str::title($value);
    }

    public function getLivingVillageAttribute($value)
    {
        return Str::title($value);
    }

}
