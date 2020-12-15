<?php

namespace App\Http\Controllers;

use App\Test;
use Illuminate\Http\Request;
use App\DataTables\Admin\AdminStatusDataTable;
use RealRashid\SweetAlert\Facades\Alert;

class StatusController extends Controller
{
    public function index(AdminStatusDataTable $dataTable)
    {
        return $dataTable->render('datatables.index', [
            'title' => 'Data Status Konfirmasi',
            'sub_title' => 'Menu pengaturan status pasien'
        ]);
    }

    public function isolate($code)
    {
        $test = Test::where('code', $code)->has('logs', '>', 0)->firstOrFail();
        $logs = $test->logs;

        foreach ($logs as $log) {
            $log->delete();
        }

        Alert('Sip,', 'Berhasil mengubah status pasien ke ISOLASI', 'success');
        return redirect()->back();
    }

    public function recover($code)
    {
        $test = Test::where('code', $code)->firstOrFail();
        $test->logs()->create([
            'value' => 'sembuh'
        ]);

        Alert('Sip,', 'Berhasil mengubah status pasien konfirmasi ke SEMBUH', 'success');
        return redirect()->back();
    }

    public function die($code)
    {
        $test = Test::where('code', $code)->firstOrFail();
        $test->logs()->create([
            'value' => 'meninggal'
        ]);

        Alert('Sip,', 'Berhasil mengubah status pasien konfirmasi ke MENINGGAL', 'success');
        return redirect()->back();
    }
}
