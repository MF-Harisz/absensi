<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\AbsensiController;

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
Route::get('/', function () {
    return redirect('/login');
});
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProcess']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [JadwalController::class, 'dashboard'])
    ->middleware('auth:admin,web,dosen')
    ->name('dashboard');

Route::get('/matakuliah', [MatakuliahController::class, 'index']
)->middleware('auth:admin,web,dosen')->name('matakuliah');
Route::get('/makul/{id}/edit', [MatakuliahController::class, 'edit'])->name('makul.edit');
Route::put('/makul/{id}', [MatakuliahController::class, 'update'])->name('makul.update');
Route::delete('/makul/{id}', [MatakuliahController::class, 'destroy'])->name('makul.destroy');
Route::post('/makul', [MatakuliahController::class, 'store'])->name('makul.store');

Route::get('/admin', [AdminController::class, 'index']
)->middleware('auth:admin,web,dosen')->name('admin');
Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
Route::put('/admin/{id}', [AdminController::class, 'update'])->name('admin.update');
Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

Route::get('/dosen', [DosenController::class, 'index']
)->middleware('auth:admin,web,dosen')->name('dosen');
Route::post('/dosen/store', [DosenController::class, 'store'])->name('dosen.store');
Route::put('/dosen/{id}', [DosenController::class, 'update'])->name('dosen.update');
Route::delete('/dosen/{id}', [DosenController::class, 'destroy'])->name('dosen.destroy');

Route::get('/user', [UserController::class, 'index']
)->middleware('auth:admin,web,dosen')->name('user');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

Route::get('/kelas', [KelasController::class, 'index']
)->middleware('auth:admin,web,dosen')->name('kelas');
Route::post('/kelas/store', [KelasController::class, 'store'])->name('kelas.store');
Route::put('/kelas/{id}', [KelasController::class, 'update'])->name('kelas.update');
Route::delete('/kelas/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');

Route::get('/jadwal', [JadwalController::class, 'index']
)->middleware('auth:admin,web,dosen')->name('jadwals');
Route::post('/jadwal', [JadwalController::class, 'store'])->name('jadwal.store');
Route::put('/jadwal/{id}', [JadwalController::class, 'update'])->name('jadwal.update');
Route::delete('/jadwal/{id}', [JadwalController::class, 'destroy'])->name('jadwal.destroy');

Route::get('/absensi', [AbsensiController::class, 'index']
)->middleware('auth:admin,web,dosen')->name('absensi');
Route::post('/absensi', [AbsensiController::class, 'store'])->name('absensi.store');
Route::get('/data-absensi', [AbsensiController::class, 'dataAbsensi']
)->middleware('auth:admin,web,dosen')->name('dataAbsensi');

Route::get('/absensi/{id_jadwal}', [AbsensiController::class, 'create'])->name('absensi.create');
Route::get('/data-absensi/table', [AbsensiController::class, 'table'])->name('dataAbsensi.table');

