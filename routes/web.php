<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Main\PenjaluranController;
use App\Http\Controllers\Model\MahasiswaController;
use App\Http\Controllers\Model\NilaiController;
use App\Http\Controllers\Model\PortofolioController;
use App\Http\Middleware\PortofolioMiddleware;
use App\Http\Middleware\ProgressMahasiswa;
use App\Http\Middleware\ProgressNilai;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
})->name('/');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::get('/biodata', [MahasiswaController::class, 'index'])->name('biodata')->middleware('auth');
Route::post('/biodata', [MahasiswaController::class, 'store'])->middleware('auth');
Route::put('/biodata/{id}', [MahasiswaController::class, 'update'])->middleware('auth');

Route::get('/nilai/semester{semester}', [NilaiController::class, 'show'])->name('nilai')->middleware('auth')->middleware(ProgressNilai::class)->middleware(ProgressMahasiswa::class);
Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai.index')->middleware('auth')->middleware(ProgressNilai::class)->middleware(ProgressMahasiswa::class);
Route::post('/nilai/semester{semester}', [NilaiController::class, 'store'])->middleware('auth')->middleware(ProgressNilai::class)->middleware(ProgressMahasiswa::class);
Route::get('/nilai/transkrip', [NilaiController::class, 'transkrip'])->name('transkrip')->middleware('auth')->middleware(ProgressNilai::class)->middleware(ProgressMahasiswa::class);
Route::post('/nilai/transkrip', [NilaiController::class, 'saveNilai'])->name('saveNilai')->middleware('auth')->middleware(ProgressNilai::class)->middleware(ProgressMahasiswa::class);

Route::get('/portofolio', [PortofolioController::class, 'index'])->name('portofolio')->middleware('auth')->middleware(ProgressNilai::class);
Route::post('/portofolio', [PortofolioController::class, 'store'])->middleware('auth')->middleware(ProgressNilai::class);
Route::put('/portofolio/{id}', [PortofolioController::class, 'update'])->middleware('auth')->middleware(ProgressNilai::class)->middleware(PortofolioMiddleware::class);

Route::get('/penjaluran', [PenjaluranController::class, 'index'])->name('penjaluran')->middleware('auth')->middleware(ProgressMahasiswa::class);