<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;

Route::get('/', function () {
    return view('auth.login');
})->name('index');

Route::get('/login', [AuthController::class, 'showLoginPage'])->name('show-login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); 

Route::get('/register', [AuthController::class, 'showRegisterPage'])->name('show-register');
Route::post('/register', [AuthController::class, 'register'])->name('register');


Route::middleware('auth')->group(function () {

    Route::middleware('role:admin')->group(function () {{
        Route::get('/admin', [AdminController::class, 'index'])->name('admin-dashboard');
        
        Route::get('/admin/dokter', [AdminController::class, 'showDokterLandingPage'])->name('admin-show-dokter');
        Route::post('/admin/dokter', [AdminController::class, 'updateOrCreateDokter'])->name('admin-update-or-create-dokter');
        Route::get('/admin/dokter/{id_dokter}', [AdminController::class, 'showEditDokterPage'])->name('admin-edit-dokter');
        Route::delete('/admin/dokter/{id_dokter}', [AdminController::class, 'deleteDokter'])->name('admin-delete-dokter');

        Route::get('/admin/pasien', [AdminController::class, 'showPasienLandingPage'])->name('admin-show-pasien');
        Route::post('/admin/pasien', [AdminController::class, 'updateOrCreatePasien'])->name('admin-update-or-create-pasien');
        Route::get('/admin/pasien/{id_pasien}', [AdminController::class, 'showEditPasienPage'])->name('admin-edit-pasien');
        Route::delete('/admin/pasien/{id_pasien}', [AdminController::class, 'deletePasien'])->name('admin-delete-pasien');
        
        Route::get('/admin/poli', [AdminController::class, 'showPoliLandingPage'])->name('admin-show-poli');
        Route::post('/admin/poli', [AdminController::class, 'updateOrCreatePoli'])->name('admin-update-or-create-poli');
        Route::get('/admin/poli/{id_poli}', [AdminController::class, 'showEditPoliPage'])->name('admin-edit-poli');
        Route::delete('/admin/poli/{id_poli}', [AdminController::class, 'deletePoli'])->name('admin-delete-poli');

        Route::get('/admin/obat', [AdminController::class, 'showObatLandingPage'])->name('admin-show-obat');
        Route::post('/admin/obat', [AdminController::class, 'updateOrCreateObat'])->name('admin-update-or-create-obat');
        Route::get('/admin/obat/{id_obat}', [AdminController::class, 'showEditObatPage'])->name('admin-edit-obat');
        Route::delete('/admin/obat/{id_obat}', [AdminController::class, 'deleteObat'])->name('admin-delete-obat');
    
    }});

    Route::middleware('role:pasien')->group(function () {{
            Route::get('/pasien', [PasienController::class, 'index'])->name('pasien-dashboard');

            Route::get('/pasien/daftar-poli', [PasienController::class, 'showDaftarPoliLandingPage'])->name('pasien-show-daftar-poli');
            Route::post('/pasien/daftar-poli', [PasienController::class, 'submitDaftarPoli'])->name('pasien-submit-daftar-poli');

            Route::get('/pasien/riwayat', [PasienController::class, 'showRiwayatLandingPage'])->name('pasien-show-riwayat');
    }});

    Route::middleware('role:dokter')->group(function () {
            Route::get('/dokter', [DokterController::class, 'index'])->name('dokter-dashboard');
            
            Route::get('/dokter/jadwal-periksa', [DokterController::class, 'showJadwalPeriksaLandingPage'])->name('dokter-show-jadwal-periksa');
            Route::post('/dokter/jadwal-periksa/new', [DokterController::class, 'addJadwalPeriksa'])->name('dokter-add-jadwal-periksa');
            Route::put('/dokter/jadwal-periksa/{id_periksa}', [DokterController::class, 'activateJadwalPeriksa'])->name('dokter-activate-jadwal-periksa');
            Route::put('/dokter/jadwal-periksa', [DokterController::class, 'clearActiveJadwalPeriksa'])->name('dokter-clear-jadwal-periksa');
            

            Route::get('/dokter/periksa', [DokterController::class, 'showPeriksaLandingPage'])->name('dokter-show-periksa');
            Route::get('/dokter/periksa/{id}', [DokterController::class, 'examinePasien'])->name('dokter-periksa-pasien');
            Route::post('/dokter/periksa/{id}', [DokterController::class, 'createDetailPeriksa'])->name('dokter-create-detail-periksa');

            Route::get('/dokter/profile', [DokterController::class, 'showProfileLandingPage'])->name('dokter-show-profile');
            Route::put('/dokter/update-profile', [DokterController::class, 'updateProfile'])->name('dokter-update-profile');
        });
});




