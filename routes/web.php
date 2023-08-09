<?php

use App\Http\Controllers\DataAdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\MasukController;
use App\Http\Controllers\PulangController;
use App\Http\Controllers\SettingController;
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
Route::get('/', [HomeController::class, 'index']);
Route::post('/store', [HomeController::class, 'store'])->name('store');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard.index');
    Route::resource('setting', SettingController::class);
    Route::resource('data_admin', DataAdminController::class);
    Route::resource('karyawan', KaryawanController::class);
    Route::resource('masuk', MasukController::class);
    Route::resource('pulang',PulangController::class);
});
