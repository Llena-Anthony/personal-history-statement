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
use App\Models\Miscellaneous;
use App\Models\Organization;
use App\Models\MembershipDetails;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CharacterReputationController;
use App\Http\Controllers\ArrestRecordController;
use App\Models\AddressDetails;
use App\Http\Controllers\CredentialController;
use App\Http\Controllers\PHSReviewController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\MiscellaneousController;

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
    Route::middleware('login.throttle')->post('login', [LoginController::class, 'login']);

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
    
    // Return to Admin Route (for admins who switched to client view)
    Route::get('/return-to-admin', function() {
        // Clear the admin switch session
        session()->forget('admin_switched_to_client');
        session()->forget('admin_original_route');
        
        // Log the activity
        \App\Models\ActivityLog::create([
            'user_id' => auth()->id(),
            'description' => 'Admin returned to admin view from PHS management',
            'status' => 'success',
            'action' => 'return_to_admin',
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);
        
        return redirect()->route('admin.dashboard')->with('success', 'Returned to admin view.');
    })->name('return.to.admin');

    // PHS Routes - Personal Details
    Route::get('/phs/personal-details', [PHSController::class, 'create'])->name('phs.create');
    Route::post('/phs/personal-details', [PHSController::class, 'store'])->name('phs.store');

    // PHS Routes - Family Background
    Route::get('/phs/family-background', [FamilyBackgroundController::class, 'create'])->name('phs.family-background.create');
    Route::post('/phs/family-background', [FamilyBackgroundController::class, 'store'])->name('phs.family-background.store');

    // PHS Routes - Educational Background
    Route::get('/phs/educational-background', [EducationalBackgroundController::class, 'create'])->name('phs.educational-background');
    Route::post('/phs/educational-background', [EducationalBackgroundController::class, 'store'])->name('phs.educational-background.store');

    // PHS Routes - Marital Status
    Route::get('/phs/marital-status', [MaritalStatusController::class, 'create'])->name('phs.marital-status.create');
    Route::post('/phs/marital-status', [MaritalStatusController::class, 'store'])->name('phs.marital-status.store');

    // PHS Routes - Military History
    Route::get('/phs/military-history', [MilitaryHistoryController::class, 'create'])->name('phs.military-history.create');
    Route::post('/phs/military-history', [MilitaryHistoryController::class, 'store'])->name('phs.military-history.store');

    // PHS Routes - Places of Residence Since Birth
    Route::get('/phs/places-of-residence-since-birth', [PlacesOfResidenceController::class, 'create'])->name('phs.places-of-residence.create');
    Route::post('/phs/places-of-residence-since-birth', [PlacesOfResidenceController::class, 'store'])->name('phs.places-of-residence.store');

    // PHS Routes - Employment History
    Route::get('/phs/employment-history', [EmploymentHistoryController::class, 'create'])->name('phs.employment-history.create');
    Route::post('/phs/employment-history', [EmploymentHistoryController::class, 'store'])->name('phs.employment-history.store');

    // PHS Routes - Foreign Countries
    Route::get('/phs/foreign-countries', [ForeignCountriesController::class, 'create'])->name('phs.foreign-countries.create');
    Route::post('/phs/foreign-countries', [ForeignCountriesController::class, 'store'])->name('phs.foreign-countries.store');

    // PHS Routes - Personal Characteristics
    Route::get('/phs/personal-characteristics', [PersonalCharacteristicsController::class, 'create'])->name('phs.personal-characteristics.create');
    Route::post('/phs/personal-characteristics', [PersonalCharacteristicsController::class, 'store'])->name('phs.personal-characteristics.store');

    // PHS Routes - Family History (redirected to Family Background)
    Route::get('/phs/family-history', [FamilyBackgroundController::class, 'create'])->name('phs.family-history.create');
    Route::post('/phs/family-history', [FamilyBackgroundController::class, 'store'])->name('phs.family-history.store');

    // PHS Routes - Credit Reputation
    Route::get('/phs/credit-reputation', [CreditReputationController::class, 'create'])->name('phs.credit-reputation');
    Route::post('/phs/credit-reputation', [CreditReputationController::class, 'store'])->name('phs.credit-reputation.store');

    // PHS Routes - Arrest Record
    Route::get('/phs/arrest-record', [ArrestRecordController::class, 'create'])->name('phs.arrest-record');
    Route::post('/phs/arrest-record', [ArrestRecordController::class, 'store'])->name('phs.arrest-record.store');

    // PHS Routes - Organization
    Route::get('/phs/organization', [OrganizationController::class, 'create'])->name('phs.organization');
    Route::post('/phs/organization', [OrganizationController::class, 'store'])->name('phs.organization.store');

    // PHS Routes - Character and Reputation
    Route::get('/phs/character-and-reputation', [CharacterReputationController::class, 'create'])->name('phs.character-and-reputation');
    Route::post('/phs/character-and-reputation', [CharacterReputationController::class, 'store'])->name('phs.character-and-reputation.store');

    // PHS Routes - Miscellaneous
    Route::get('/phs/miscellaneous', [MiscellaneousController::class, 'create'])->name('phs.miscellaneous');
    Route::post('/phs/miscellaneous', [MiscellaneousController::class, 'store'])->name('phs.miscellaneous.store');

    // Dashboard Route
    Route::get('/dashboard', [ClientHomeController::class, 'index'])->name('dashboard');

    // PHS Routes - Send Credentials
    Route::post('/phs/send-credentials/{user}', [CredentialController::class, 'sendEmail'])->name('phs.send-credentials');

    // PHS Routes - Test Autofill
    Route::get('/phs/test-autofill', function() {
        return view('phs.test-autofill');
    })->name('phs.test-autofill');

    // PHS Review Routes
    Route::get('/phs/review', [PHSReviewController::class, 'review'])->name('phs.review');
    Route::post('/phs/review/finalize', [PHSReviewController::class, 'finalize'])->name('phs.review.finalize');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminHomeController::class, 'index'])->name('dashboard');
    
    // Switch to Client View Route
    Route::get('/switch-to-client', [AdminHomeController::class, 'switchToClient'])->name('switch.to.client');

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
    Route::get('/users/{user}/details', [AdminUserController::class, 'show'])->name('users.show');
    Route::post('/users/{user}/toggle-status', [AdminUserController::class, 'toggleStatus'])->name('users.toggle-status');
    Route::get('/users/export', [AdminUserController::class, 'export'])->name('users.export');

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

// Personnel Routes
Route::middleware(['auth', 'personnel'])->prefix('personnel')->name('personnel.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\PersonnelDashboardController::class, 'index'])->name('dashboard');
    Route::get('/phs', [App\Http\Controllers\PersonnelDashboardController::class, 'phs'])->name('phs');
    
    // Personnel Profile Routes
    Route::get('/profile/edit', [App\Http\Controllers\PersonnelDashboardController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [App\Http\Controllers\PersonnelDashboardController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/picture', [App\Http\Controllers\PersonnelDashboardController::class, 'updateProfilePicture'])->name('profile.picture');
    
    // PDS route is not accessible yet
});
