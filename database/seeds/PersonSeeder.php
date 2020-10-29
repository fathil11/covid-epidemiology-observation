<?php

use App\Person;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $person = new Person();
        $person->user_id = 1;
        $person->nik = "1234567891011121";
        $person->name = "Fathil Arham";
        $person->phone = "082225210125";
        $person->gender = "m";
        $person->parent_name = "Ahmad Jawahir";
        $person->card_path = "public/storage/id_cards/example.png";
        $person->work = "Pelajar/Mahasiswa";
        $person->work_instance = "Udinus";
        $person->birth_regency = "Sintang";
        $person->birth_at = Carbon::create('04/03/2000');
        $person->birth_at = Carbon::create('04/03/2000');
        $person->card_province = "Jawa Tengah";
        $person->card_regency = "Semarang";
        $person->card_district = "Semarang Tengah";
        $person->card_village = "Bangunharjo";
        $person->card_street = "Jl. Kauman Johar no.15";
        $person->card_rt = "01";
        $person->card_rw = "02";
        $person->save();
    }
}
