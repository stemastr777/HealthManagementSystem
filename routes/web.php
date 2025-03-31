<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->name('home');


Route::get('/login', function () {
    return view('auth.login');
});


Route::get('/register', function () {
    return view('auth.register');
});


Route::get('/pasien', function () {
    return view('pasien.dashboard');
})->name('pasien-dashboard');


Route::get('/pasien/periksa', function () {
    return view('pasien.periksa');
})->name('pasien-periksa');


Route::get('/pasien/riwayat', function () {
    return view('pasien.riwayat');
})->name('pasien-riwayat');

Route::get('/dokter', function () {
    return view('dokter.dashboard');
})->name('dokter-dashboard');

Route::get('/dokter/periksa', function () {
    return view('dokter.periksa');
})->name('dokter-periksa');

Route::get('/dokter/obat', function () {
    return view('dokter.obat');
})->name('dokter-obat');
