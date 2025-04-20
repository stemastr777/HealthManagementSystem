<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Periksa;
use App\Models\User;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    protected $userID = 5;

    public function __construct()
    {
        $this->userID;
    }

    public function index()
    {
        $dokter = User::where('id', $this->userID)->first();
        $nama_dokter = $dokter->nama;

        $banyak_obat = count(Obat::all());
        $banyak_pasien = Periksa::where('tgl_periksa', '>', now())->count();
        return view('dokter.dashboard', compact('banyak_obat', 'banyak_pasien', 'nama_dokter'));
    }
    
    public function periksa() {
        $dokter = User::where('id', $this->userID)->first();
        $nama_dokter = $dokter->nama;

        $periksas = Periksa::where('id_dokter', $this->userID)
                    ->orderby('tgl_periksa', 'desc')
                    ->get();

        return view('dokter.periksa', compact('nama_dokter', 'periksas'));
    }

    public function showObat()
    {

        $dokter = User::where('id', $this->userID)->first();
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

        $dokter = User::where('id', $this->userID)->first();
        $nama_dokter = $dokter->nama;

        $obat = Obat::findOrFail($id);
        return view('dokter.obatEdit', compact('obat', 'nama_dokter'));
    }
}
