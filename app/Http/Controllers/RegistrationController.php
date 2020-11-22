<?php

namespace App\Http\Controllers;

use App\Test;
use App\Person;
use App\Province;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use App\EpidemiologyTravel;
use Illuminate\Support\Str;
use App\EpidemiologyContact;
use App\EpidemiologySymptom;
use Illuminate\Http\Request;
use App\EpidemiologyDiagnose;
use App\EpidemiologyHospital;
use App\EpidemiologyProtector;
use App\EpidemiologyAdditional;
use App\EpidemiologyComorbidity;
use Yajra\DataTables\DataTables;
use App\DataTables\PeopleDataTable;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePeRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StorePersonRequest;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\UpdatePersonRequest;

class RegistrationController extends Controller
{
    public function showCreatePerson()
    {
        return view('registration.person-create');
    }

    public function showEditPerson($id)
    {
        $person = Person::findOrFail($id);
        return view('registration.person-update', compact('person'));
    }

    public function showPeopleSearch(PeopleDataTable $dataTable)
    {
        return $dataTable->render('registration.people-search');
    }

    public function showCreatePe($id)
    {
        $person = Person::findOrFail($id);
        return view('registration.pe-create', compact('person'));
    }

    public function checkCreatePe($id)
    {
        $person = Person::find($id);
        if(
            $person->nik == null ||
            $person->phone == null ||
            $person->parent_name == null ||
            $person->card_path == null ||
            $person->work == null ||
            $person->birth_regency == null ||
            $person->birth_at == null ||
            $person->card_province == null ||
            $person->card_regency == null ||
            $person->card_district == null ||
            $person->card_village == null
        ){
            Alert::html('Ups !', 'Data pasien masih belum lengkap. Cek kembali <b>NIK, Nama, Nomor HP, Nama orang tua, Foto identitas, Pekerjaan, Tempat lahir, Tanggal lahir, Alamat Provinsi, Kabupaten/Kota, Kecamatan, dan Desa</b>', 'error');
            return redirect()->route('registration.person.edit', ['id'=>$id]);
        }

        Alert::success('Yeay :)', 'Data pasien sudah lengkap, silahkan lanjutkan pengisian form PE.');
        return redirect()->route('registration.pe.create', ['id' => $id]);
    }

    public function storePerson(StorePersonRequest $request)
    {
        $request->validated();

        $person = new Person();

        $person->user_id = Auth::user()->id;

        $person->nik = $request->nik;
        $person->name = Str::title($request->name);
        $person->phone = $request->phone;
        $person->gender = $request->gender;

        // Store Person ID Card File
        $path = $request->file('id_card_file')->store('public/id_cards');
        $path_proc = explode('/',$path);
        $file_path = end($path_proc);

        // Store Person ID Card File Path
        $person->card_path = $file_path;

        $person->birth_regency = Str::upper($request->birth_regency);
        $person->birth_at = Carbon::make($request->birth_at);
        $person->parent_name = Str::upper($request->parent_name);
        $person->work = Str::upper($request->work);
        $person->work_instance = Str::upper($request->work_instance);
        $person->card_province = Str::upper($request->card_province);
        $person->card_regency = Str::upper($request->card_regency);
        $person->card_district = Str::upper($request->card_district);
        $person->card_village = Str::upper($request->card_village);
        $person->card_street = Str::upper($request->card_street);
        $person->card_rt = $request->card_rt;
        $person->card_rw = $request->card_rw;

        if($person->save()){
            Alert::success('Hore :)', 'Berhasil mendaftarkan pasien, silahkan lanjutkan pengisian lembar PE.');
            return redirect()->route('registration.pe.create', ['id'=>$person->id]);
        }

        return abort(501);
    }

    public function updatePerson(UpdatePersonRequest $request, $id)
    {
        $request->validated();

        $person = Person::findOrFail($id);

        $person->user_id = Auth::user()->id;

        $person->nik = $request->nik;
        $person->name = Str::title($request->name);
        $person->phone = $request->phone;
        $person->gender = $request->gender;

        // Store Person ID Card File
        if($request->file('id_card_file') != null){
            $path = $request->file('id_card_file')->store('public/id_cards');

            $path_proc = explode('/',$path);
            $file_path = end($path_proc);

            // Store Person ID Card File Path
            $person->card_path = $file_path;
        }


        $person->birth_regency = Str::upper($request->birth_regency);
        $person->birth_at = Carbon::make($request->birth_at);
        $person->parent_name = Str::upper($request->parent_name);
        $person->work = Str::upper($request->work);
        $person->work_instance = Str::upper($request->work_instance);
        $person->card_province = Str::upper($request->card_province);
        $person->card_regency = Str::upper($request->card_regency);
        $person->card_district = Str::upper($request->card_district);
        $person->card_village = Str::upper($request->card_village);
        $person->card_street = Str::upper($request->card_street);
        $person->card_rt = $request->card_rt;
        $person->card_rw = $request->card_rw;

        if($person->save()){
            return redirect()->route('registration.pe.create.check', ['id'=>$person->id]);
        }

        return abort(501);
    }

    public function storePe(StorePeRequest $request, $id){

        $request->validated();
        $person = Person::findOrFail($id);

        //*Test Model
        $test = new Test();

        //-----Code UUID
        $uuid = Uuid::uuid4();
        while(Test::where('code', $uuid)->get()->count() != 0){
            $uuid = Uuid::uuid4();
        }
        $test->code = $uuid;

        //-----User ID
        $test->user_id = Auth::user()->id;

        //-----Person ID
        $test->person_id = $person->id;

        //-----Test & Type
        $test->test = "swab";
        $test->location = Str::lower($request->swab_location);
        $test->type = Str::lower($request->swab_type);

        //-----Criteria
        $test->criteria = Str::lower(implode(", ", $request->criteria));

        //-----Person Location
        $test->living_province = Str::lower($request->living_province);
        $test->living_regency = Str::lower($request->living_regency);
        $test->living_district = Str::lower($request->living_district);
        $test->living_village = Str::lower($request->living_village);
        $test->living_street = Str::upper($request->living_street);
        $test->living_rt = $request->living_rt;
        $test->living_rw = $request->living_rw;

        //-----Test Location

        //-----Tube Code
        $test->tube_code = Str::upper($request->tube_code);

        //-----Group Code
        $test->group_code = Str::upper($request->group_code);

        $test->save();

        //*Symptoms Model
        if($request->symptoms_toggle == "yes"){
            foreach ($request->symptoms as $value) {
                $epidemiology_symptoms = new EpidemiologySymptom();

                $epidemiology_symptoms->test_id = $test->id;
                $epidemiology_symptoms->value = Str::lower($value);

                if($value == 'demam'){
                    $epidemiology_symptoms->sub_value = $request->fever_temperature;
                }elseif ($value == 'else') {
                    $epidemiology_symptoms->sub_value = $request->symptoms_else;
                }

                $epidemiology_symptoms->symptom_at = Carbon::create($request->symptoms_at);
                $epidemiology_symptoms->save();
            }
        }

        //*Comorbid Model
        if($request->comorbidities_toggle == "yes"){
            foreach ($request->comorbidities as $value) {
                $epidemiology_comorbidities = new EpidemiologyComorbidity();

                $epidemiology_comorbidities->test_id = $test->id;
                $epidemiology_comorbidities->value = Str::lower($value);

                if ($value == 'else') {
                    $epidemiology_comorbidities->sub_value = Str::lower($request->comorbidities_else);
                }

                $epidemiology_comorbidities->save();
            }
        }

        //*Diagnoses Model
        if($request->diagnoses_toggle == "yes"){
            foreach ($request->diagnoses as $value) {
                $epidemiology_diagnoses = new EpidemiologyDiagnose();
                $epidemiology_diagnoses->test_id = $test->id;

                $epidemiology_diagnoses->value = Str::lower($value);

                if ($value == 'else') {
                    $epidemiology_diagnoses->sub_value = $request->diagnoses_else;
                }

                $epidemiology_diagnoses->save();
            }
        }

        //*Hospital Model
        if($request->hospital_toggle == "yes"){
            $epidemiology_hospital = new EpidemiologyHospital();
            $epidemiology_hospital->test_id = $test->id;

            $epidemiology_hospital->name = Str::upper($request->hospital_name);
            $epidemiology_hospital->start_at = Carbon::create($request->hospital_start_at);
            $epidemiology_hospital->status = Str::lower($request->hospital_status);
            $epidemiology_hospital->name_histories = Str::upper($request->hospital_name_history);

            foreach ($request->hospital_additions as $value) {
                switch ($value) {
                    case 'icu':
                        $epidemiology_hospital->icu = true;
                    break;
                    case 'intubation':
                        $epidemiology_hospital->intubation = true;
                    break;
                    case 'emco':
                        $epidemiology_hospital->emco = true;
                    break;

                    default:
                        $epidemiology_hospital->icu = false;
                        $epidemiology_hospital->intubation = false;
                        $epidemiology_hospital->emco = false;
                    break;
                }
            }

            $epidemiology_hospital->save();
        }

        //*International Travel History Model
        if($request->travel_history_international_toggle == 'yes'){
            $epidemiology_travel_history_international = new EpidemiologyTravel();
            $epidemiology_travel_history_international->test_id = $test->id;

            $epidemiology_travel_history_international->type = 'international';
            $epidemiology_travel_history_international->country = Str::lower($request->travel_history_international_country);
            $epidemiology_travel_history_international->regency = Str::lower($request->travel_history_international_regency);
            $epidemiology_travel_history_international->departure_at = Carbon::create($request->travel_history_international_departure_at);
            $epidemiology_travel_history_international->arrive_at = Carbon::create($request->travel_history_international_arrive_at);

            $epidemiology_travel_history_international->save();
        }

        //*Domestic Travel History Model
        if($request->travel_history_domestic_toggle == 'yes'){
            $epidemiology_travel_history_domestic = new EpidemiologyTravel();
            $epidemiology_travel_history_domestic->test_id = $test->id;

            $epidemiology_travel_history_domestic->type = 'domestic';
            $epidemiology_travel_history_domestic->country = 'indonesia';

            $domestic_province = Province::whereHas('regencies', function(Builder $query){
                global $request;
                $query->where('name', $request->travel_history_domestic_regency);
            })->first();

            $epidemiology_travel_history_domestic->province = Str::lower($domestic_province->name);
            $epidemiology_travel_history_domestic->regency = Str::lower($request->travel_history_domestic_regency);
            $epidemiology_travel_history_domestic->departure_at = Carbon::create($request->travel_history_domestic_departure_at);
            $epidemiology_travel_history_domestic->arrive_at = Carbon::create($request->travel_history_domestic_arrive_at);

            $epidemiology_travel_history_domestic->save();
        }

        //*Living Travel History Model
        if($request->travel_history_living_toggle == 'yes'){
            $epidemiology_travel_history_living = new EpidemiologyTravel();
            $epidemiology_travel_history_living->test_id = $test->id;

            $epidemiology_travel_history_living->type = 'living';
            $epidemiology_travel_history_living->country = 'indonesia';

            $living_province = Province::whereHas('regencies', function(Builder $query){
                global $request;
                $query->where('name', $request->travel_history_living_regency);
            })->first();

            $epidemiology_travel_history_living->province = Str::lower($living_province->name);
            $epidemiology_travel_history_living->regency = Str::lower($request->travel_history_living_regency);
            $epidemiology_travel_history_living->departure_at = Carbon::create($request->travel_history_living_departure_at);
            $epidemiology_travel_history_living->arrive_at = Carbon::create($request->travel_history_living_arrive_at);

            $epidemiology_travel_history_living->save();
        }

        //*Normal Contact Model
        if($request->contact_history_normal_toggle == 'yes'){
            $epidemiology_contact_history_normal = new EpidemiologyContact();
            $epidemiology_contact_history_normal->test_id = $test->id;

            $epidemiology_contact_history_normal->type = 'normal';
            $epidemiology_contact_history_normal->name = Str::upper($request->contact_history_normal_name);
            $epidemiology_contact_history_normal->gender = $request->contact_history_normal_gender;
            $epidemiology_contact_history_normal->address = Str::upper($request->contact_history_normal_address);
            $epidemiology_contact_history_normal->phone = $request->contact_history_normal_phone;
            $epidemiology_contact_history_normal->status = Str::lower($request->contact_history_normal_status);
            $epidemiology_contact_history_normal->start_at = Carbon::create($request->contact_history_normal_start_at);
            $epidemiology_contact_history_normal->end_at = Carbon::create($request->contact_history_normal_end_at);
            $epidemiology_contact_history_normal->save();
        }

        //*Close Contact Model
        if($request->contact_history_close_toggle == 'yes'){
            $epidemiology_contact_history_close = new EpidemiologyContact();
            $epidemiology_contact_history_close->test_id = $test->id;

            $epidemiology_contact_history_close->type = 'close';
            $epidemiology_contact_history_close->name = Str::upper($request->contact_history_close_name);
            $epidemiology_contact_history_close->gender = $request->contact_history_close_gender;
            $epidemiology_contact_history_close->address = Str::upper($request->contact_history_close_address);
            $epidemiology_contact_history_close->phone = $request->contact_history_close_phone;
            $epidemiology_contact_history_close->status = Str::lower($request->contact_history_close_status);
            $epidemiology_contact_history_close->start_at = Carbon::create($request->contact_history_close_start_at);
            $epidemiology_contact_history_close->end_at = Carbon::create($request->contact_history_close_end_at);
            $epidemiology_contact_history_close->save();
        }


        //*Additional Test Model
        $epidemiology_additionals = new EpidemiologyAdditional();
        $epidemiology_additionals->test_id = $test->id;

        $epidemiology_additionals->ispa = ($request->ispa == 'yes');

        if($request->pet_toggle == 'yes'){
            $epidemiology_additionals->pet = Str::upper($request->pet);
        }

        $epidemiology_additionals->health_worker = ($request->health_worker_toggle == 'yes');
        if($request->health_worker_toggle == 'yes'){
            foreach ($request->protectors as $value) {
                $protector = new EpidemiologyProtector();
                $protector->test_id = $test->id;
                $protector->value = Str::lower($value);
                $protector->save();
            }
        }

        $epidemiology_additionals->aerosol = ($request->aerosol == 'yes');

        $epidemiology_additionals->save();

        Alert::success('Hore :)', 'Berhasil mendaftarkan PE, silahkan download lembar PE melalui tombol yang tersedia dibawah halaman.');
        return redirect()->route('pe.view', ['code' => $test->code]);
    }

}
