<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClientHomeController;

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

// Public Routes
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('client.dashboard');
    }
    return redirect()->route('login');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
});

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    // Client Routes
    Route::get('/client/dashboard', [ClientHomeController::class, 'index'])->name('client.dashboard');
    
    // PHS Routes
    Route::get('/phs/create', [App\Http\Controllers\PHSController::class, 'create'])->name('phs.create');
    
    // PDS Routes
    Route::get('/pds/create', [App\Http\Controllers\PDSController::class, 'create'])->name('pds.create');
});
