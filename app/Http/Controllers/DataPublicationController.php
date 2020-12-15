<?php

namespace App\Http\Controllers;

use App\Result;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DataPublicationController extends Controller
{
    public function index()
    {
        $results = Result::with(['test', 'test.person'])->get();

        // Release
        $statistics['positive_release'] = $results->filter(function($item){
            return data_get($item, 'value') == 'positif' && data_get($item, 'published_at') != null;
        })->count();
        $statistics['negative_release'] = $results->filter(function($item){
            return data_get($item, 'value') == 'negatif' && data_get($item, 'published_at') != null;
        })->count();

        // New
        $statistics['positive_new'] = $results->filter(function($item){
            return data_get($item, 'value') == 'positif' && data_get($item, 'published_at') == null;
        })->count();
        $statistics['negative_new'] = $results->filter(function($item){
            return data_get($item, 'value') == 'negatif' && data_get($item, 'published_at') == null;
        })->count();

        // TOTAL
        $statistics['positive_total'] = $statistics['positive_release'] + $statistics['positive_new'];
        $statistics['negative_total'] = $statistics['negative_release'] + $statistics['negative_new'];

        return view('admin.publish', compact('statistics'));
    }

    public function publish()
    {
        $results = Result::whereNull('published_at')->get();
        foreach ($results as $result) {
            $result->published_at = Carbon::now();
            $result->save();
        }
        Alert('Hore', 'Berhasil merilis seluruh data per waktu saat ini', 'success');
        return redirect()->back();
    }
}
