<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataDistribusiController;
use App\Http\Controllers\DistribusiController;
use App\Http\Controllers\KlpcmController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/login" , [AuthController::class , "login"])->name('login.view');
Route::post("/login" , [AuthController::class , "authenticate"])->name('login');


Route::middleware("auth")->group(function(){
    Route::get("dashboard" , [DashboardController::class , "index"])->name('dashboard');
    Route::resource("user" , UserController::class);
    Route::resource("rekam-medis" , DistribusiController::class);
    Route::resource("/data/distribusi" , DataDistribusiController::class);
    Route::resource("klpcm" , KlpcmController::class);



    Route::post("logout" , [AuthController::class , "logout"])->name('logout');

});
