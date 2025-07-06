<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\OrangtuaController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\UserController;
use App\Exports\PendaftaranExport;
use Maatwebsite\Excel\Facades\Excel;

// Halaman Utama (Tanpa Login)
Route::get('/', function () {
    return view('index');
});
Route::get('/ekstrakurikuler', function () {
    return view('eskul');
})->name('ekstrakurikuler');


// ✅ Route untuk Admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/export/diterima/pdf', [PendaftaranController::class, 'exportSemuaDiterima'])->name('export.diterima.pdf');
    Route::get('/export/diterima/excel', [PendaftaranController::class, 'exportDiterimaExcel'])->name('export.diterima.excel');
    Route::get('/pendaftaran/diterima', [PendaftaranController::class, 'showDiterima'])->name('pendaftaran.diterima');
    Route::get('/export-pendaftar-pdf', [PendaftaranController::class, 'exportPdf'])->name('pendaftaran.export.pdf');
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
     Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::post('/admin/users/{id}/update-role', [UserController::class, 'updateRole'])->name('admin.users.updateRole');

    // Profile
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Pendaftaran
    Route::resource('pendaftaran', PendaftaranController::class);
    Route::post('/pendaftaran/{id}/update-status', [PendaftaranController::class, 'updateStatus'])->name('pendaftaran.updateStatus');


});

// ✅ Route untuk User (CPD)
Route::middleware(['auth'])->group(function () {
    Route::middleware('cek.pendaftaran')->group(function () {
        Route::get('/ppdb/step1', [DashboardController::class, 'step1'])->name('ppdb.step1');
        Route::post('/ppdb/storeStep1', [DashboardController::class, 'storeStep1'])->name('ppdb.storeStep1');
    });

    Route::get('/ppdb/step2', [DashboardController::class, 'step2'])->name('ppdb.step2');
    Route::post('/ppdb/storeStep2', [DashboardController::class, 'storeStep2'])->name('ppdb.storeStep2');

    Route::get('/ppdb/step3', [DashboardController::class, 'step3'])->name('ppdb.step3');
    Route::post('/ppdb/storeStep3', [DashboardController::class, 'storeStep3'])->name('ppdb.storeStep3');
    Route::get('/status-pendaftaran', [DashboardController::class, 'status'])->name('status.pendaftaran');
    Route::get('/download-pdf/{id}', [DashboardController::class, 'downloadPDF'])->name('download.pdf');
    Route::get('/ppdb/success', [DashboardController::class, 'success'])->name('ppdb.success');
});

// ✅ Autentikasi
require __DIR__ . '/auth.php';
