<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClientHomeController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\FamilyBackgroundController;
use App\Http\Controllers\PersonalCharacteristicController;
use App\Http\Controllers\MaritalStatusController;

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
    
    // Password Reset Routes
    Route::get('forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('password.request');
    Route::post('forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('password.email');
    Route::get('reset-password/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])
        ->name('password.reset');
    Route::post('reset-password', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])
        ->name('password.update');
});

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    // Client Routes
    Route::get('/client/dashboard', [ClientHomeController::class, 'index'])->name('client.dashboard');

    // Admin Routes
    Route::middleware('admin')->group(function () {
        Route::get('/admin/dashboard', [AdminHomeController::class, 'index'])->name('admin.dashboard');
        Route::resource('admin/users', AdminUserController::class)->names([
            'index' => 'admin.users.index',
            'create' => 'admin.users.create',
            'store' => 'admin.users.store',
            'edit' => 'admin.users.edit',
            'update' => 'admin.users.update',
            'destroy' => 'admin.users.destroy',
        ]);
        
        // PHS Submission Management Routes
        Route::resource('admin/phs', App\Http\Controllers\Admin\PHSController::class)->names([
            'index' => 'admin.phs.index',
            'show' => 'admin.phs.show',
            'edit' => 'admin.phs.edit',
            'update' => 'admin.phs.update',
            'destroy' => 'admin.phs.destroy',
        ]);
    });

    // PHS Routes
    Route::get('/phs/create', [App\Http\Controllers\PHSController::class, 'create'])->name('phs.create');
    Route::post('/phs', [App\Http\Controllers\PHSController::class, 'store'])->name('phs.store');

    // PDS Routes
    Route::get('/pds/create', [App\Http\Controllers\PDSController::class, 'create'])->name('pds.create');

    // Family Background Routes
    Route::get('/phs/family-background', [FamilyBackgroundController::class, 'create'])->name('phs.family-background.create');
    Route::post('/phs/family-background', [FamilyBackgroundController::class, 'store'])->name('phs.family-background.store');

    // Personal Characteristics Routes
    Route::get('/phs/personal-characteristics', [PersonalCharacteristicController::class, 'create'])->name('phs.personal-characteristics.create');
    Route::post('/phs/personal-characteristics', [PersonalCharacteristicController::class, 'store'])->name('phs.personal-characteristics.store');

    // Marital Status Routes
    Route::get('/phs/marital-status', [MaritalStatusController::class, 'create'])->name('phs.marital-status.create');
    Route::post('/phs/marital-status', [MaritalStatusController::class, 'store'])->name('phs.marital-status.store');

    // Dashboard Route
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
