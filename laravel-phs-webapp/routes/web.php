<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClientHomeController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\FamilyBackgroundController;
use App\Http\Controllers\PersonalCharacteristicsController;
use App\Http\Controllers\MaritalStatusController;
use App\Http\Controllers\EducationalBackgroundController;
use App\Http\Controllers\MilitaryHistoryController;
use App\Http\Controllers\PlacesOfResidenceController;
use App\Http\Controllers\EmploymentHistoryController;
use App\Http\Controllers\ForeignCountriesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\PHSController;
use App\Http\Controllers\FamilyHistoryController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\CreditReputationController;

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

    // Profile Routes
    Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/picture', [App\Http\Controllers\ProfileController::class, 'updatePicture'])->name('profile.picture');

    // Client Routes
    Route::get('/client/dashboard', [ClientHomeController::class, 'index'])->name('client.dashboard');

    // PHS Routes - Personal Details
    Route::get('/phs/personal-details', [PHSController::class, 'create'])->name('phs.create');
    Route::post('/phs/personal-details', [PHSController::class, 'store'])->name('phs.store');

    // PHS Routes - Family Background
    Route::get('/phs/family-background', [FamilyBackgroundController::class, 'create'])->name('phs.family-background.create');
    Route::post('/phs/family-background', [FamilyBackgroundController::class, 'store'])->name('phs.family-background.store');

    // PHS Routes - Educational Background
    Route::get('/phs/educational-background', [PHSController::class, 'educationalBackground'])->name('phs.educational-background');
    Route::post('/phs/educational-background', [PHSController::class, 'storeEducationalBackground'])->name('phs.educational-background.store');

    // PHS Routes - Marital Status
    Route::get('/phs/marital-status', [MaritalStatusController::class, 'create'])->name('phs.marital-status.create');
    Route::post('/phs/marital-status', [MaritalStatusController::class, 'store'])->name('phs.marital-status.store');

    // PHS Routes - Military History
    Route::get('/phs/military-history', [MilitaryHistoryController::class, 'create'])->name('phs.military-history.create');
    Route::post('/phs/military-history', [MilitaryHistoryController::class, 'store'])->name('phs.military-history.store');

    // PHS Routes - Places of Residence
    Route::get('/phs/places-of-residence', [PlacesOfResidenceController::class, 'create'])->name('phs.places-of-residence.create');
    Route::post('/phs/places-of-residence', [PlacesOfResidenceController::class, 'store'])->name('phs.places-of-residence.store');

    // PHS Routes - Employment History
    Route::get('/phs/employment-history', [EmploymentHistoryController::class, 'create'])->name('phs.employment-history.create');
    Route::post('/phs/employment-history', [EmploymentHistoryController::class, 'store'])->name('phs.employment-history.store');

    // PHS Routes - Foreign Countries
    Route::get('/phs/foreign-countries', [ForeignCountriesController::class, 'create'])->name('phs.foreign-countries.create');
    Route::post('/phs/foreign-countries', [ForeignCountriesController::class, 'store'])->name('phs.foreign-countries.store');

    // PHS Routes - Personal Characteristics
    Route::get('/phs/personal-characteristics', [PersonalCharacteristicsController::class, 'create'])->name('phs.personal-characteristics.create');
    Route::post('/phs/personal-characteristics', [PersonalCharacteristicsController::class, 'store'])->name('phs.personal-characteristics.store');

    // PHS Routes - Family History
    Route::get('/phs/family-history', [FamilyHistoryController::class, 'create'])->name('phs.family-history.create');
    Route::post('/phs/family-history', [FamilyHistoryController::class, 'store'])->name('phs.family-history.store');

    // PHS Routes - Credit Reputation
    Route::get('/phs/credit-reputation', [CreditReputationController::class, 'create'])->name('phs.credit-reputation');
    Route::post('/phs/credit-reputation', [CreditReputationController::class, 'store'])->name('phs.credit-reputation.store');

    // PHS Routes - Arrest Record
    Route::get('/phs/arrest-record', function() { return view('phs.arrest-record'); })->name('phs.arrest-record');
    Route::post('/phs/arrest-record', function(Request $request) { return redirect()->route('phs.employment-history')->with('success', 'Arrest record saved.'); })->name('phs.arrest-record.store');

    // PHS Routes - Employment History II
    Route::get('/phs/employment-history-2', function() { return view('phs.employment-history'); })->name('phs.employment-history');
    Route::post('/phs/employment-history-2', function(Request $request) { return redirect()->route('phs.organization')->with('success', 'Employment history II saved.'); })->name('phs.employment-history.store');

    // PHS Routes - Organization
    Route::get('/phs/organization', function() { return view('phs.organization'); })->name('phs.organization');
    Route::post('/phs/organization', function(Request $request) { return redirect()->route('phs.miscellaneous')->with('success', 'Organization saved.'); })->name('phs.organization.store');

    // PHS Routes - Miscellaneous
    Route::get('/phs/miscellaneous', function() { return view('phs.miscellaneous'); })->name('phs.miscellaneous');
    Route::post('/phs/miscellaneous', function(Request $request) { return redirect()->route('client.dashboard')->with('success', 'Miscellaneous information saved.'); })->name('phs.miscellaneous.store');

    // Dashboard Route
    Route::get('/dashboard', [ClientHomeController::class, 'index'])->name('dashboard');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminHomeController::class, 'index'])->name('dashboard');

    // Profile Management Routes
    Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');

    // User Management Routes
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('users.create');
    Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
    Route::get('/users/confirm', [AdminUserController::class, 'confirm'])->name('users.confirm');
    Route::post('/users/finalize', [AdminUserController::class, 'finalize'])->name('users.finalize');
    Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');

    // PHS Submission Management Routes
    Route::get('print-preview', [App\Http\Controllers\PrintController::class, 'preview'])->name('phs.preview');
    Route::resource('phs', App\Http\Controllers\Admin\PHSController::class)->names([
        'index' => 'phs.index',
        'show' => 'phs.show',
        'edit' => 'phs.edit',
        'update' => 'phs.update',
        'destroy' => 'phs.destroy',
    ]);

    // Print PHS Submission
    Route::get('phs/{submission}/print', [PrintController::class, 'printPHSSubmission'])->name('phs.print');

    // Activity Logs Management
    Route::get('activity-logs', [App\Http\Controllers\Admin\ActivityLogsController::class, 'index'])->name('activity-logs.index');
    Route::get('activity-logs/export', [App\Http\Controllers\Admin\ActivityLogsController::class, 'export'])->name('activity-logs.export');
    Route::post('activity-logs/clear-old', [App\Http\Controllers\Admin\ActivityLogsController::class, 'clearOldLogs'])->name('activity-logs.clear-old');
    Route::get('activity-logs/{activityLog}', [App\Http\Controllers\Admin\ActivityLogsController::class, 'show'])->name('activity-logs.show');

    // Reports Management
    Route::get('reports', [App\Http\Controllers\Admin\ReportsController::class, 'index'])->name('reports.index');
    Route::get('reports/export', [App\Http\Controllers\Admin\ReportsController::class, 'export'])->name('reports.export');
});
