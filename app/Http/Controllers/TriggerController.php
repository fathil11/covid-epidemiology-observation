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
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class TriggerController extends Controller
{
    public function triggerCountCheck()
    {
        $people = Person::whereHas('tests.result', function($q){
            $q->where('value', 'positif');
        })->get();

        dump("Total Positif : " . $people->count());


        $people = Person::whereHas('tests.result', function($q){
            $q->where('value', 'positif');
        })
        ->doesntHave('tests.logs')
        ->get();

        dump("Sedang Isolasi : " . $people->count());


        $people = Person::whereHas('tests.result', function($q){
            $q->where('value', 'positif');
        })
        ->whereHas('tests.logs', function($q){
            $q->where('value', 'meninggal');
        })
        ->get();

        dump("Meninggal : " . $people->count());




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

    public function updatePersonWork()
    {
        $datas = GsheetsCollection::url('https://docs.google.com/spreadsheets/d/1kMfESbeUvt05hO2e81g1HYOJnEqx00m-JFxaOUTLTJM/edit#gid=0')->get();

        $start_at = 1458-2;
        foreach ($datas as $key => $data) {
            if($key >= $start_at){
                $person = Person::find($data['No']);
                dump($person->id);
                $person->work = $data['PEKERJAAN'] != null ? Str::lower($data['PEKERJAAN']) : '';
                dump($person->id . "|" . $person->name . "|" . $person->work);
                $person->save();
            }
        }
    }

    public function triggerResultPublishedAt()
    {
        $tests = Result::all();
        foreach ($tests as $test) {
            $test->published_at = $test->created_at;
            $test->save();
        }
        dd('success');
    }

    public function triggerTestStatusLog()
    {
        // Healed Section
        $tests = Test::whereNotIn('code', [
            // In Isolation
            "4e1b59dc-f736-489a-b1c7-5c07e5905b86",
            "24be71ed-df7b-41cf-8911-412cfe24fe8a",
            "8a3ddbff-52fe-4896-9c2f-bffe931a6e50",
            "0a73ac90-9433-418c-a1a9-a897fee0de0c",
            "f668c782-2490-4dec-8805-3a25c719e0fb",
            "8d738404-611b-4a8e-b4fc-123cacd43c55",
            "3e9b6c93-c8a9-45f4-bfe9-c0ac145b4967",
            "73c3584f-cf33-45d7-82b1-7aa9f0b73165",
            "a0c065cb-770a-4b2c-884d-1d0cc4016128",
            "570e575d-c9e9-4d3b-a366-4fe2e1a0b67a",
            "dcdcc37d-1069-4c09-925f-2896d8acc58b",
            "fe3e0667-9a85-4ac4-85c7-92f56865ac21",
            "ce7a9a32-b2f5-49e2-9069-3483e94f6f05",
            "c6a3adb3-fc25-415e-9439-7dde94b402b2",

            // Death
            "7ac22e68-10c3-4e44-be7c-bcce5d27d066",
            "6466ab6e-997e-449b-8345-4bbe67e76ee3",
            "a700f8d1-0012-4b5e-860c-c40d83ec8e04",
            "dcdc2aba-4eb4-4314-869f-db74bee37e45",
            "e4165856-b19e-484b-bd6f-882f68a77d40",
            "dc9c31f9-23b0-4c69-a90c-306472b0f6de",
            "8917e74d-b748-4006-b983-fcf9173251c3",

        ])->whereHas('result', function($q){
            $q->where('value', 'positif');
        })->get();

        foreach($tests as $test){
            $test->logs()->create([
                'value' => 'sembuh'
            ]);
        }

        // Death Section
        $tests = Test::whereIn('code', [
            "7ac22e68-10c3-4e44-be7c-bcce5d27d066",
            "6466ab6e-997e-449b-8345-4bbe67e76ee3",
            "a700f8d1-0012-4b5e-860c-c40d83ec8e04",
            "dcdc2aba-4eb4-4314-869f-db74bee37e45",
            "e4165856-b19e-484b-bd6f-882f68a77d40",
            "dc9c31f9-23b0-4c69-a90c-306472b0f6de",
            "8917e74d-b748-4006-b983-fcf9173251c3",
        ])->get();

        foreach($tests as $test){
            $test->logs()->create([
                'value' => 'meninggal'
            ]);
        }

        dd('Success :)');
    }

    public function asd()
    {

        User::create([
            "name" => "Asrin Akhiruddin, A.Md.Kep",
            "phone" => "0822 5494 9149",
            "instance" => "Puskesmas",
            "instance_place" => "",
            "email" => "woliomiana@yahoo.co.id",
            "password" => Hash::make("puskemascovid19"),
            "role" => 3
        ]);

        User::create([
            "name" => "Emi Setyani Soni,A.Md.Kep",
            "email" => "emisoni1984@gmail.com",
            "phone" => "081352196171",
            "instance" => "Puskesmas",
            "instance_place" => "Pemuar",
            "password" => Hash::make("puskemascovid19"),
            "role" => "3"
        ]);

        User::create([
            "name" => "Bambang Hari Sudibyo, Amd.Kep",
            "phone" => "081348853452",
            "instance" => "Puskesmas",
            "instance_place" => "Tiong Keranjik",
            "email" => "sudibyohari82@gmail.com",
            "password" => Hash::make("puskemascovid19"),
            "role" => "3"
        ]);

        User::create([
            "name" => "Fery Ariyanto",
            "phone" => "085386794479",
            "instance" => "Puskesmas",
            "instance_place" => "Ella Hilir",
            "email" => "ariyafery@gmail.com",
            "password" => Hash::make("puskemascovid19"),
            "role" => "3"
        ]);

        User::create([
            "name" => "Monica Rani Saputri, Amd Kes",
            "phone" => "085246522533",
            "instance" => "Puskesmas",
            "instance_place" => "Ulak Muid",
            "email" => "rimo150526@gmail.com",
            "password" => Hash::make("puskemascovid19"),
            "role" => "3"
        ]);

        User::create([
            "name" => "Faisal",
            "phone" => "082213355965",
            "instance" => "Puskesmas",
            "instance_place" => "Menukung",
            "email" => "faisalfasli7@gmail.com",
            "password" => Hash::make("puskemascovid19"),
            "role" => "3"
        ]);

        User::create([
            "name" => "Solapidi",
            "phone" => "081253440308",
            "instance" => "Puskesmas",
            "instance_place" => "Manggala",
            "email" => "solapidi9889@gmail.com",
            "password" => Hash::make("puskemascovid19"),
            "role" => "3"
        ]);

        User::create([
            "name" => "Ageng Buih, A. Md. Kep",
            "phone" => "081251429124",
            "instance" => "Puskesmas",
            "instance_place" => "Sokan",
            "email" => "agengfullbuster@gmail.com",
            "password" => Hash::make("puskemascovid19"),
            "role" => "3"
        ]);

        User::create([
            "name" => "Emi Setyani Soni,A.Md.Kep",
            "phone" => "081352196171",
            "instance" => "Puskesmas",
            "instance_place" => "Pemuar",
            "email" => "emisoni1984@gmail.com",
            "password" => Hash::make("puskemascovid19"),
            "role" => "3"
        ]);

        User::create([
            "name" => "Agnes Erpiyanti",
            "phone" => "O81356770631",
            "instance" => "Puskesmas",
            "instance_place" => "Nanga Pinoh",
            "email" => "agneserpiyanti@gmail.com",
            "password" => Hash::make("puskemascovid19"),
            "role" => "3"
        ]);

    }

}


