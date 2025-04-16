<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/login', [AuthController::class, 'index'])->name('auth.index')->middleware('guest');
Route::post('/login', [AuthController::class, 'verify'])->name('auth.verify');

Route::group(['middleware' => 'auth:user'], function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('/profile', [DashboardController::class, 'profile'])->name('dashboard.profile');
        Route::get('/reset-password', [DashboardController::class, 'resetPassword'])->name('dashboard.resetPassword');
        Route::post('/reset-password', [DashboardController::class, 'prosesResetPassword'])->name('dashboard.prosesResetPassword');

        #kategori
        Route::get('/kategori',[KategoriController::class, 'index'])->name('kategori.index');
        Route::get('/kategori/tambah',[KategoriController::class, 'tambah'])->name('kategori.tambah');
        Route::post('/kategori/prosesTambah',[KategoriController::class, 'prosesTambah'])->name('kategori.prosesTambah');
        Route::get('/kategori/ubah/{id}',[KategoriController::class, 'ubah'])->name('kategori.ubah');
        Route::post('/kategori/prosesUbah',[KategoriController::class, 'prosesUbah'])->name('kategori.prosesUbah');
        Route::get('/kategori/hapus/{id}',[KategoriController::class, 'hapus'])->name('kategori.hapus');
        Route::get('/kategori/export-pdf',[KategoriController::class, 'exportPdf'])->name('kategori.exportPdf');

        #user
        Route::get('/user',[UserController::class, 'index'])->name('user.index');
        Route::get('/user/tambah',[UserController::class, 'tambah'])->name('user.tambah');
        Route::post('/user/prosesTambah',[UserController::class, 'prosesTambah'])->name('user.prosesTambah');
        Route::get('/user/ubah/{id}',[UserController::class, 'ubah'])->name('user.ubah');
        Route::post('/user/prosesUbah',[UserController::class, 'prosesUbah'])->name('user.prosesUbah');
        Route::get('/user/hapus/{id}',[UserController::class, 'hapus'])->name('user.hapus');
    });
    
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});
