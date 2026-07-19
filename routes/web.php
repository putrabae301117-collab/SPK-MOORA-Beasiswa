<?php

use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\ProsesPerhitunganController;
use App\Http\Controllers\SubKriteriaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

// Login
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    ])->group(function () { 
        Route::middleware('role:admin,guru')->group(function () {
        Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
        Route::resource('periode', PeriodeController::class);
        Route::resource('user',UserController::class);
        Route::post('periode/clear', [PeriodeController::class, 'clearPeriode'])->name('periode.clear');
    });
    
    Route::middleware('role:admin,guru')->group(function () {
    Route::resource('kriteria', KriteriaController::class)->parameters(['kriteria' => 'kriteria']);
    Route::resource('subkriteria', SubKriteriaController::class)->parameters(['subkriteria' => 'subkriteria']);

    Route::prefix('periode/{periode}')
        ->name('periode.')
        ->group(function () {
            // Alternatif
            Route::get('alternatif', [AlternatifController::class, 'index'])->name('alternatif.index');
            Route::get('alternatif/create', [AlternatifController::class, 'create'])->name('alternatif.create');
            Route::post('alternatif', [AlternatifController::class, 'store'])->name('alternatif.store');
            Route::get('alternatif/{alternatif}', [AlternatifController::class, 'show'])->name('alternatif.show');
            Route::get('alternatif/{alternatif}/edit', [AlternatifController::class, 'edit'])->name('alternatif.edit');
            Route::put('alternatif/{alternatif}', [AlternatifController::class, 'update'])->name('alternatif.update');
            Route::delete('alternatif/{alternatif}', [AlternatifController::class, 'destroy'])->name('alternatif.destroy');

            // Penilaian
            Route::get('penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');
            Route::get('penilaian/create', [PenilaianController::class, 'create'])->name('penilaian.create');
            Route::post('penilaian', [PenilaianController::class, 'store'])->name('penilaian.store');
            Route::get('penilaian/{penilaian}', [PenilaianController::class, 'show'])->name('penilaian.show');
            Route::get('penilaian/{penilaian}/edit', [PenilaianController::class, 'edit'])->name('penilaian.edit');
            Route::put('penilaian/{penilaian}', [PenilaianController::class, 'update'])->name('penilaian.update');
            Route::delete('penilaian/{penilaian}', [PenilaianController::class, 'destroy'])->name('penilaian.destroy');

            // Perhitungan MOORA
            Route::get('perhitungan', [ProsesPerhitunganController::class, 'index'])->name('perhitungan.index');
            Route::post('perhitungan/hitung', [ProsesPerhitunganController::class, 'hitung'])->name('perhitungan.hitung');
            // Hasil
            Route::get('perhitungan/hasil',[ProsesPerhitunganController::class,'hasil'])->name('perhitungan.hasil');
            Route::get('perhitungan/debug', [ProsesPerhitunganController::class, 'debug'])->name('perhitungan.debug');
        });
    });
    
    Route::middleware('role:admin')->group(function () {

    Route::prefix('periode/{periode}')
        ->name('periode.')
        ->group(function () {

           

            Route::get('perhitungan', [ProsesPerhitunganController::class, 'index'])
                ->name('perhitungan.index');

            Route::post('perhitungan/hitung', [ProsesPerhitunganController::class, 'hitung'])
                ->name('perhitungan.hitung');

            Route::get('perhitungan/hasil', [ProsesPerhitunganController::class,'hasil'])
                ->name('perhitungan.hasil');
                
            Route::get('perhitungan/laporan',[ProsesPerhitunganController::class,'laporan'])
                ->name('perhitungan.laporan');

            Route::get('perhitungan/debug', [ProsesPerhitunganController::class, 'debug'])
                ->name('perhitungan.debug');
        });
});

});
