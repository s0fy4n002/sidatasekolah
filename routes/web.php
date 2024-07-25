<?php

use App\Http\Controllers\AdminKotaController;
use App\Http\Controllers\AdminSekolahController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SuperAdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware(['auth'])->group(function(){
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');

    Route::get('/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
    Route::post('/siswa/store', [SiswaController::class, 'store'])->name('siswa.store');

    Route::get('/siswa/edit/{id}', [SiswaController::class, 'edit'])->name('siswa.edit');
    Route::get('/siswa/show/{id}', [SiswaController::class, 'show'])->name('siswa.show');
    Route::put('/siswa/update/{id}', [SiswaController::class, 'update'])->name('siswa.update');
    
    Route::delete('/siswa/{id}/destroy', [SiswaController::class, 'destroy'])->name('siswa.destroy');
    

});
Route::get('export-datasiswa', [AdminSekolahController::class, 'exportDataSiswa'])->name('export.datasiswa');
Route::get('export-lulusan-sekolah', [AdminSekolahController::class, 'export'])->name('export.lulusan.sekolah');

Route::middleware(['auth','isadmin'])->group(function(){
    
    Route::resource('admin-kota', AdminKotaController::class);
    Route::resource('admin-sekolah', AdminSekolahController::class);
    Route::get('admin-sekolah-ubah-password', [AdminSekolahController::class, 'ubahPassword'])->name('sekolah-ubah-password');
    Route::post('admin-sekolah-ubah-password', [AdminSekolahController::class, 'prosesUbahPassword'])->name('sekolah-ubah-password-proses');
    Route::get('admin-sekolah-generate', [AdminSekolahController::class, 'generate'])->name('admin-sekolah.generate');
    Route::get('admin-kota-generate', [AdminKotaController::class, 'generate'])->name('admin-kota.generate');
    Route::get('export-lulusan-kota', [AdminKotaController::class, 'export'])->name('export.lulusan.kota');

    Route::get('admin-sekolah-datasiswa', [AdminSekolahController::class, 'generateDataSiswa'])->name('admin-sekolah.datasiswa');
    Route::get('admin-sekolah-resetPassword/{id}', [AdminSekolahController::class, 'resetPassword'])->name('admin.sekolah.resetPassword');
   
    Route::get('admin-kota-sekolah-detail/{id_sekolah}', [AdminKotaController::class, 'showSekolahByIdSekolah'])->name('admin-kota.sekolah.detail');
    Route::get('admin-kota-save-admin-sekolah', [AdminKotaController::class, 'saveAdminSekolah'])->name('admin-kota.saveAdminSekolah');
    Route::get('super-admin', [SuperAdminController::class, 'index'])->name('super-admin.index');
    Route::get('super-admin/showAdminKota{id}', [SuperAdminController::class, 'showAdminKota'])->name('super-admin.showAdminKota');
    Route::get('super-admin/edit/{id}', [SuperAdminController::class, 'editAdminKota'])->name('super-admin.editAdminKota');
    Route::put('super-admin/update/{id}', [SuperAdminController::class, 'updateAdminKota'])->name('super-admin.updateAdminKota');
    Route::get('super-admin/createAdminKota', [SuperAdminController::class, 'createAdminKota'])->name('super-admin.createAdminKota');
    Route::post('super-admin/storeAdminKota', [SuperAdminController::class, 'storeAdminKota'])->name('super-admin.storeAdminKota');
    Route::get('super-admin/listSekolah/{kota_id}', [SuperAdminController::class, 'listSekolah'])->name('super-admin.listSekolah');
    Route::get('super-admin/viewSiswa/{kota_id}', [SuperAdminController::class, 'viewSiswa'])->name('super-admin.viewSiswa');

});

// Route::get('/fakultas', [AdminSekolahController::class, 'fakultas'])->name('fakultas');
// Route::post('/fakultas-save', [AdminSekolahController::class, 'savefakultas'])->name('fakultas-save');
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::post('/login-proses', [HomeController::class, 'login_process'])->name('login_proses');
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
