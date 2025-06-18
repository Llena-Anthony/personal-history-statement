<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClientHomeController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\FamilyBackgroundController;
use App\Http\Controllers\PersonalCharacteristicController;
use App\Http\Controllers\MaritalStatusController;
use App\Http\Controllers\EducationalBackgroundController;
use App\Http\Controllers\MilitaryHistoryController;
use App\Http\Controllers\PlacesOfResidenceController;
use App\Http\Controllers\EmploymentHistoryController;
use App\Http\Controllers\ForeignCountriesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

    // PHS Routes
    Route::get('/phs/personal-details', [App\Http\Controllers\PHSController::class, 'create'])->name('phs.create');
    Route::post('/phs/personal-details', [App\Http\Controllers\PHSController::class, 'store'])->name('phs.store');

    // PDS Routes
    Route::get('/pds/create', [App\Http\Controllers\PDSController::class, 'create'])->name('pds.create');

    // Marital Status Routes
    Route::get('/phs/marital-status', [MaritalStatusController::class, 'create'])->name('phs.marital-status.create');
    Route::post('/phs/marital-status', [MaritalStatusController::class, 'store'])->name('phs.marital-status.store');

    // Educational Background Routes
    Route::get('/phs/educational-background', [EducationalBackgroundController::class, 'create'])->name('phs.educational-background.create');
    Route::post('/phs/educational-background', [EducationalBackgroundController::class, 'store'])->name('phs.educational-background.store');

    // Military History Routes
    Route::get('/phs/military-history', [MilitaryHistoryController::class, 'create'])->name('phs.military-history.create');
    Route::post('/phs/military-history', [MilitaryHistoryController::class, 'store'])->name('phs.military-history.store');

    // Places of Residence Routes
    Route::get('/phs/places-of-residence', [PlacesOfResidenceController::class, 'create'])->name('phs.places-of-residence.create');
    Route::post('/phs/places-of-residence', [PlacesOfResidenceController::class, 'store'])->name('phs.places-of-residence.store');

    // Foreign Countries Routes
    Route::get('/phs/foreign-countries', [ForeignCountriesController::class, 'create'])->name('phs.foreign-countries.create');
    Route::post('/phs/foreign-countries', [ForeignCountriesController::class, 'store'])->name('phs.foreign-countries.store');

    // Dashboard Route
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Family Background
    Route::get('/phs/family-background', [App\Http\Controllers\FamilyBackgroundController::class, 'create'])
        ->name('phs.family-background.create');
    Route::post('/phs/family-background', [App\Http\Controllers\FamilyBackgroundController::class, 'store'])
        ->name('phs.family-background.store');

    // Educational Background
    Route::get('/phs/educational-background', [App\Http\Controllers\EducationalBackgroundController::class, 'create'])
        ->name('phs.educational-background.create');
    Route::post('/phs/educational-background', [App\Http\Controllers\EducationalBackgroundController::class, 'store'])
        ->name('phs.educational-background.store');

    // Military History
    Route::get('/phs/military-history', [App\Http\Controllers\MilitaryHistoryController::class, 'create'])
        ->name('phs.military-history.create');
    Route::post('/phs/military-history', [App\Http\Controllers\MilitaryHistoryController::class, 'store'])
        ->name('phs.military-history.store');

    // Marital Status
    Route::get('/phs/marital-status', [App\Http\Controllers\MaritalStatusController::class, 'create'])
        ->name('phs.marital-status.create');
    Route::post('/phs/marital-status', [App\Http\Controllers\MaritalStatusController::class, 'store'])
        ->name('phs.marital-status.store');

    // Places of Residence
    Route::get('/phs/places-of-residence', [App\Http\Controllers\PlacesOfResidenceController::class, 'create'])
        ->name('phs.places-of-residence.create');
    Route::post('/phs/places-of-residence', [App\Http\Controllers\PlacesOfResidenceController::class, 'store'])
        ->name('phs.places-of-residence.store');

    // Employment History
    Route::get('/phs/employment-history', [App\Http\Controllers\EmploymentHistoryController::class, 'create'])
        ->name('phs.employment-history.create');
    Route::post('/phs/employment-history', [App\Http\Controllers\EmploymentHistoryController::class, 'store'])
        ->name('phs.employment-history.store');

    // Foreign Countries
    Route::get('/phs/foreign-countries', [App\Http\Controllers\ForeignCountriesController::class, 'create'])
        ->name('phs.foreign-countries.create');
    Route::post('/phs/foreign-countries', [App\Http\Controllers\ForeignCountriesController::class, 'store'])
        ->name('phs.foreign-countries.store');

    // Personal Characteristics Routes
    Route::get('/phs/personal-characteristics', [App\Http\Controllers\PersonalCharacteristicsController::class, 'create'])
        ->name('phs.personal-characteristics.create');
    Route::post('/phs/personal-characteristics', [App\Http\Controllers\PersonalCharacteristicsController::class, 'store'])
        ->name('phs.personal-characteristics.store');

    // Family History Routes
    Route::get('/phs/family-history', [App\Http\Controllers\FamilyHistoryController::class, 'create'])
        ->name('phs.family-history.create');
    Route::post('/phs/family-history', [App\Http\Controllers\FamilyHistoryController::class, 'store'])
        ->name('phs.family-history.store');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminHomeController::class, 'index'])->name('dashboard');

    // User Management Routes
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('users.create');
    Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
    Route::get('/users/confirm', [AdminUserController::class, 'confirm'])->name('users.confirm');
    Route::post('/users/finalize', [AdminUserController::class, 'finalize'])->name('users.finalize');
    Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

    // PHS Submission Management Routes
    Route::resource('phs', App\Http\Controllers\Admin\PHSController::class)->names([
        'index' => 'phs.index',
        'show' => 'phs.show',
        'edit' => 'phs.edit',
        'update' => 'phs.update',
        'destroy' => 'phs.destroy',
    ]);

    // Activity Logs Management
    Route::get('activity-logs', [App\Http\Controllers\Admin\ActivityLogsController::class, 'index'])->name('activity-logs.index');
    Route::get('activity-logs/export', [App\Http\Controllers\Admin\ActivityLogsController::class, 'export'])->name('activity-logs.export');
    Route::post('activity-logs/clear-old', [App\Http\Controllers\Admin\ActivityLogsController::class, 'clearOldLogs'])->name('activity-logs.clear-old');
    Route::get('activity-logs/{activityLog}', [App\Http\Controllers\Admin\ActivityLogsController::class, 'show'])->name('activity-logs.show');

    // Reports Management
    Route::get('reports', [App\Http\Controllers\Admin\ReportsController::class, 'index'])->name('reports.index');
    Route::get('reports/export', [App\Http\Controllers\Admin\ReportsController::class, 'export'])->name('reports.export');
});
