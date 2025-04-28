<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Periksa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PasienController extends Controller
{
    

    public function index() {
        $pasien_name = User::where('id', Auth::user()->id)->value('nama');
        $riwayats = Periksa::where('id_pasien', Auth::user()->id)->get();

        $banyak_riwayat = count($riwayats);
        return view('pasien.dashboard', compact('banyak_riwayat', 'pasien_name'));
    }

    public function makeAppointment() {
        $dokters = DB::table('users')->where('role', 'dokter')->get();
        $pasien_name = User::where('id', Auth::user()->id)->value('nama');

        return view('pasien.periksa', compact('dokters', 'pasien_name'));
    }

    public function showRiwayat()
    {
        $riwayats = Periksa::where('id_pasien', Auth::user()->id)
                    ->orderby('tgl_periksa', 'desc')
                    ->get();
        $pasien_name = User::where('id', Auth::user()->id)->value('nama');

        return view('pasien.riwayat', compact('riwayats', 'pasien_name'));
    }

    public function submitAppointment(Request $request) {
        
        Periksa::create([
            'id_pasien' => Auth::user()->id,
            'id_dokter' => $request['id_dokter'],
            'tgl_periksa' => $request['tgl_periksa'],
            'catatan' => '',
            'biaya_periksa' => '0'
        ]);

        return redirect()->route('pasien-riwayat');
    }
}
