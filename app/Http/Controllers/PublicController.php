<?php

namespace App\Http\Controllers;

use App\Test;
use Carbon\Carbon;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PublicController extends Controller
{
    public function showResult($code)
    {
        $test = Test::with(['person', 'result'])->where('code', $code)->firstOrFail();
        return view('public.result', compact('test'));
    }

    public function downloadResult($code)
    {
        $test = Test::with(['person', 'result'])->where('code', $code)->firstOrFail();

        if($test->result == null){
            return abort(404);
        }

        $data['id'] = $test->id;
        $data['location'] = $test->location == 'internal' ? 'Labkesda Kabupaten Melawi' : Str::title($test->location);
        $data['result_at'] = $test->result->created_at->isoFormat('DD MMMM Y');
        $data['mail_at'] = Carbon::make($test->result->created_at)->addDay()->isoFormat('DD MMMM Y');
        $data['name'] = $test->person->name;
        $data['gender'] = $test->person->gender == 'm' ? 'Laki-laki' : 'Perempuan';
        $data['address'] = "Desa {$test->living_village}, Kecamatan {$test->living_district}, Kabupaten {$test->living_regency}, Provinsi {$test->living_province}";
        $data['result'] = $test->result->value;
        $data['message'] = $test->result->value == 'positif' ? 'Yang bersangkutan diwajibkan untuk melakukan isolasi sesuai panduan pedoman pencegahan COVID-19 revisi ke-5 tahun 2020.' : 'Yang bersangkutan diharapkan tetap
        waspada dan selalu menjalankan protokol kesehatan.';

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('layouts.mail-result', $data);
        return $pdf->stream('Hasil SWAB ' . $test->person->name . '.pdf');
    }


}
