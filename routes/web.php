<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;

Route::get('/', function () {
    return view('layout');
})->name('home');


Route::get('/login', function () {
    return view('auth.login');
});


Route::get('/register', function () {
    return view('auth.register');
});


Route::get('/pasien', [PasienController::class, 'index'])->name('pasien-dashboard');

Route::get('/pasien/periksa', [PasienController::class, 'makeAppointment'])->name('pasien-make-appointment');

Route::post('/pasien/periksa', [PasienController::class, 'submitAppointment'])->name('pasien-submit-appointment');

Route::get('/pasien/riwayat', [PasienController::class, 'showRiwayat'])->name('pasien-riwayat');


Route::get('/dokter', [DokterController::class, 'index'])->name('dokter-dashboard');

Route::get('/dokter/periksa', [DokterController::class, 'periksa'])->name('dokter-periksa');

Route::get('/dokter/obat', [DokterController::class, 'showObat'])->name('dokter-obat');

Route::post('/dokter/obat', [DokterController::class, 'storeObat'])->name('dokter-obat-store');

Route::get('/dokter/obat/edit/{id}', [DokterController::class, 'editObat'])->name('dokter-obat-edit');

Route::put('/dokter/obat/update/{id}', [DokterController::class, 'updateObat'])->name('dokter-obat-update');

Route::delete('/dokter/obat/delete/{id}', [DokterController::class, 'destroyObat'])->name('dokter-obat-delete');


