<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;

Route::get('/', function () {
    return view('auth.login');
})->name('index');

Route::get('/login', [AuthController::class, 'showLogin'])->name('show-login');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); 

Route::get('/register', [AuthController::class, 'showRegister'])->name('show-register');

Route::post('/register', [AuthController::class, 'register'])->name('register');


Route::middleware('auth')->group(function () {
    Route::middleware('role:pasien')->group(function () {{
            Route::get('/pasien', [PasienController::class, 'index'])->name('pasien-dashboard');

            Route::get('/pasien/periksa', [PasienController::class, 'makeAppointment'])->name('pasien-make-appointment');

            Route::post('/pasien/periksa', [PasienController::class, 'submitAppointment'])->name('pasien-submit-appointment');

            Route::get('/pasien/riwayat', [PasienController::class, 'showRiwayat'])->name('pasien-riwayat');
    }});

    Route::middleware('role:dokter')->group(function () {
            Route::get('/dokter', [DokterController::class, 'index'])->name('dokter-dashboard');

            Route::get('/dokter/periksa', [DokterController::class, 'periksa'])->name('dokter-periksa');
            
            Route::get('/dokter/periksa/{id}', [DokterController::class, 'periksaPasien'])->name('dokter-periksa-pasien');
            
            Route::post('/dokter/periksa/{id}', [DokterController::class, 'createDetailPeriksa'])->name('dokter-create-detail-periksa');

            Route::get('/dokter/obat', [DokterController::class, 'showObat'])->name('dokter-obat');

            Route::post('/dokter/obat', [DokterController::class, 'storeObat'])->name('dokter-obat-store');

            Route::get('/dokter/obat/edit/{id}', [DokterController::class, 'editObat'])->name('dokter-obat-edit');

            Route::put('/dokter/obat/update/{id}', [DokterController::class, 'updateObat'])->name('dokter-obat-update');

            Route::delete('/dokter/obat/delete/{id}', [DokterController::class, 'destroyObat'])->name('dokter-obat-delete');
    });
});




