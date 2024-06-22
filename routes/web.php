<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController as AuthRegisterController;
use App\Http\Controllers\DashboardLaporanController;
use App\Http\Controllers\DashboardMustahikController;
use App\Http\Controllers\DashboardMuzzakiController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PembagianController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Auth;

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
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::get('/register', [AuthRegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthRegisterController::class, 'register'])->name('register.post');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/'); // Atau alamat URL yang sesuai setelah logout
})->name('logout');
// Route::put('/laporan/{id}', [DashboardLaporanController::class, 'update'])->name('laporan.update');


    Route::get('/table_mustahik/export-pdf', [DashboardMustahikController::class, 'exportPdf'])->name('table_mustahik.export.pdf');
    Route::get('/laporan/export-pdf', [DashboardLaporanController::class, 'exportPdf'])->name('laporan.export.pdf');
    Route::get('/pengeluaran/export-pdf', [PengeluaranController::class, 'exportPdf'])->name('pengeluaran.export.pdf');
    Route::get('/muzzaki/export-pdf', [DashboardMuzzakiController::class, 'exportPdf'])->name('muzzaki.export.pdf');
    Route::get('/pembagian/export-pdf', [PembagianController::class, 'exportPdf'])->name('pembagian.export.pdf');
    Route::get('/pembagian/export-lampiran', [PembagianController::class, 'exportLampiran'])->name('pembagian.export.lampiran');

// Group routes that need authentication
Route::middleware(['auth'])->group(function () {
    
    Route::resource('table_mustahik', DashboardMustahikController::class);
    Route::resource('muzzaki', DashboardMuzzakiController::class);
    Route::resource('pengeluaran', PengeluaranController::class);
	Route::resource('karyawan', KaryawanController::class);
    Route::resource('pembagian', PembagianController::class);
    Route::resource('table_pembagian', PembagianController::class);
    Route::resource('laporan', DashboardLaporanController::class);

    // Route::post('/table_pembagian/create', PembagianController::class);
    Route::post('/laporan', [DashboardLaporanController::class, 'store'])->name('laporan.store');



    Route::resource('user', UserController::class, ['except' => ['show']]);

    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('profile/password', [ProfileController::class, 'password'])->name('profile.password');

    Route::get('{page}', [App\Http\Controllers\PageController::class, 'index'])->name('page.index');

    // Additional routes for create and edit actions
    // Route::get('/laporan/create', [DashboardLaporanController::class, 'create'])->name('laporan.create');
    // Route::get('/laporan/edit/{laporan}', [DashboardLaporanController::class, 'edit'])->name('laporan.edit');
    

    Route::get('/pengeluaran/create', [PengeluaranController::class, 'create'])->name('pengeluaran.create');
    Route::get('/pengeluaran/edit/{id}', [PengeluaranController::class, 'edit'])->name('pengeluaran.edit');

    Route::get('/muzzaki/create', [DashboardMuzzakiController::class, 'create'])->name('muzzaki.create');

    Route::post('/karyawan/{id}', [KaryawanController::class, 'update'])->name('karyawan.update');

    
});


