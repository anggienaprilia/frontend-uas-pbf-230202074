<?php

use App\Http\Controllers\ObatController;
use App\Http\Controllers\PasienController;

Route::get('/', fn() => redirect()->route('obat.index'));

Route::resource('obat', ObatController::class);
Route::resource('pasien', PasienController::class);