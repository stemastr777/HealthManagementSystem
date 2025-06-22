<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftarPoli;
use App\Models\Periksa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PasienController extends Controller
{

    private function getCurrentAccount() {
        $account = User::where('id', Auth::user()->id)->first();
        return $account;
    }
    
    public function index() {
        $current_account = $this->getCurrentAccount();
        $username = $current_account->nama;

        $riwayats = DaftarPoli::where('id_pasien', Auth::user()->id)->get();
        $num_of_riwayats = count($riwayats);

        return view('pasien.dashboard', compact('num_of_riwayats', 'username'));
    }

    public function showDaftarPoliLandingPage() {
        $current_account = $this->getCurrentAccount();
        $username = $current_account->nama;
        
        $dokters = User::where('role', 'dokter')->get();
        
        $riwayats = DaftarPoli::with(['periksa', 'jadwalPeriksa'])->where('id_pasien', Auth::user()->id)
            ->orderby('id', 'desc')
            ->get();

        return view('pasien.daftarpoli', compact('username', 'riwayats', 'dokters'));
    }

    public function showRiwayatLandingPage()
    {
        $current_account = $this->getCurrentAccount();
        $username = $current_account->nama;

        $riwayats = DaftarPoli::with(['periksa', 'jadwalPeriksa'])
                    ->where('id_pasien', Auth::user()->id)
                    ->whereHas('periksa', function ($query) {
                        $query->whereNotNull('catatan');
                    })
                    ->orderby('id', 'desc')
                    ->get();
        
        return view('pasien.riwayat', compact('username', 'riwayats'));
    }

    public function submitDaftarPoli(Request $request) {

        $validatedRequest = $request->validate([
            'id_pasien' => 'required|numeric',
            'id_jadwal' => 'required|numeric',
            'keluhan' => 'required|string|max:65535',
            'no_antrian' => 'required|numeric'
        ]);
        
        $new_daftar_poli = DaftarPoli::create([
            'id_pasien' => Auth::user()->id,
            'id_jadwal' => $validatedRequest['id_jadwal'],
            'keluhan' => $validatedRequest['keluhan'],
            'no_antrian' => DaftarPoli::where('id_jadwal', $request['id_jadwal'])->max('no_antrian') ?? 1
        ]);

        Periksa::create([
            'id_daftar_poli' => $new_daftar_poli->id,
            'tgl_periksa' => $request['tgl_periksa']
        ]);

        return redirect()->route('pasien-show-submit-daftar-poli');
    }
}
