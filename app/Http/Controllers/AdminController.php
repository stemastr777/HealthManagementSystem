<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dokter;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Poli;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    
    public function index() {
        $num_of_registered_obat = count(Obat::all());
        $num_of_registered_dokter = count(Dokter::all());
        $num_of_registered_poli = count(Poli::all());
        $num_of_registered_pasien = count(Pasien::all());

        return view('admin.dashboard', compact('num_of_registered_obat', 'num_of_registered_dokter', 'num_of_registered_pasien', 'num_of_registered_poli'));
    }

    public function showDokterLandingPage() {
        $dokters = Dokter::with(['user', 'polis'])->get();
        $polis = Poli::where('is_active', 'true')->get();

        return view('admin.dokter', compact('dokters', 'polis'));
    }

    public function showEditDokterPage($id_dokter){
        $dokters = Dokter::with(['user', 'polis'])->get();
        $polis = Poli::where('is_active', 'true')->get();
        $dokter_in_edit = Dokter::find($id_dokter);

        return view('admin.dokter', compact('dokters', 'polis', 'dokter_in_edit'));
    }

    public function updateOrCreateDokter(Request $request) {

        $validatedRequest = $request->validate([
            'nama' => 'string|required',
            'alamat' => 'string|required',
            'no_hp' => 'string|required',
            'password' => 'string|required',
            'id_poli' => ['required'],
        ]);

        $new_account = User::updateOrCreate(
            ['nama' => $validatedRequest['nama']],
            [
            'nama' => $validatedRequest["nama"],
            'alamat' => $validatedRequest["alamat"],
            'no_hp' => $validatedRequest["no_hp"],
            'password' => $validatedRequest["password"],
            'role' => 'dokter'
        ]);

        $new_dokter = Dokter::updateOrCreate(
            ['user_id' => $new_account->id],
            [
            'user_id' => $new_account->id,
            'id_poli' => $validatedRequest['id_poli']
        ]);

        return redirect()->route('admin-show-dokter');
    }

    public function deleteDokter($id_dokter) {
        User::find($id_dokter)->update(
            ['is_active' => 'false']
        );

        return redirect()->route('admin-show-dokter');
    }

    public function showPasienLandingPage()
    {
        $pasiens = Pasien::with(['users'])
            ->whereHas('users', function ($query) {
                $query->where('is_active', 'true');
            })
            ->get();
        return view('admin.pasien', compact('pasiens'));
    }

    public function updateOrCreatePasien(Request $request) {
        $validatedRequest = $request->validate([
            'nama' => 'string|required',
            'alamat' => 'string|required',
            'no_hp' => 'string|required',
            'password' => 'string|required',
            'no_ktp' => 'numeric|required'
        ]);

        $new_account = User::updateOrCreate(
            ['nama' => $validatedRequest["nama"]],
            [
            'nama' => $validatedRequest["nama"],
            'alamat' => $validatedRequest["alamat"],
            'no_hp' => $validatedRequest["no_hp"],
            'password' => Hash::make($validatedRequest['password']),
            'role' => 'pasien'
        ]);

        $pasien = Pasien::find($new_account->id);
        if ($pasien) {
            $new_no_rm = $pasien->no_rm; 
        } else {
            $no_rm_prefix = Carbon::now()->format('Ym');
            $last_no_rm = Pasien::where('no_rm', 'like', $no_rm_prefix . '%')
                ->orderBy('no_rm', 'desc')
                ->pluck('no_rm')
                ->first();

            if (is_null($last_no_rm)) {
                $new_no_rm = $no_rm_prefix . '-0001';
            } else {
                $new_no_rm = $no_rm_prefix . '-' . str_pad((int) substr($last_no_rm, 7) + 1, 4, '0', STR_PAD_LEFT);
            }
        }

        $new_pasien = Pasien::updateOrCreate(
            ['user_id' => $new_account->id],
            [
            'user_id' => $new_account->id, 
            'no_ktp' => $validatedRequest["no_ktp"],
            'no_rm' =>  $new_no_rm
        ]);
        return redirect()->route('admin-show-pasien');
    }

    public function showEditPasienPage($id_pasien) {
        $pasiens = Pasien::where('is_active', 'true')->get();
        $pasien_in_edit = Pasien::with('users')->find($id_pasien);

        return view('admin.pasien', compact('pasiens', 'pasien_in_edit'));
    }

    public function deletePasien($id_pasien) {

        User::find($id_pasien)->update(['is_active' => 'false']);
        return redirect()->route('admin-show-pasien');
    }


    
    public function updateOrCreatePoli(Request $request) {
        $validatedRequest = $request->validate(
            [
                'nama_poli' => 'string|required',
                'keterangan' => 'string'
            ]
        );
        
        $new_poli = Poli::updateOrCreate(
            ['nama_poli' => $validatedRequest['nama_poli']],
            [
                'nama-poli' => $validatedRequest['nama_poli'],
                'keterangan' => $validatedRequest['keterangan']
            ]
        );

        return redirect()->route('admin-show-poli');
    }

    public function showEditPoliPage($id_poli) {
        $polis = Poli::where('is_active', 'true')->get();
        $poli_in_edit = Poli::find($id_poli);
        return view('admin.poli', compact('polis', 'poli_in_edit'));
    }

    public function deletePoli($id_poli) {
        $will_be_deleted_poli = Poli::find($id_poli);
        $will_be_deleted_poli->update(
            ['is_active' => 'false']
        );
        return redirect()->route('admin-show-poli');
    }

    public function showPoliLandingPage() {
        $polis = Poli::where('is_active', 'true')->get();
        return view('admin.poli', compact('polis'));
    }
    


    public function showObatLandingPage() {
        $obats = Obat::where('is_active', 'true')->get();
        return view('admin.obat', compact('obats'));
    }

    public function showEditObatPage($id_obat) {
        $obat_in_edit = Obat::find($id_obat);
        $obats = Obat::where('is_active', 'true')->get();
        return view('admin.obat', compact('obats', 'obat_in_edit'));
    }

    public function updateOrCreateObat(Request $request)
    {
        $validatedRequest = $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string|max:255',
            'harga' => 'required|numeric',
        ]);

        Obat::updateOrCreate(
            ['nama_obat' => $validatedRequest['nama_obat']],
            [
                'nama_obat' => $validatedRequest['nama_obat'],
                'kemasan' => $validatedRequest['kemasan'],
                'harga' => $validatedRequest['harga'],
            ]
        );

        return redirect()->route('admin-show-obat');
    }

    public function deleteObat($id_obat)
    {
        $obat = Obat::findOrFail($id_obat);
        $obat->update(
            ['is_active' => 'false']
        );

        return redirect()->route('admin-show-obat');
    }
}
