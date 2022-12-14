<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriBiayaController;
use App\Models\KategoriBiaya;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LoginController::class, 'index'])->name('home');
Route::get('/login', [LoginController::class, 'cekLogin'])->name('login');

Route::post('proses-login', [LoginController::class, 'prosesLogin'])->name('proses-login');
Route::get('proses-logout', [LoginController::class, 'prosesLogout'])->name('proses-logout');

/* #region Akses Role */
Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard')->middleware(['auth','role:1']);

Route::resource('role', RoleController::class, ['except' => ['show']]);
Route::resource('user', UserController::class, ['except' => ['show']]);
Route::resource('kategori-biaya', KategoriBiayaController::class, ['except' => ['show']]);

/* #endregion */


