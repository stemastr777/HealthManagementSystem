<?php

namespace App\Http\Controllers;

use App\Models\DetailPeriksa;
use App\Models\Obat;
use App\Models\Periksa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DokterController extends Controller
{

    public function index()
    {
        $dokter = User::where('id', Auth::user()->id)->first();
        $nama_dokter = $dokter->nama;

        $banyak_obat = count(Obat::all());
        $banyak_pasien = Periksa::where('tgl_periksa', '>', now())->count();
        return view('dokter.dashboard', compact('banyak_obat', 'banyak_pasien', 'nama_dokter'));
    }
    
    public function periksa() {
        $dokter = User::where('id', Auth::user()->id)->first();
        $nama_dokter = $dokter->nama;

        $periksas = Periksa::where('id_dokter', Auth::user()->id)
                    ->orderby('tgl_periksa', 'desc')
                    ->get();
    
        return view('dokter.periksa', compact('nama_dokter', 'periksas'));
    }

    public function periksaPasien($id) {
        $dokter = User::where('id', Auth::user()->id)->first();
        $nama_dokter = $dokter->nama;

        $periksa = Periksa::find($id);
        $obats = Obat::all();

        $selected_obats = DetailPeriksa::where('id_periksa', $id)->pluck('id_obat')->toArray();

        return view('dokter.editPeriksa', compact('nama_dokter', 'periksa', 'obats', 'selected_obats'));
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

        return redirect()->route('dokter-periksa');
    }

    public function showObat()
    {

        $dokter = User::where('id', Auth::user()->id)->first();
        $nama_dokter = $dokter->nama;

        $obats = Obat::all();
        return view('dokter.obat', compact('obats', 'nama_dokter'));
    }

    public function storeObat(Request $request)
    {
        $validateData = $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string|max:255',
            'harga' => ['required']
        ]);

        Obat::create([
            'nama_obat' => $validateData['nama_obat'],
            'kemasan' => $validateData['kemasan'],
            'harga' => $validateData['harga']
        ]);

        return redirect()->route('dokter-obat');
    }

    public function updateObat(Request $request, $id)
    {

        $validatedData = $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string|max:255',
            'harga' => ['required'],
        ]);

        $obat = Obat::findOrFail($id);

        $obat->update([
            'nama_obat' => $validatedData['nama_obat'],
            'kemasan' => $validatedData['kemasan'],
            'harga' => $validatedData['harga'],
        ]);

        return redirect()->route('dokter-obat');
    }

    public function destroyObat($id)
    {

        $obat = Obat::findOrFail($id);
        $obat->delete();

        return redirect()->route('dokter-obat');
    }

    public function editObat($id)
    {

        $dokter = User::where('id', Auth::user()->id)->first();
        $nama_dokter = $dokter->nama;

        $obat = Obat::findOrFail($id);
        return view('dokter.obatEdit', compact('obat', 'nama_dokter'));
    }
}
