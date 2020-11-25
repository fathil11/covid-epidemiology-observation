<?php

namespace App\Http\Controllers;

use App\Test;
use App\Person;
use App\Result;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Fathilarhm\GsheetsCollection;
use Illuminate\Database\Eloquent\Builder;

class TriggerController extends Controller
{
    public function storePeopleData() {
        $datas = GsheetsCollection::url('https://docs.google.com/spreadsheets/d/1kMfESbeUvt05hO2e81g1HYOJnEqx00m-JFxaOUTLTJM/edit#gid=0')->get();

        foreach ($datas as $data) {
            $person = Person::find($data['No']);

            if($person == null){
                $person = new Person();
            }

            $person->id = $data['No'];

            // Admin User
            $person->user_id = 1;

            $person->nationality = 'wni';

            if($person->nik == null){
                $person->nik = $data['NIK'];
            }
            if($person->name == null){
                $person->name = Str::upper($data['Nama']);
            }

            $person->phone = null;

            if($person->gender == null){
                $person->gender = $data['Jenis Kelamin'] == 'L' ? "m" : "f";
            }

            $person->parent_name = null;

            $person->card_path = null;

            if($person->work == null){
                $person->work = Str::lower($data['PEKERJAAN']);
            }

            $person->work_instance = null;

            if($person->birth_regency == null){
                $person->birth_regency = Str::upper($data['Tempat Lahir']);
            }

            if($person->birth_at == null && $data['Tanggal Lahir'] != null){
                $person->birth_at = Carbon::createFromFormat('m/d/Y', $data['Tanggal Lahir']);
            }

            if($person->card_province == null){
                $person->card_province = Str::lower($data['Provinsi KTP']);
            }
            if($person->card_regency == null){
                $person->card_regency = Str::lower($data['Kota/Kabupaten KTP']);
            }
            if($person->card_district == null){
                $person->card_district = Str::lower($data['Kecamatan KTP']);
            }
            if($person->card_village == null){
                $person->card_village = Str::lower($data['Desa KTP']);
            }
            if($person->card_street == null){
                $person->card_street = Str::upper($data['Alamat KTP']);
            }
            if($person->card_rt == null){
                $person->card_rt = $data['RT KTP'];
            }
            if($person->card_rw == null){
                $person->card_rw = $data['RW KTP'];
            }
            $person->save();
            echo $person->id . ' | <br>';
        }

        echo 'Success :)';
    }

    public function storeTestData()
    {
        $datas = GsheetsCollection::url('https://docs.google.com/spreadsheets/d/1_B_dXksWcRzcOvMESbdOoxhRmio-SBiVmcpwkHXH3nk/edit#gid=0')->get();

        foreach($datas as $key => $data){
            if($data['No'] != null){
                $test = new Test();

                // UUID
                $uuid = Uuid::uuid4();
                while(Test::where('code', $uuid)->get()->count() != 0){
                    $uuid = Uuid::uuid4();
                }

                $test->code = $uuid;

                $test->user_id = 1;
                $test->person_id = $data['No'];
                $test->test = 'swab';
                $test->type = 'nasofaring-orofaring';

                $test->criteria = null;

                $test->living_province = Str::lower($data['Provinsi Tinggal']);
                $test->living_regency = Str::lower($data['Kota/Kabupaten Tinggal']);
                $test->living_district = Str::lower($data['Kecamatan Tinggal']);
                $test->living_village = Str::lower($data['Desa Tinggal']);
                $test->living_street = null;
                $test->living_rt = null;
                $test->living_rw = null;
                $test->location = "external";
                $test->tube_code = null;
                $test->group_code = null;

                $test->created_at = Carbon::createFromFormat('d/m/Y', $data['Tanggal Swab 1']);

                if($test->save(['timestamps' => false])){
                    echo $data['No'] . '| ';
                    if($key%10 == 0){
                        echo '<br>';
                    }
                }

                if($data['No HP'] != null){
                    $person = Person::find($data['No']);
                    $person->phone = $data['No HP'];
                    $person->save();
                }

                if($data['Hasil 1'] != 'SWAB'){
                    $result = new Result();
                    $result->test_id = $test->id;
                    $result->value = Str::lower($data['Hasil 1']);

                    if($data['Tanggal Hasil 1'] != null){
                        $result->created_at = Carbon::createFromFormat('d/m/Y', $data['Tanggal Hasil 1']);
                    }else{
                        $result->created_at = Carbon::createFromFormat('d/m/Y', $data['Tanggal Swab 1']);
                    }

                    $result->save(['timestamps' => false]);
                }
            }
        }
    }

    public function storeSecondTestData()
    {
        $datas = GsheetsCollection::url('https://docs.google.com/spreadsheets/d/1_B_dXksWcRzcOvMESbdOoxhRmio-SBiVmcpwkHXH3nk/edit#gid=0')->get();

        foreach($datas as $key => $data){
            if($data['No'] != null){
                if($data['Tanggal Swab 2'] != null){
                    $test = new Test();

                    // UUID
                    $uuid = Uuid::uuid4();
                    while(Test::where('code', $uuid)->get()->count() != 0){
                        $uuid = Uuid::uuid4();
                    }

                    $test->code = $uuid;

                    $test->user_id = 1;
                    $test->person_id = $data['No'];
                    $test->test = 'swab';
                    $test->type = 'nasofaring-orofaring';

                    $test->criteria = null;

                    $test->living_province = Str::lower($data['Provinsi Tinggal']);
                    $test->living_regency = Str::lower($data['Kota/Kabupaten Tinggal']);
                    $test->living_district = Str::lower($data['Kecamatan Tinggal']);
                    $test->living_village = Str::lower($data['Desa Tinggal']);
                    $test->living_street = null;
                    $test->living_rt = null;
                    $test->living_rw = null;
                    $test->location = "external";
                    $test->tube_code = null;
                    $test->group_code = null;

                    $test->created_at = Carbon::createFromFormat('d/m/Y', $data['Tanggal Swab 2']);

                    if($test->save(['timestamps' => false])){
                        echo $data['No'] . '| ';
                        if($key%10 == 0){
                            echo '<br>';
                        }
                    }

                    if($data['No HP'] != null){
                        $person = Person::find($data['No']);
                        $person->phone = $data['No HP'];
                        $person->save(['timestamps' => false]);
                    }

                    if($data['Hasil 2'] != 'SWAB'){
                        $result = new Result();
                        $result->test_id = $test->id;
                        $result->value = Str::lower($data['Hasil 2']);

                        if($data['Tanggal Hasil 2'] != null){
                            $result->created_at = Carbon::createFromFormat('d/m/Y', $data['Tanggal Hasil 2']);
                        }else{
                            $result->created_at = Carbon::createFromFormat('d/m/Y', $data['Tanggal Swab 2']);
                        }

                        $result->save(['timestamps' => false]);
                    }
                }
            }
        }
    }

    public function storeThirthTestData()
    {
        $datas = GsheetsCollection::url('https://docs.google.com/spreadsheets/d/1_B_dXksWcRzcOvMESbdOoxhRmio-SBiVmcpwkHXH3nk/edit#gid=0')->get();

        foreach($datas as $key => $data){
            if($data['No'] != null){
                if($data['Tanggal Swab 3'] != null){
                    $test = new Test();

                    // UUID
                    $uuid = Uuid::uuid4();
                    while(Test::where('code', $uuid)->get()->count() != 0){
                        $uuid = Uuid::uuid4();
                    }

                    $test->code = $uuid;

                    $test->user_id = 1;
                    $test->person_id = $data['No'];
                    $test->test = 'swab';
                    $test->type = 'nasofaring-orofaring';

                    $test->criteria = null;

                    $test->living_province = Str::lower($data['Provinsi Tinggal']);
                    $test->living_regency = Str::lower($data['Kota/Kabupaten Tinggal']);
                    $test->living_district = Str::lower($data['Kecamatan Tinggal']);
                    $test->living_village = Str::lower($data['Desa Tinggal']);
                    $test->living_street = null;
                    $test->living_rt = null;
                    $test->living_rw = null;
                    $test->location = "external";
                    $test->tube_code = null;
                    $test->group_code = null;

                    $test->created_at = Carbon::createFromFormat('d/m/Y', $data['Tanggal Swab 3']);

                    if($test->save(['timestamps' => false])){
                        echo $data['No'] . '| ';
                        if($key%10 == 0){
                            echo '<br>';
                        }
                    }

                    if($data['No HP'] != null){
                        $person = Person::find($data['No']);
                        $person->phone = $data['No HP'];
                        $person->save(['timestamps' => false]);
                    }

                    if($data['Hasil 3'] != 'SWAB'){
                        $result = new Result();
                        $result->test_id = $test->id;
                        $result->value = Str::lower($data['Hasil 3']);

                        if($data['Tanggal Hasil 3'] != null){
                            $result->created_at = Carbon::createFromFormat('d/m/Y', $data['Tanggal Hasil 3']);
                        }else{
                            $result->created_at = Carbon::createFromFormat('d/m/Y', $data['Tanggal Swab 3']);
                        }

                        $result->save(['timestamps' => false]);
                    }
                }
            }
        }
    }

    public function showStat()
    {
        $people = Person::whereHas('tests.result', function($q){
            return $q->where('value', 'Positif');
        })->orderBy('name')->get();

        foreach ($people as $key => $value) {
            echo(($key+1) . '. ' . $value->name  . '|' . $value->id . '<br>');
        }

    }

    public function updateTestAt()
    {
        $tests = Test::all();
        foreach ($tests as $key => $test) {
            $test->test_at = $test->created_at;
            $test->save();
        }
        dd('Success');
    }

    public function updateAllEntitiesCase()
    {
        $people = Person::all();
        foreach ($people as $key => $person) {
            $person->name = Str::upper($person->name);
            $person->work = Str::lower($person->work);
            $person->birth_regency = Str::lower($person->birth_regency);
            $person->card_province = Str::lower($person->card_province);
            $person->card_regency = Str::lower($person->card_regency);
            $person->card_district = Str::lower($person->card_district);
            $person->card_village = Str::lower($person->card_village);
            $person->card_street = Str::upper($person->card_street);
            $person->save();
        }

    }

}
