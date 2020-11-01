<?php

namespace App\Http\Controllers;

use App\Test;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class PeController extends Controller
{
    public function show($code)
    {
        $pe = Test::where('code', $code)->firstOrFail();
        return view('registration.pe-view', compact('pe'));
    }

    public function download($code)
    {
        $pe = Test::where('code', $code)->firstOrFail();

        $document = new TemplateProcessor('document-layouts/pe.docx');

        // $document->setValue('name', $pe->person->name);
        // $document->setValue('tube_code', $pe->tube_code);
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
        $document->setValue('rt_rw', "{$pe->living_rt}/{$pe->living_rw}");

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

        $document->setValue('np_at', '');
        $document->setValue('np_place', '');
        $document->setValue('np_result', '');
        $document->setValue('np2_at', '');
        $document->setValue('np2_place', '');
        $document->setValue('np2_result', '');
        $document->setValue('op_at', '');
        $document->setValue('op_place', '');
        $document->setValue('op_result', '');
        $document->setValue('op2_at', '');
        $document->setValue('op2_place', '');
        $document->setValue('op2_result', '');

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
            $document->setValue('dms_arrive_at', );
        }else{
            $document->setValue('dms_province', '');
            $document->setValue('dms_regency', '');
            $document->setValue('dms_departure_at', '');
            $document->setValue('dms_arrive_at', '');
        }

        $document->setValue('lvg_province', );
        $document->setValue('lvg_regency', );
        $document->setValue('lvg_start_at', );
        $document->setValue('lvg_end_at', );
        $document->setValue('nrm_name', );
        $document->setValue('nrm_address', );
        $document->setValue('nrm_contact', );
        $document->setValue('nrm_start_at', );
        $document->setValue('nrm_end_at', );
        $document->setValue('cls_name', );
        $document->setValue('cls_address', );
        $document->setValue('cls_contact', );
        $document->setValue('cls_start_at', );
        $document->setValue('cls_end_at', );
        $document->setValue('ispa', );
        $document->setValue('pet', );
        $document->setValue('health_worker', );
        $document->setValue('protectors', );
        $document->setValue('aerosol', );


        $document->saveAs("temp/{$pe->person->name}({$pe->tube_code}).docx");
        return response()->download("temp/{$pe->person->name}({$pe->tube_code}).docx")->deleteFileAfterSend(true);
    }
}
