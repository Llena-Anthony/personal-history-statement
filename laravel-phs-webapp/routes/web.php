<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClientHomeController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\FamilyBackgroundController;
use App\Http\Controllers\MaritalStatusController;
use App\Http\Controllers\EducationalBackgroundController;
use App\Http\Controllers\FamilyHistoryController;
use App\Http\Controllers\PersonalDetailsController;
use App\Http\Controllers\PersonalCharacteristicsController;
use App\Http\Controllers\PlacesOfResidenceController;
use App\Http\Controllers\EmploymentHistoryController;
use App\Http\Controllers\ForeignCountriesController;
use App\Http\Controllers\MilitaryHistoryController;

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

    // Personal Details Routes
    Route::get('/phs', [PersonalDetailsController::class, 'create'])->name('phs.create');
    Route::post('/phs', [PersonalDetailsController::class, 'store'])->name('phs.store');

    // Marital Status Routes
    Route::get('/phs/marital-status', [MaritalStatusController::class, 'create'])->name('phs.marital-status.create');
    Route::post('/phs/marital-status', [MaritalStatusController::class, 'store'])->name('phs.marital-status.store');

    // Family History Routes
    Route::get('/phs/family-history', [FamilyHistoryController::class, 'create'])->name('phs.family-history.create');
    Route::post('/phs/family-history', [FamilyHistoryController::class, 'store'])->name('phs.family-history.store');

    // Educational Background Routes
    Route::get('/phs/educational-background', [EducationalBackgroundController::class, 'create'])->name('phs.educational-background.create');
    Route::post('/phs/educational-background', [EducationalBackgroundController::class, 'store'])->name('phs.educational-background.store');

    // Personal Characteristics Routes
    Route::get('/phs/personal-characteristics', [PersonalCharacteristicsController::class, 'create'])->name('phs.personal-characteristics.create');
    Route::post('/phs/personal-characteristics', [PersonalCharacteristicsController::class, 'store'])->name('phs.personal-characteristics.store');

    // Places of Residence Routes
    Route::get('/phs/places-of-residence', [PlacesOfResidenceController::class, 'create'])->name('phs.places-of-residence.create');
    Route::post('/phs/places-of-residence', [PlacesOfResidenceController::class, 'store'])->name('phs.places-of-residence.store');

    // Employment History Routes
    Route::get('/phs/employment-history', [EmploymentHistoryController::class, 'create'])->name('phs.employment-history.create');
    Route::post('/phs/employment-history', [EmploymentHistoryController::class, 'store'])->name('phs.employment-history.store');

    // Foreign Countries Routes
    Route::get('/phs/foreign-countries', [ForeignCountriesController::class, 'create'])->name('phs.foreign-countries.create');
    Route::post('/phs/foreign-countries', [ForeignCountriesController::class, 'store'])->name('phs.foreign-countries.store');

    // Military History Routes
    Route::get('/phs/military-history', [MilitaryHistoryController::class, 'create'])->name('phs.military-history.create');
    Route::post('/phs/military-history', [MilitaryHistoryController::class, 'store'])->name('phs.military-history.store');

    // Dashboard Route
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
