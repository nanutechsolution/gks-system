<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/cetak-anggaran/{tahun?}', [LaporanController::class, 'cetakAnggaran'])->name('cetak.anggaran')->middleware('auth');
Route::get('/cetak-baptis/{id}', [LaporanController::class, 'cetakSuratBaptis'])->name('cetak.baptis')->middleware('auth');

Route::get('/cetak-bukti-kas/{id}', [LaporanController::class, 'cetakBuktiKas'])
    ->name('cetak.bukti-kas')
    ->middleware('auth');
