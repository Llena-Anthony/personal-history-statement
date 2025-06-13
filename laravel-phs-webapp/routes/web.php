<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

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

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Client Routes
    Route::get('/client/dashboard', [App\Http\Controllers\ClientHomeController::class, 'index'])->name('client.dashboard');
    
    // PHS Routes
    Route::get('/phs/create', [App\Http\Controllers\PHSController::class, 'create'])->name('phs.create');
    
    // PDS Routes
    Route::get('/pds/create', [App\Http\Controllers\PDSController::class, 'create'])->name('pds.create');
});
