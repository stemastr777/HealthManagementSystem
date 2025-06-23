<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Pasien;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function showLoginPage() {
        return view('auth.login');
    }

    public function showRegisterPage() {
        return view('auth.register');
    }

    public function login(Request $request) {

        $credentials = $request->validate([
            'nama' => ['required'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            if ($user->role === 'dokter') {
                return redirect()->route('dokter-dashboard');
            } else if ($user->role === 'pasien') {
                return redirect()->route('pasien-dashboard');
            } else if ($user->role === 'admin') {
                return redirect()->route('admin-dashboard');
            } else {
                return redirect()->route('login');
            }
        }

        return back();
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return  redirect()->route('show-login');
    }

    public function register(Request $request) {

        $validatedRequest = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:255',
            'no_ktp' => 'required|numeric',
            'password' => 'required|string|max:255',
            'role' => 'required|string|max:255',
        ]);

        $new_account = User::updateOrCreate(
            ['nama' => $validatedRequest['nama']],
            [
                'nama' => $validatedRequest['nama'],
                'alamat' => $validatedRequest['alamat'],
                'no_hp' => $validatedRequest['no_hp'],
                'password' => Hash::make($validatedRequest['password']),
                'role' => $validatedRequest['role'],
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

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
            ]
        );

        return redirect()->route('show-login');
    }
}
