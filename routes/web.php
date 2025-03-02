<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataDistribusiController;
use App\Http\Controllers\DistribusiController;
use App\Http\Controllers\KlpcmController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PolyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect("/login");
});

Route::get("/login", [AuthController::class, "login"])->name('login.view');
Route::post("/login", [AuthController::class, "authenticate"])->name('login');


Route::middleware("auth")->group(function () {
    Route::get("dashboard", [DashboardController::class, "index"])->name('dashboard');
    Route::resource("user", UserController::class);
    Route::resource("rekam-medis", DistribusiController::class);

    Route::get("rekam-medis/detail/laporan", [DistribusiController::class, "laporan"])->name('rekam-medis.laporan');
    Route::post("rekam-medis/detail/laporan-pdf", [DistribusiController::class, "exportLaporan"])->name('rekam-medis.laporan.pdf');



    Route::resource("/data/distribusi", DataDistribusiController::class);

    Route::resource('pasien', PasienController::class);
    Route::get('pasien/download/templates', [PasienController::class, 'downloadTemplates'])->name('pasien.download');


    Route::post('/api/pasien/search', [PasienController::class, 'search'])->name('pasien.search');


    Route::put("/data/distribusi/update-status/{id}", [DataDistribusiController::class, "updateStatusKembali"])->name('data-distribusi.update.status.kembali');

    Route::get("data/distribusi/detail/laporan", [DataDistribusiController::class, "laporan"])->name('data-distribusi.laporan');
    Route::post("data/distribusi/detail/laporan-pdf", [DataDistribusiController::class, "laporanExport"])->name('data-distribusi.laporan-pdf');


    Route::put("/data/distribusi/update-status-pemeriksaan/{id}", [DataDistribusiController::class, "updateStatusPemeriksaan"])->name('data-distribusi.update.status.pemeriksaan');
    Route::post("/data/distribusi/send-notifikasi/{id}", [DataDistribusiController::class, "sendNotifikasi"])->name('data-distribusi.send-notifikasi');
    Route::post("/data/distribusi/send-notifikasi/belum-kembali/{id}", [DataDistribusiController::class, "sendNotifikasiBelumLengkap"])->name('data-distribusi.send-notifikasi-belum-kembali');

    Route::resource("klpcm", KlpcmController::class);
    Route::post("logout", [AuthController::class, "logout"])->name('logout');


    Route::resource('perawat', PolyController::class);


    Route::post("/poly/search", [PolyController::class, "searchByPoly"]);
});
