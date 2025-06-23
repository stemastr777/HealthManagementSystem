<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;
use App\Models\Periksa;
use App\Models\Poli;
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

        $riwayats = DaftarPoli::with(['periksa'])
            ->where('id_pasien', Auth::user()->id)
            ->whereHas('periksa', function ($query) {
                $query->whereNotNull('catatan');
            })
            ->get();

        $appointments = DaftarPoli::with(['periksa'])
            ->where('id_pasien', Auth::user()->id)
            ->whereHas('periksa', function ($query) {
                $query->whereNull('catatan');
            })
            ->get();

        $num_of_riwayats = count($riwayats);
        $num_of_incoming_periksa = count($appointments);

        return view('pasien.dashboard', compact('num_of_riwayats', 'num_of_incoming_periksa', 'username'));
    }

    public function showDaftarPoliLandingPage() {
        $current_account = $this->getCurrentAccount();
        $username = $current_account->nama;
        
        $polis = Poli::where('is_active', 'true')->get();

        $riwayats = DaftarPoli::with(['periksa', 'jadwalPeriksa'])
            ->where('id_pasien', Auth::user()->id)
            ->whereHas('periksa', function ($query) {
                $query->whereNull('catatan');
            })
            ->orderby('id', 'desc')
            ->get();

        return view('pasien.daftarpoli', compact('username', 'riwayats', 'polis'));
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
            'id_dokter' => 'required',
            'keluhan' => 'required|string|max:65535',
            'tgl_periksa' => 'required'
        ]);

        $hari_mulai_akhir = explode(' ', $request->jadwal_periksa); 
        $id_selected_jadwal = JadwalPeriksa::where([
            'hari' => $hari_mulai_akhir[0],
            'jam_mulai' => $hari_mulai_akhir[1],
            'jam_selesai' => $hari_mulai_akhir[2],
            'id_dokter' => $validatedRequest["id_dokter"]
        ])->pluck('id')->first();


        $tgl_periksa = $validatedRequest['tgl_periksa'];
        // Step 1: Check if a matching DaftarPoli exists with tgl_periksa via the periksa relation
        $existing = DaftarPoli::where('id_pasien', Auth::user()->id)
            ->where('id_jadwal', $id_selected_jadwal)
            ->whereHas('periksa', function ($query) use ($tgl_periksa) {
                $query->where('tgl_periksa', $tgl_periksa);
            })
            ->first();

        // Step 2: Update or create
        if ($existing) {
            $existing->update([
                'keluhan' => $validatedRequest['keluhan'],
            ]);
            $new_daftar_poli = $existing;
        } else {
            $new_daftar_poli = DaftarPoli::create([
                'id_pasien' => Auth::user()->id,
                'id_jadwal' => $id_selected_jadwal,
                'keluhan' => $validatedRequest['keluhan'],
                'no_antrian' => DaftarPoli::where('id_jadwal', $id_selected_jadwal)->max('no_antrian') + 1 ?? 1,
            ]);
        }

        Periksa::updateOrCreate(
            ['id_daftar_poli' => $new_daftar_poli->id],
            [
            'id_daftar_poli' => $new_daftar_poli->id,
            'tgl_periksa' => $request['tgl_periksa']
        ]);

        return redirect()->route('pasien-show-daftar-poli');
    }
}
