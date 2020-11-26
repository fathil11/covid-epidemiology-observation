<?php

namespace App\Http\Controllers;

use App\DataTables\PePresenceDataTable;
use App\DataTables\TestDataTable;
use App\Test;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;
use RealRashid\SweetAlert\Facades\Alert;

class PeController extends Controller
{
    public function index(TestDataTable $dataTable)
    {
        return $dataTable->render('pe.pe');
    }

    public function show($code)
    {
        $pe = Test::where('code', $code)->firstOrFail();
        return view('registration.pe-view', compact('pe'));
    }

    public function showPresence(PePresenceDataTable $dataTable)
    {
        return $dataTable->render('pe.pe');
    }

    public function presence($code)
    {
        $test = Test::where('code', $code)->firstOrFail();
        if($test->test_at != null){
            return abort(404);
        }

        $test->test_at = Carbon::now();
        $test->save();

        Alert('Hore', 'Berhasil meng-absenkan pasien', 'success');
        return redirect()->back();
    }

    public function deletePresence($code)
    {
        $test = Test::where('code', $code)->firstOrFail();
        if($test->test_at == null){
            return abort(404);
        }

        $test->test_at = null;
        $test->save();

        Alert('Hore', 'Berhasil menarik absen pasien', 'success');
        return redirect()->back();
    }

    public function download($code)
    {
        $pe = Test::where('code', $code)->firstOrFail();

        $document = new TemplateProcessor('document-layouts/pe.docx');
        // dd(asset('storage/id_cards/' . $pe->person->card_path));
        $document->setImageValue('id_card', ['path' => asset('storage/id_cards/' . $pe->person->card_path), 'width' => '300pt', 'height' => '']);

        $document->setValue('tube_code', $pe->tube_code);
        $document->setValue('fasyankes', $pe->user->instance);
        $document->setValue('tempat_fasyankes', $pe->user->instance_place);
        $document->setValue('tgl_wawancara', $pe->created_at->isoFormat('DD MMMM Y'));
        $document->setValue('nama_pewawancara', $pe->user->name);
        $document->setValue('hp_pewawancara', $pe->user->phone);

        $document->setValue('criteria', $pe->criteria);
        $document->setValue('name', $pe->person->name);
        $document->setValue('nik', $pe->person->nik);
        $document->setValue('birth_date_age', "{$pe->person->birth_at->isoFormat('DD MMMM Y')} ({$pe->person->age} tahun)");
        $document->setValue('gender', $pe->person->jenis_kelamin);
        $document->setValue('work', $pe->person->work);
        $document->setValue('work_instance', $pe->person->work_instance);
        $document->setValue('phone', $pe->person->phone);
        $document->setValue('province', $pe->living_province);
        $document->setValue('regency', $pe->living_regency);
        $document->setValue('district', $pe->living_district);
        $document->setValue('village', $pe->living_village);
        $document->setValue('street', $pe->living_street);
        $document->setValue('rt_rw', $pe->living_rt != null && $pe->living_rw != null ? "{$pe->living_rt}/{$pe->living_rw}" : '');

        if($pe->symptoms->count() > 0){
            $document->setValue('symptoms_at', $pe->symptoms->first()->symptom_at->isoFormat('DD MMMM Y'));
            $document->setValue('symptoms', $pe->symptoms_list);
        }else{
            $document->setValue('symptoms_at', '-');
            $document->setValue('symptoms', 'Tidak ada');
        }

        if($pe->comorbidities->count() > 0){
            $document->setValue('comorbidities', $pe->comorbidities_list);
        }else{
            $document->setValue('comorbidities', 'Tidak ada');
        }

        if($pe->diagnoses->count() > 0){
            $document->setValue('diagnoses', $pe->diagnoses_list);
        }else{
            $document->setValue('diagnoses', 'Tidak ada');
        }

        if($pe->hospital != null){
            $document->setValue('hospital_at', $pe->hospital->start_at->isoFormat('DD MMMM Y'));
            $document->setValue('hospital_name', $pe->hospital->name);
            $document->setValue('hospital_addition', $pe->hospital->additional != '' ? '-': $pe->hospital->additional);
            $document->setValue('hospital_last_status', $pe->hospital->status);
            $document->setValue('hospital_history', $pe->hospital->name_histories != null ? 'Tidak ada' : $pe->hospital->name_histories);
        }else{
            $document->setValue('hospital_at', '-');
            $document->setValue('hospital_name', '-');
            $document->setValue('hospital_addition', '-');
            $document->setValue('hospital_last_status', '-');
            $document->setValue('hospital_history', '-');
        }


        //! Test History Processing
        //* Get Person Tests
        $person = $pe->person;
        $person_tests = $person->tests;

        if($person_tests->count() > 1){
            //* First last 2 Test Pick from (Last-2)
            $test = $person_tests[$person_tests->count()-2];
            switch ($test->type) {
                case 'Nasofaring':
                    $document->setValue('np_at', $test->created_at->format('m/d/Y'));
                    // ! TEMPORARY
                    $document->setValue('np_place', 'Labkesda');
                    // $document->setValue('np_place', $test->location);
                    $document->setValue('np_result', $test->result != null ? $test->result->value : '');

                    $document->setValue('op_at', '');
                    $document->setValue('op_place', '');
                    $document->setValue('op_result', '');
                break;

                case 'Orofaring':
                    $document->setValue('np_at', '');
                    $document->setValue('np_place', '');
                    $document->setValue('np_result', '');

                    $document->setValue('op_at', $test->created_at->format('m/d/Y'));
                    // ! TEMPORARY
                    $document->setValue('op_place', 'Labkesda');
                    // $document->setValue('op_place', $test->location);
                    $document->setValue('op_result', $test->result != null ? $test->result->value : '');
                break;

                case 'Nasofaring-Orofaring':
                    $document->setValue('np_at', $test->created_at->format('m/d/Y'));
                    // ! TEMPORARY
                    $document->setValue('np_place', 'Labkesda');
                    // $document->setValue('np_place', $test->location);
                    $document->setValue('np_result', $test->result != null ? $test->result->value : '');

                    $document->setValue('op_at', $test->created_at->format('m/d/Y'));
                    // ! TEMPORARY
                    $document->setValue('op_place', 'Labkesda');
                    // $document->setValue('op_place', $test->location);
                    $document->setValue('op_result', $test->result != null ? $test->result->value : '');
                break;
                default:
            break;
        }

        //* Second last 2 Test Pick from (Last-1)
        $test = $person_tests[$person_tests->count()-1];
        switch ($test->type) {
            case 'Nasofaring':
                // ! TEMPORARY
                $document->setValue('np2_at', '');
                // $document->setValue('np2_at', $test->created_at->format('m/d/Y'));
                // ! TEMPORARY
                $document->setValue('np2_place', 'Labkesda');
                // $document->setValue('np2_place', $test->location);
                $document->setValue('np2_result', $test->result != null ? $test->result->value : '');

                $document->setValue('op2_at', '');
                $document->setValue('op2_place', '');
                $document->setValue('op2_result', '');
            break;

            case 'Orofaring':
                $document->setValue('np2_at', '');
                $document->setValue('np2_place', '');
                $document->setValue('np2_result', '');

                // ! TEMPORARY
                $document->setValue('op2_at', '');
                // $document->setValue('op2_at', $test->created_at->format('m/d/Y'));
                // ! TEMPORARY
                $document->setValue('op2_place', 'Labkesda');
                // $document->setValue('op2_place', $test->location);
                $document->setValue('op2_result', $test->result != null ? $test->result->value : '');
                break;

            case 'Nasofaring-Orofaring':
                // ! TEMPORARY
                $document->setValue('np2_at', '');
                // $document->setValue('np2_at', $test->created_at->format('m/d/Y'));
                // ! TEMPORARY
                $document->setValue('np2_place', 'Labkesda');
                // $document->setValue('np2_place', $test->location);
                $document->setValue('np2_result', $test->result != null ? $test->result->value : '');

                // ! TEMPORARY
                $document->setValue('op2_at', '');
                // $document->setValue('op2_at', $test->created_at->format('m/d/Y'));
                // ! TEMPORARY
                $document->setValue('op2_place', 'Labkesda');
                // $document->setValue('op2_place', $test->location);
                $document->setValue('op2_result', $test->result != null ? $test->result->value : '');
                break;
            default:
                break;
            }
        }else{
            $test = $person_tests->first();
            switch ($test->type) {
                case 'Nasofaring':
                    // ! TEMPORARY
                    $document->setValue('np_at', '');
                    // $document->setValue('np_at', $test->created_at->format('m/d/Y'));
                    // ! TEMPORARY
                    $document->setValue('np_place', 'Labkesda');
                    // $document->setValue('np_place', $test->location);
                    $document->setValue('np_result', $test->result != null ? $test->result->value : '');

                    $document->setValue('op_at', '');
                    $document->setValue('op_place', '');
                    $document->setValue('op_result', '');
                    break;

                case 'Orofaring':
                    $document->setValue('np_at', '');
                    $document->setValue('np_place', '');
                    $document->setValue('np_result', '');

                    // ! TEMPORARY
                    $document->setValue('op_at', '');
                    // $document->setValue('op_at', $test->created_at->format('m/d/Y'));
                    // ! TEMPORARY
                    $document->setValue('op_place', 'Labkesda');
                    // $document->setValue('op_place', $test->location);
                    $document->setValue('op_result', $test->result != null ? $test->result->value : '');
                break;

                case 'Nasofaring-Orofaring':
                    // ! TEMPORARY
                    $document->setValue('np_at', '');
                    // $document->setValue('np_at', $test->created_at->format('m/d/Y'));
                    // ! TEMPORARY
                    $document->setValue('np_place', 'Labkesda');
                    // $document->setValue('np_place', $test->location);
                    $document->setValue('np_result', $test->result != null ? $test->result->value : '');

                    // ! TEMPORARY
                    $document->setValue('op_at', '');
                    // $document->setValue('op_at', $test->created_at->format('m/d/Y'));
                    // ! TEMPORARY
                    $document->setValue('op_place', 'Labkesda');
                    // $document->setValue('op_place', $test->location);
                    $document->setValue('op_result', $test->result != null ? $test->result->value : '');
                    break;
                default:
                    break;
            }

            $document->setValue('np2_at', '');
            $document->setValue('np2_place', '');
            $document->setValue('np2_result', '');
            $document->setValue('op2_at', '');
            $document->setValue('op2_place', '');
            $document->setValue('op2_result', '');
        }

        //! End of Test History Processing

        if($pe->international_travels->count() > 0){
            $document->setValue('itn_country', $pe->international_travels->first()->country);
            $document->setValue('itn_regency', $pe->international_travels->first()->regency);
            $document->setValue('itn_departure_at', $pe->international_travels->first()->departure_at->isoFormat('DD MMMM Y'));
            $document->setValue('itn_arrive_at', $pe->international_travels->first()->arrive_at->isoFormat('DD MMMM Y'));
        }else{
            $document->setValue('itn_country', '');
            $document->setValue('itn_regency', '');
            $document->setValue('itn_departure_at', '');
            $document->setValue('itn_arrive_at', '');
        }

        if($pe->domestic_travels->count() > 0){
            $document->setValue('dms_province', $pe->domestic_travels->first()->province);
            $document->setValue('dms_regency', $pe->domestic_travels->first()->regency);
            $document->setValue('dms_departure_at', $pe->domestic_travels->first()->departure_at->isoFormat('DD MMMM Y'));
            $document->setValue('dms_arrive_at', $pe->domestic_travels->first()->arrive_at->isoFormat('DD MMMM Y'));
        }else{
            $document->setValue('dms_province', '');
            $document->setValue('dms_regency', '');
            $document->setValue('dms_departure_at', '');
            $document->setValue('dms_arrive_at', '');
        }

        if($pe->living_travels->count() > 0){
            $document->setValue('lvg_province', $pe->living_travels->first()->province);
            $document->setValue('lvg_regency', $pe->living_travels->first()->regency);
            $document->setValue('lvg_start_at', $pe->living_travels->first()->departure_at->isoFormat('DD MMMM Y'));
            $document->setValue('lvg_end_at', $pe->living_travels->first()->arrive_at->isoFormat('DD MMMM Y'));
        }else{
            $document->setValue('lvg_province', '');
            $document->setValue('lvg_regency', '');
            $document->setValue('lvg_start_at', '');
            $document->setValue('lvg_end_at', '');
        }

        if($pe->normal_contacts->count() > 0){
            $document->setValue('nrm_name', $pe->normal_contacts->first()->name);
            $document->setValue('nrm_address', $pe->normal_contacts->first()->address);
            $document->setValue('nrm_contact', $pe->normal_contacts->first()->status);
            $document->setValue('nrm_start_at', $pe->normal_contacts->first()->start_at->isoFormat('DD MMMM Y'));
            $document->setValue('nrm_end_at', $pe->normal_contacts->first()->end_at->isoFormat('DD MMMM Y'));
        }else{
            $document->setValue('nrm_name', '');
            $document->setValue('nrm_address', '');
            $document->setValue('nrm_contact', '');
            $document->setValue('nrm_start_at', '');
            $document->setValue('nrm_end_at', '');
        }

        if($pe->close_contacts->count() > 0){
            $document->setValue('cls_name', $pe->close_contacts->first()->name);
            $document->setValue('cls_address', $pe->close_contacts->first()->address);
            $document->setValue('cls_contact', $pe->close_contacts->first()->status);
            $document->setValue('cls_start_at', $pe->close_contacts->first()->start_at->isoFormat('DD MMMM Y'));
            $document->setValue('cls_end_at', $pe->close_contacts->first()->end_at->isoFormat('DD MMMM Y'));
        }else{
            $document->setValue('cls_name', '');
            $document->setValue('cls_address', '');
            $document->setValue('cls_contact', '');
            $document->setValue('cls_start_at', '');
            $document->setValue('cls_end_at', '');
        }

        if($pe->additional != null){
            $document->setValue('ispa', $pe->additional->ispa ? 'Ya' : 'Tidak');
            $document->setValue('pet', $pe->additional->pet == null ? 'Tidak ada' : $pe->additional->pet);
            $document->setValue('health_worker', $pe->additional->health_worker ? 'Ya' : 'Tidak');
            $document->setValue('protectors', $pe->protectors_list);
            $document->setValue('aerosol', $pe->additional->aerosol ? 'Ya' : 'Tidak');
        }else{
            $document->setValue('ispa', '');
            $document->setValue('pet', '');
            $document->setValue('health_worker', '');
            $document->setValue('protectors', '');
            $document->setValue('aerosol', '');
        }

        $document->saveAs(public_path("storage/temp/{$pe->person->name}({$pe->tube_code}).docx"));
        return response()->download(public_path("storage/temp/{$pe->person->name}({$pe->tube_code}).docx"))->deleteFileAfterSend(true);
    }
}
