<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardLaporanController;
use App\Http\Controllers\DashboardMustahikController;
use App\Http\Controllers\DashboardMuzzakiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Table_Mustahik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JadwalController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post("register", [RegisterController::class, 'register']);
Route::post("login", [LoginController::class, 'loginuser']);

//KARYAWAN
Route::post("register-karyawan", [KaryawanController::class, 'register']);
Route::post("login-karyawan", [KaryawanController::class, 'login']);
Route::post('/logout-karyawan', [KaryawanController::class, 'logout'])->middleware('auth:sanctum');
Route::post("postlaporan", [DashboardLaporanController::class, 'postapi']);
Route::post("postmuzzaki", [DashboardMuzzakiController::class, 'postapi']);
Route::post("postmustahik", [DashboardMustahikController::class, 'postapi']);

//UPDATE DATA
Route::put('/laporan/{id}', [DashboardLaporanController::class, 'updateApi']);
Route::patch('/laporan/{id}', [DashboardLaporanController::class, 'updateApi']);
Route::put('/muzzaki/{id}', [DashboardMuzzakiController::class, 'updateApi']);
Route::put('/mustahik/{id}', [DashboardMustahikController::class, 'updateApi']);

//GET DATA
Route::get('table_mustahik', [DashboardMustahikController::class, 'api']);
Route::get('data_muzzaki', [DashboardMuzzakiController::class, 'api']);
Route::get('laporan', [DashboardLaporanController::class, 'api']);
Route::get('infoterkini', [DashboardLaporanController::class, 'getInfo']);

//jadwal
Route::get('jadwals', [JadwalController::class, 'index']);
Route::post('jadwals', [JadwalController::class, 'store']);
Route::post('jadwals/{jadwal_id}/pengambilan/{muzzaki_id}', [JadwalController::class, 'addJadwalPengambilan']);
Route::get('jadwals/{id}', [JadwalController::class, 'show']);
Route::delete('jadwals/{id}', [JadwalController::class, 'destroy']);
Route::get('jadwals/{jadwal_id}/mustahiks', [JadwalController::class, 'getMustahiks']);
Route::patch('jadwals/mustahiks/{pengambilan_id}', [JadwalController::class, 'updateMustahikChecklist']);
Route::post('jadwals/tambahdata/{jadwal_id}', [JadwalController::class, 'addJadwal']);

//DELETE
Route::delete("delete-laporan", [DashboardLaporanController::class, 'deleteapi']);
Route::delete("delete-muzzaki", [DashboardMuzzakiController::class, 'deleteapi']);
Route::delete("delete-mustahik", [DashboardMustahikController::class, 'deleteapi']);
Route::delete("delete-jadwal", [JadwalController::class, 'deleteapi']);





Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum', 'is_karyawan'])->get('/karyawan-only-route', function (Request $request) {
    // Hanya karyawan yang dapat mengakses route ini
});

