<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use App\Models\DetailPeriksa;
use App\Models\Dokter;
use App\Models\JadwalPeriksa;
use App\Models\Obat;
use App\Models\Periksa;
use App\Models\User;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DokterController extends Controller
{

    private function getCurrentAccount() {
        $account = User::where('id', Auth::user()->id)->first();
        return $account;
    }

    public function index() {
        $current_account = $this->getCurrentAccount();
        $username = $current_account->nama;

        $num_of_available_obat = count(Obat::all());

        $num_of_unchecked_pasien = Periksa::with('daftarPolis.jadwalPeriksa')
            ->whereNull('catatan')
            ->whereHas('daftarPolis.jadwalPeriksa', function ($query) use ($current_account) {
                $query->where('id_dokter', $current_account->id);
            })
            ->get()
            ->count();

        return view('dokter.dashboard', compact('num_of_unchecked_pasien', 'username'));
    }
    
    public function showPeriksaLandingPage() {
        $current_account = $this->getCurrentAccount();        
        $username = $current_account->nama;

        $periksas = Periksa::with(['daftarPolis.jadwalPeriksa'])
                ->whereHas('daftarPolis.jadwalPeriksa', function ($query) use ($current_account) {
                    $query->where('id_dokter', $current_account->id);
                })                
                ->orderby('tgl_periksa', 'desc')
                ->get();
    
        return view('dokter.periksa', compact('username', 'periksas'));
    }

    public function examinePasien($id) {
        $current_account = $this->getCurrentAccount();        
        $username = $current_account->nama;

        $periksa = Periksa::with('daftarPolis.pasiens')->find($id);
        $obats = Obat::all();

        $id_pasien = $periksa->daftarPolis->pasiens->id;
        $riwayats_pasien = DaftarPoli::with(['periksa', 'jadwalPeriksa'])
                    ->where('id_pasien', $id_pasien)
                    ->whereHas('periksa', function ($query) {
                        $query->whereNotNull('catatan');
                    })
                    ->orderby('id', 'desc')
                    ->get();
        
        return view('dokter.editPeriksa', compact('username', 'periksa', 'obats', 'riwayats_pasien'));
    }

    public function createDetailPeriksa(Request $request, $id) {
        
        Periksa::updateOrCreate(
            ['id' => $id], 
            [
                'catatan' => $request['catatan'],
                'biaya_periksa' => $request['biaya_periksa']
        ]);

        $in_db = DetailPeriksa::where('id_periksa', $id)->get();
        foreach ($in_db as $model_in_db) {
            if (in_array($model_in_db->id_obat, $request->obats)) {
                $model_in_db->touch();
            } else {
                $model_in_db->delete();     
            }
        }

        $obat_in_db = DetailPeriksa::where('id_periksa', $id)->pluck('id_obat')->toArray();
        foreach ($request->obats as $obat) {
            if (!in_array($obat, $obat_in_db)) {
                DetailPeriksa::create([
                    'id_periksa' => $id,
                    'id_obat' => $obat
                ]);
            }
        }

        return redirect()->route('dokter-show-periksa');
    }


    public function showProfileLandingPage() {
        $current_account = Dokter::with(['user', 'polis'])
                    ->where('user_id', Auth::user()->id)
                    ->first();

        $polis = Poli::all();

        return view('dokter.profile', compact('current_account', 'polis'));
    }

    public function updateProfile(Request $req) {

        $validatedRequest = $req->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'id_poli' => 'required|numeric'
        ]);

        $profile = User::find(Auth::user()->id);

        $profile->update([
            'nama' => $validatedRequest['nama'],
            'alamat' => $validatedRequest['alamat'],
            'no_hp' => $validatedRequest['no_hp'],
            'password' => $validatedRequest['password']
        ]);

        Dokter::find(Auth::user()->id)->update([
            'id_poli' => $validatedRequest['id_poli']
        ]);

        return redirect()->route('dokter-dashboard');
    }

    public function showJadwalPeriksaLandingPage() {
        $current_account = Dokter::with('user')->where('user_id', Auth::user()->id)->first();
        
        $jadwals = JadwalPeriksa::with('dokter')->where('id_dokter', Auth::user()->id)->get();

        return view('dokter.showJadwalPeriksa', compact('jadwals', 'current_account'));
    }

    public function addJadwalPeriksa(Request $request) {
        $validatedRequest = $request->validate([
            'hari' => 'required|string',
            'jam_mulai' => 'required|string',
            'jam_selesai' => 'required|string'
        ]);

        $new_jadwal = JadwalPeriksa::firstOrCreate([
            'id_dokter' => Auth::user()->id,
            'hari' => $validatedRequest['hari'],
            'jam_mulai' => $validatedRequest['jam_mulai'],
            'jam_selesai' => $validatedRequest['jam_selesai'],
        ]);

        return $this->activateJadwalPeriksa($new_jadwal->id);
    }

    public function activateJadwalPeriksa($id) {

        $old_jadwal = JadwalPeriksa::where(['is_active' => 'true', 'id_dokter' => $this->getCurrentAccount()->id]);
        $old_jadwal->update(['is_active' => 'false']);

        $new_jadwal = JadwalPeriksa::where('id', $id);
        $new_jadwal->update(['is_active' => 'true']);

        return redirect()->route('dokter-show-jadwal-periksa');
    }

    
}
