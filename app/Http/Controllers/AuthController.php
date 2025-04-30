<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function showLogin() {
        return view('auth.login');
    }

    public function showRegister() {
        return view('auth.register');
    }

    public function login(Request $request) {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            if ($user->role === 'dokter') {
                return redirect()->route('dokter-dashboard');
            } else if ($user->role === 'pasien') {
                return redirect()->route('pasien-dashboard');
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

        $new_user = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'role' => 'required|string|max:255',
        ]);

        User::updateOrCreate(
            ['email' => $new_user['email']],
            [
                'nama' => $new_user['nama'],
                'alamat' => $new_user['alamat'],
                'no_hp' => $new_user['no_hp'],
                'email' => $new_user['email'],
                'password' => Hash::make($new_user['password']),
                'role' => $new_user['role'],
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        return redirect()->route('show-login');
    }
}
