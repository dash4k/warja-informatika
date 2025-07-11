<?php

use App\Http\Controllers\Admin\AdminNilaiController;
use App\Http\Controllers\Admin\AdminBiodataController;
use App\Http\Controllers\Admin\AdminPortofolioController;
use App\Http\Controllers\Admin\AdminSoalController;
use App\Http\Controllers\Admin\AdminUjianController;
use App\Http\Controllers\Admin\AdminValidated;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Main\PenjaluranController;
use App\Http\Controllers\Model\MahasiswaController;
use App\Http\Controllers\Model\NilaiController;
use App\Http\Controllers\Model\PortofolioController;
use App\Http\Controllers\Model\SurveyController;
use App\Http\Middleware\adminAuth;
use App\Http\Middleware\mahasiswaAuth;
use App\Http\Middleware\PenjaluranExam;
use App\Http\Middleware\PenjaluranSurvey;
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

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth')->middleware(mahasiswaAuth::class);

Route::get('/biodata', [MahasiswaController::class, 'index'])->name('biodata')->middleware('auth')->middleware(mahasiswaAuth::class);
Route::post('/biodata', [MahasiswaController::class, 'store'])->middleware('auth')->middleware(mahasiswaAuth::class);
Route::put('/biodata/{id}', [MahasiswaController::class, 'update'])->middleware('auth')->middleware(mahasiswaAuth::class);

Route::get('/nilai/semester{semester}', [NilaiController::class, 'show'])->name('nilai')->middleware('auth')->middleware(mahasiswaAuth::class)->middleware(ProgressNilai::class)->middleware(ProgressMahasiswa::class);
Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai.index')->middleware('auth')->middleware(mahasiswaAuth::class)->middleware(ProgressNilai::class)->middleware(ProgressMahasiswa::class);
Route::post('/nilai/semester{semester}', [NilaiController::class, 'store'])->middleware('auth')->middleware(mahasiswaAuth::class)->middleware(ProgressNilai::class)->middleware(ProgressMahasiswa::class);
Route::get('/nilai/transkrip', [NilaiController::class, 'transkrip'])->name('transkrip')->middleware('auth')->middleware(mahasiswaAuth::class)->middleware(ProgressNilai::class)->middleware(ProgressMahasiswa::class);
Route::post('/nilai/transkrip', [NilaiController::class, 'saveNilai'])->name('saveNilai')->middleware('auth')->middleware(mahasiswaAuth::class)->middleware(ProgressNilai::class)->middleware(ProgressMahasiswa::class);

Route::get('/portofolio', [PortofolioController::class, 'index'])->name('portofolio')->middleware('auth')->middleware(mahasiswaAuth::class)->middleware(ProgressNilai::class);
Route::post('/portofolio', [PortofolioController::class, 'store'])->middleware('auth')->middleware(mahasiswaAuth::class)->middleware(ProgressNilai::class);
Route::put('/portofolio/{id}', [PortofolioController::class, 'update'])->middleware('auth')->middleware(mahasiswaAuth::class)->middleware(ProgressNilai::class)->middleware(PortofolioMiddleware::class);

Route::get('/penjaluran', [PenjaluranController::class, 'index'])->name('penjaluran')->middleware('auth')->middleware(mahasiswaAuth::class)->middleware(ProgressMahasiswa::class);
Route::get('/penjaluran/unvalidated', [PenjaluranController::class, 'unvalidated'])->name('penjaluran.unvalidated')->middleware('auth')->middleware(mahasiswaAuth::class)->middleware(ProgressMahasiswa::class);
Route::get('/penjaluran/survey', [PenjaluranController::class, 'survey'])->name('penjaluran.survey')->middleware('auth')->middleware(mahasiswaAuth::class)->middleware(ProgressMahasiswa::class)->middleware(PenjaluranSurvey::class);
Route::get('/penjaluran/waiting', [PenjaluranController::class, 'waiting'])->name('penjaluran.waiting')->middleware('auth')->middleware(mahasiswaAuth::class)->middleware(ProgressMahasiswa::class)->middleware(PenjaluranSurvey::class);
Route::get('/penjaluran/countdown', [PenjaluranController::class, 'countdown'])->name('penjaluran.countdown')->middleware('auth')->middleware(mahasiswaAuth::class)->middleware(ProgressMahasiswa::class)->middleware(PenjaluranExam::class);
Route::get('/penjaluran/start', [PenjaluranController::class, 'start'])->name('penjaluran.start')->middleware('auth')->middleware(mahasiswaAuth::class)->middleware(ProgressMahasiswa::class)->middleware(PenjaluranExam::class);
Route::get('/penjaluran/exam', [PenjaluranController::class, 'exam'])->name('penjaluran.exam')->middleware('auth')->middleware(mahasiswaAuth::class)->middleware(ProgressMahasiswa::class)->middleware(PenjaluranExam::class);
Route::get('/penjaluran/startExam', [PenjaluranController::class, 'startExam'])->name('penjaluran.startExam')->middleware('auth')->middleware(mahasiswaAuth::class)->middleware(ProgressMahasiswa::class)->middleware(PenjaluranExam::class);
Route::post('/penjaluran/exam/save', [PenjaluranController::class, 'saveAnswer'])->name('penjaluran.exam.save')->middleware('auth')->middleware(mahasiswaAuth::class)->middleware(ProgressMahasiswa::class)->middleware(PenjaluranExam::class);
Route::get('/penjaluran/redirect', [PenjaluranController::class, 'redirect'])->name('penjaluran.redirect')->middleware('auth')->middleware(mahasiswaAuth::class)->middleware(ProgressMahasiswa::class);

Route::resource('/survey', SurveyController::class)->names('survey')->middleware(mahasiswaAuth::class)->middleware(ProgressMahasiswa::class)->middleware(PenjaluranSurvey::class);

Route::resource('admin/unvalidated/biodata', AdminBiodataController::class)->names('admin.biodata')->middleware('auth')->middleware(adminAuth::class);
Route::put('admin/unvalidated/biodata/validate/{id}', [AdminBiodataController::class, 'validate'])->name('admin.biodata.validate')->middleware('auth')->middleware(adminAuth::class);

Route::resource('admin/unvalidated/nilai', AdminNilaiController::class)->names('admin.nilai')->middleware('auth')->middleware(adminAuth::class);
Route::put('admin/unvalidated/nilai/validate/{id}', [AdminNilaiController::class, 'validate'])->name('admin.nilai.validate')->middleware('auth')->middleware(adminAuth::class);

Route::resource('admin/unvalidated/portofolio', AdminPortofolioController::class)->names('admin.portofolio')->middleware('auth')->middleware(adminAuth::class);
Route::put('admin/unvalidated/portofolio/validate/{id}', [AdminPortofolioController::class, 'validate'])->name('admin.portofolio.validate')->middleware('auth')->middleware(adminAuth::class);

Route::get('admin/validated/biodata', [AdminValidated::class, 'biodata'])->name('admin.validated.biodata')->middleware('auth')->middleware(adminAuth::class);
Route::get('admin/validated/nilai', [AdminValidated::class, 'nilai'])->name('admin.validated.nilai')->middleware('auth')->middleware(adminAuth::class);
Route::get('admin/validated/portofolio', [AdminValidated::class, 'portofolio'])->name('admin.validated.portofolio')->middleware('auth')->middleware(adminAuth::class);

Route::resource('admin/soal', AdminSoalController::class)->names('admin.soal')->middleware('auth')->middleware(adminAuth::class);

Route::resource('admin/ujian', AdminUjianController::class)->names('admin.ujian')->middleware('auth')->middleware(adminAuth::class);
Route::delete('admin/ujianMahasiswa/{id}', [AdminUjianController::class, 'deleteMahasiswa'])->name('admin.ujianMahasiswa.destroy')->middleware('auth')->middleware(adminAuth::class);