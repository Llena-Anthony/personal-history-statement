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
    Route::get('/phs/organization', function() { 
        // Load existing organization data for autofill
        $organizations = Organization::with(['membershipDetails' => function($query) {
            $query->where('username', Auth::user()->username);
        }])->get();
        
        $viewData = [
            'organizations' => $organizations
        ];
        
        if (request()->ajax()) {
            return view('phs.sections.organization-content', $viewData);
        }
        return view('phs.organization', $viewData); 
    })->name('phs.organization');

    Route::post('/phs/organization', function(Request $request) { 
        $isSaveOnly = $request->header('X-Save-Only') === 'true';
        try {
            // Check if this is a save-only request (for dynamic navigation)
            if ($isSaveOnly) {
                $validated = $request->validate([
                    'organizations.*.name' => 'nullable|string|max:255',
                    'organizations.*.address' => 'nullable|string|max:500',
                    'organizations.*.month' => 'nullable|string|max:2',
                    'organizations.*.year' => 'nullable|integer|min:1900|max:2030',
                    'organizations.*.position' => 'nullable|string|max:255',
                ]);
            } else {
                // Full validation for final submission
                $validated = $request->validate([
                    'organizations.*.name' => 'required|string|max:255',
                    'organizations.*.address' => 'required|string|max:500',
                    'organizations.*.month' => 'nullable|string|max:2',
                    'organizations.*.year' => 'nullable|integer|min:1900|max:2030',
                    'organizations.*.position' => 'required|string|max:255',
                ]);
            }

            \Log::info('Organization validated data:', $validated);

            // Additional validation for date fields based on month/year
            if (isset($validated['organizations'])) {
                foreach ($validated['organizations'] as $index => $organization) {
                    if (!empty($organization['month']) && empty($organization['year'])) {
                        if (!$isSaveOnly) {
                            return back()->withErrors(["organizations.{$index}.year" => 'Year is required when month is provided.']);
                        }
                    } elseif (empty($organization['month']) && !empty($organization['year'])) {
                        if (!$isSaveOnly) {
                            return back()->withErrors(["organizations.{$index}.month" => 'Month is required when year is provided.']);
                        }
                    }
                }
            }

            // Save organization data to database
            if (isset($validated['organizations'])) {
                foreach ($validated['organizations'] as $organization) {
                    if (!empty($organization['name'])) {
                        // Create or update address details if address is provided
                        $addressId = null;
                        if (!empty($organization['address'])) {
                            $address = AddressDetails::updateOrCreate(
                                [
                                    'street' => $organization['address'],
                                    'country' => 'Philippines' // Default country
                                ],
                                [
                                    'barangay' => '',
                                    'municipality' => '',
                                    'province' => '',
                                    'city' => '',
                                    'zip_code' => ''
                                ]
                            );
                            $addressId = $address->addr_id;
                        }

                        // Create or update organization
                        $org = Organization::updateOrCreate(
                            [
                                'org_name' => $organization['name']
                            ],
                            [
                                'org_type' => 'membership', // Default type
                                'org_address' => $addressId
                            ]
                        );

                        // Create or update membership details
                        $membershipData = [
                            'username' => Auth::user()->username,
                            'org_id' => $org->org_id,
                            'membership_type' => 'member',
                            'position_held' => $organization['position'] ?? null,
                        ];

                        // Handle date of membership using month/year
                        if (!empty($organization['month']) && !empty($organization['year'])) {
                            $membershipData['date_joined'] = $organization['year'] . '-' . $organization['month'] . '-01';
                        }

                        MembershipDetails::updateOrCreate(
                            [
                                'username' => Auth::user()->username,
                                'org_id' => $org->org_id
                            ],
                            $membershipData
                        );
                    }
                }
            }

            \Log::info('Organization after save:', [
                'organizations' => Organization::all()->toArray(),
                'membership_details' => MembershipDetails::where('username', Auth::user()->username)->get()->toArray(),
            ]);

            // Mark organization section as completed
            session()->put('phs_sections.organization', 'completed');
            
            // Return appropriate response based on mode
            if ($isSaveOnly) {
                return response()->json(['success' => true, 'message' => 'Organization information saved successfully']);
            }
            
            return redirect()->route('phs.miscellaneous')->with('success', 'Organization information saved successfully!'); 
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'errors' => $e->errors()], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'An error occurred while saving'], 500);
            }
            return back()->with('error', 'An error occurred while saving your organization information. Please try again.');
        }
    })->name('phs.organization.store');

    // PHS Routes - Character and Reputation
    Route::get('/phs/character-and-reputation', [CharacterReputationController::class, 'create'])->name('phs.character-and-reputation');
    Route::post('/phs/character-and-reputation', [CharacterReputationController::class, 'store'])->name('phs.character-and-reputation.store');

    // PHS Routes - Miscellaneous
    Route::get('/phs/miscellaneous', function() {
        $miscellaneous = Miscellaneous::where('username', Auth::user()->username)->where('misc_type', 'general-miscellaneous')->first();
        
        // Decode languages data if it exists
        $languages = [];
        if ($miscellaneous && $miscellaneous->languages_dialects) {
            $languages = json_decode($miscellaneous->languages_dialects, true) ?: [];
        }
        
        $viewData = [
            'miscellaneous' => $miscellaneous,
            'languages' => $languages
        ];

        if (request()->ajax()) {
            return view('phs.sections.miscellaneous-content', $viewData);
        }

        return view('phs.miscellaneous-new', $viewData);
    })->name('phs.miscellaneous');

    Route::post('/phs/miscellaneous', function(Request $request) {
        $isSaveOnly = $request->header('X-Save-Only') === 'true';
        try {
            // Check if this is a save-only request (for dynamic navigation)
            if ($isSaveOnly) {
                $validated = $request->validate([
                    'hobbies_sports_pastimes' => 'nullable|string',
                    'languages' => 'nullable|array',
                    'languages.*.language' => 'nullable|string|max:255',
                    'languages.*.speak' => 'nullable|in:FLUENT,FAIR,POOR',
                    'languages.*.read' => 'nullable|in:FLUENT,FAIR,POOR',
                    'languages.*.write' => 'nullable|in:FLUENT,FAIR,POOR',
                    'lie_detection_test' => 'nullable|in:yes,no',
                ]);
            } else {
                // Full validation for final submission
                $validated = $request->validate([
                    'hobbies_sports_pastimes' => 'required|string',
                    'languages' => 'nullable|array',
                    'languages.*.language' => 'nullable|string|max:255',
                    'languages.*.speak' => 'nullable|in:FLUENT,FAIR,POOR',
                    'languages.*.read' => 'nullable|in:FLUENT,FAIR,POOR',
                    'languages.*.write' => 'nullable|in:FLUENT,FAIR,POOR',
                    'lie_detection_test' => 'required|in:yes,no',
                ]);
            }

            \Log::info('Miscellaneous validated data:', $validated);

            // Process languages data
            $languagesData = '';
            if (isset($validated['languages'])) {
                $languagesArray = [];
                foreach ($validated['languages'] as $language) {
                    if (!empty($language['language'])) {
                        $languagesArray[] = [
                            'language' => $language['language'],
                            'speak' => $language['speak'] ?? '',
                            'read' => $language['read'] ?? '',
                            'write' => $language['write'] ?? ''
                        ];
                    }
                }
                $languagesData = json_encode($languagesArray);
            }

            $miscellaneous = Miscellaneous::updateOrCreate(
                ['username' => Auth::user()->username, 'misc_type' => 'general-miscellaneous'],
                [
                    'hobbies_sports_pastimes' => $validated['hobbies_sports_pastimes'] ?? '',
                    'languages_dialects' => $languagesData,
                    'lie_detection_test' => $validated['lie_detection_test'] ?? null,
                ]
            );

            \Log::info('Miscellaneous after save:', $miscellaneous->toArray());

            session()->put('phs_sections.miscellaneous', 'completed');
            
            // Return appropriate response based on mode
            if ($isSaveOnly) {
                return response()->json(['success' => true, 'message' => 'Miscellaneous information saved successfully']);
            }
            
            return redirect()->route('phs.review')->with('success', 'Miscellaneous information saved successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'errors' => $e->errors()], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'An error occurred while saving'], 500);
            }
            return back()->with('error', 'An error occurred while saving your miscellaneous information. Please try again.');
        }
    })->name('phs.miscellaneous.store');

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
