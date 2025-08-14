<?php

use App\Http\Controllers\LeadController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/leads/data', [LeadController::class, 'data'])->name('leads.data');
    Route::resource('leads', LeadController::class);
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});


