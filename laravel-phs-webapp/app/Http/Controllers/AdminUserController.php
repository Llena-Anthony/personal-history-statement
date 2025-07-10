<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\ActivityLogDetail;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        $filters = $request->all();

        // Map status filter to boolean for User model, only allow 'active' or 'disabled'
        if (isset($filters['status'])) {
            $status = strtolower(trim($filters['status']));
            Log::info('Received status filter:', ['status' => $status]);
            if ($status === 'active') {
                $filters['status'] = 1;
            } elseif ($status === 'disabled') {
                $filters['status'] = 0;
            } else {
                unset($filters['status']); // Ignore any other value
            }
        }

        Log::info('User Management Filters:', $filters);

        // Apply all filters using the Searchable trait
        $query->applyFilters($filters);

        Log::info('User Management SQL:', ['sql' => $query->toSql(), 'bindings' => $query->getBindings()]);

        // Handle sorting
        $sort = $request->get('sort', 'username');
        $direction = $request->get('direction', 'asc');

        if (in_array($sort, ['username', 'usertype', 'organic_role', 'is_active'])) {
            $query->orderBy($sort, $direction);
        } else {
            $query->orderBy('username', 'asc');
        }

        // Get pagination per page from request or default to 10
        $perPage = $request->get('per_page', 10);
        $users = $query->paginate($perPage)->withQueryString();

        // Get searchable fields for the search bar
        $searchFields = collect((new User())->getSearchableFields())->mapWithKeys(function ($config, $field) {
            return [$field => $config['label'] ?? ucfirst(str_replace('_', ' ', $field))];
        })->toArray();

        $data = compact('users', 'searchFields');

        // Check if it's an AJAX request
        if (request()->ajax()) {
            return view('admin.users.index', $data)->render();
        }

        return view('admin.users.index', $data);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'user_type' => ['required', 'string', 'in:admin,personnel,client'],
            'organic_group' => ['required', 'string', 'in:civilian,enlisted,officer'],
        ]);

        // Capitalize first letter of each word for names
        $validated['first_name'] = ucwords(strtolower($validated['first_name']));
        $validated['middle_name'] = $validated['middle_name'] ? ucwords(strtolower($validated['middle_name'])) : null;
        $validated['last_name'] = ucwords(strtolower($validated['last_name']));

        // Generate username from first letters of each first name + last name (no spaces)
        $firstNames = explode(' ', preg_replace('/\s+/', ' ', trim($validated['first_name'])));
        $firstLetters = '';
        foreach ($firstNames as $name) {
            $firstLetters .= strtolower(substr($name, 0, 1));
        }
        $baseUsername = $firstLetters . strtolower(str_replace(' ', '', $validated['last_name']));
        $username = $baseUsername;
        $counter = 1;

        // Check if username exists and append number if needed
        while (User::where('username', $username)->exists()) {
            $username = $baseUsername . $counter;
            $counter++;
        }

        // Generate default password (first name + last name + random 4 digits, no spaces)
        $defaultPassword = strtolower(str_replace(' ', '', $validated['first_name']) . str_replace(' ', '', $validated['last_name']) . rand(1000, 9999));

        // Store the data in session for confirmation
        session()->put('user_data', [
            'first_name' => $validated['first_name'],
            'middle_name' => $validated['middle_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'user_type' => $validated['user_type'],
            'organic_group' => $validated['organic_group'],
            'generated_username' => $username,
            'generated_password' => $defaultPassword
        ]);

        return redirect()->route('admin.users.confirm');
    }

    public function confirm()
    {
        if (!session()->has('user_data')) {
            return redirect()->route('admin.users.create')
                ->with('error', 'Please fill out the user creation form first.');
        }

        return view('admin.users.confirm', ['userData' => session('user_data')]);
    }

    public function finalize(Request $request)
    {
        Log::info('Finalize method called', [
            'request' => $request->all(),
            'session' => session()->all(),
            'has_user_data' => session()->has('user_data')
        ]);

        if (!session()->has('user_data')) {
            Log::error('No user data in session');
            if ($request->ajax()) {
                return response()->json(['error' => 'Please fill out the user creation form first.'], 400);
            }
            return redirect()->route('admin.users.create')
                ->with('error', 'Please fill out the user creation form first.');
        }

        $userData = session('user_data');
        $sessionUserData = $userData; // Save original session data for later use
        Log::info('User data from session', ['userData' => $userData]);

        try {
            // Validate the request
            $validated = $request->validate([
                'username' => ['required', 'string', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
            ]);

            DB::beginTransaction();

            // Create the user
            $userData = [
                'username' => $validated['username'],
                'password' => Hash::make($validated['password']),
                'usertype' => $sessionUserData['user_type'],
                'organic_role' => $sessionUserData['organic_group'],
                'is_active' => '1',
                'phs_status' => 'pending',
            ];

            Log::info('Attempting to create user with data', ['userData' => $userData]);

            $user = User::create($userData);

            if (!$user) {
                throw new \Exception('Failed to create user');
            }

            Log::info('User created successfully', ['user' => $user->toArray()]);

            // Log the user creation activity with detailed information
            $userInfo = $sessionUserData['first_name'] . ' ' . $sessionUserData['last_name'] . ' (' . $user->username . ')';
            $userDetails = 'Type: ' . ucfirst($user->usertype) . ' | Organic Group: ' . ucfirst($user->organic_role);
            $description = "Created new user: {$userInfo} | {$userDetails}";

            ActivityLogDetail::create([
                'changes_made_by' => auth()->user()->username,
                'action' => 'create',
                'act_desc' => $description,
                'act_stat' => 'success',
                'ip_addr' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'act_date_time' => now(),
            ]);

            // Create NameDetail record first
            $nameDetail = \App\Models\NameDetail::create([
                'last_name' => $sessionUserData['last_name'],
                'first_name' => $sessionUserData['first_name'],
                'middle_name' => $sessionUserData['middle_name'],
                'suffix' => null,
                'nickname' => null,
                'change_in_name' => null,
            ]);

            // Create AddressDetail record (empty address)
            $homeAddress = \App\Models\AddressDetail::firstOrCreate([
                'country' => null,
                'region' => null,
                'province' => null,
                'city' => null,
                'barangay' => null,
                'street' => null,
                'zip_code' => null,
            ]);

            // Create birth address (empty address)
            $birthAddress = \App\Models\AddressDetail::firstOrCreate([
                'country' => null,
                'region' => null,
                'province' => null,
                'city' => null,
                'barangay' => null,
                'street' => null,
                'zip_code' => null,
            ]);

            // Create UserDetail record
            \App\Models\UserDetail::create([
                'username' => $validated['username'],
                'full_name' => $nameDetail->name_id,
                'profile_path' => null,
                'home_addr' => $homeAddress->addr_id,
                'birth_date' => null,
                'birth_place' => $birthAddress->addr_id,
                'nationality' => null,
                'religion' => null,
                'mobile_num' => null,
                'email_addr' => $sessionUserData['email'],
            ]);

            Log::info('User details created successfully', [
                'name_detail_id' => $nameDetail->name_id,
                'home_address_id' => $homeAddress->addr_id,
                'birth_address_id' => $birthAddress->addr_id
            ]);

            DB::commit();

            // Clear the session data
            session()->forget('user_data');

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'User created successfully.',
                    'redirect' => route('admin.users.index'),
                    'credentials' => [
                        'username' => $validated['username'],
                        'password' => $validated['password']
                    ]
                ]);
            }

            return redirect()->route('admin.users.index')
                ->with('success', 'User created successfully.')
                ->with('generated_credentials', [
                    'username' => $validated['username'],
                    'password' => $validated['password']
                ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            Log::error('Validation failed', [
                'errors' => $e->errors(),
                'trace' => $e->getTraceAsString()
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'error' => 'Please check the form for errors: ' . collect($e->errors())->first()[0]
                ], 422);
            }

            return redirect()->route('admin.users.confirm')
                ->with('error', 'Please check the form for errors: ' . collect($e->errors())->first()[0])
                ->withInput();
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            Log::error('Database error during user creation', [
                'error' => $e->getMessage(),
                'sql' => $e->getSql(),
                'bindings' => $e->getBindings(),
                'trace' => $e->getTraceAsString()
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'error' => 'Database error occurred while creating the user: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->route('admin.users.confirm')
                ->with('error', 'Database error occurred while creating the user: ' . $e->getMessage())
                ->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('User creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'error' => 'An error occurred while creating the user: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->route('admin.users.confirm')
                ->with('error', 'An error occurred while creating the user: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'usertype' => ['required', 'string', 'in:admin,personnel,client'],
            'is_active' => ['required', 'boolean'],
        ]);

        // Store original values for comparison
        $originalValues = [
            'usertype' => $user->usertype,
            'is_active' => $user->is_active,
        ];

        try {
            $user->update([
                'usertype' => $validated['usertype'],
                'is_active' => $validated['is_active'],
                'is_admin' => $validated['usertype'] === 'admin',
            ]);

            // Manually log the activity with more context
            $changes = [];
            if ($originalValues['usertype'] !== $validated['usertype']) {
                $changes[] = "User Type: " . ucfirst($originalValues['usertype']) . " → " . ucfirst($validated['usertype']);
            }
            if ($originalValues['is_active'] !== $validated['is_active']) {
                $oldStatus = $originalValues['is_active'] ? 'Active' : 'Inactive';
                $newStatus = $validated['is_active'] ? 'Active' : 'Inactive';
                $changes[] = "Status: {$oldStatus} → {$newStatus}";
            }

            // Only log if there are actual changes
            if (!empty($changes)) {
                $userDetail = $user->userDetail;
                $userInfo = $userDetail ? $userDetail->nameDetail->first_name . ' ' . $userDetail->nameDetail->last_name . ' (' . $user->username . ')' : $user->username;
                $changesList = implode(' | ', $changes);
                $description = "Updated user: {$userInfo} | Changes: {$changesList}";

                ActivityLogDetail::create([
                    'changes_made_by' => auth()->user()->username,
                    'action' => 'update',
                    'act_desc' => $description,
                    'act_stat' => 'success',
                    'ip_addr' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'act_date_time' => now(),
                ]);
            }

            return redirect()->route('admin.users.index')
                ->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            Log::error('User update failed', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->with('error', 'An error occurred while updating the user: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show(User $user)
    {
        if (request()->ajax()) {
            $html = view('admin.users.show', compact('user'))->render();
            return response()->json(['html' => $html]);
        }

        return view('admin.users.show', compact('user'));
    }

    public function toggleStatus(Request $request, User $user)
    {
        $validated = $request->validate([
            'is_active' => ['required', 'boolean'],
        ]);

        try {
            $oldStatus = $user->is_active ? 'Active' : 'Disabled';
            $newStatus = $validated['is_active'] ? 'Active' : 'Disabled';

            $user->update(['is_active' => $validated['is_active']]);

            // Log the status change
            $userDetail = $user->userDetail;
            $userInfo = $userDetail ? $userDetail->nameDetail->first_name . ' ' . $userDetail->nameDetail->last_name . ' (' . $user->username . ')' : $user->username;
            $description = "Changed user status: {$userInfo} | Status: {$oldStatus} → {$newStatus}";

            ActivityLogDetail::create([
                'changes_made_by' => auth()->user()->username,
                'action' => 'update',
                'act_desc' => $description,
                'act_stat' => 'success',
                'ip_addr' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'act_date_time' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => "User status updated to {$newStatus} successfully."
            ]);
        } catch (\Exception $e) {
            Log::error('User status toggle failed', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating user status.'
            ], 500);
        }
    }

    public function export(Request $request)
    {
        $query = User::query();

        // Apply filters if any
        $filters = $request->all();
        if (isset($filters['status'])) {
            $status = strtolower(trim($filters['status']));
            if ($status === 'active') {
                $filters['status'] = 1;
            } elseif ($status === 'disabled') {
                $filters['status'] = 0;
            } else {
                unset($filters['status']);
            }
        }

        // Apply filters using the Searchable trait
        $query->applyFilters($filters);

        // Handle specific user selection
        if ($request->has('users')) {
            $userIds = explode(',', $request->get('users'));
            $query->whereIn('id', $userIds);
        }

        $users = $query->get();

        $filename = 'users_export_' . now()->format('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($users) {
            $file = fopen('php://output', 'w');

            // CSV Headers
            fputcsv($file, [
                'Username', 'Name', 'Username', 'Email', 'User Type', 'Organic Group',
                'Branch', 'Status', 'Created By', 'Created At', 'Last Login'
            ]);

            // CSV Data
            foreach ($users as $user) {
                fputcsv($file, [
                    $user->username,
                    $user->name,
                    $user->username,
                    $user->email,
                    ucfirst($user->usertype),
                    ucfirst($user->organic_role),
                    'N/A', // branch field doesn't exist
                    $user->is_active ? 'Active' : 'Disabled',
                    'N/A', // created_by field doesn't exist
                    $user->created_at ? $user->created_at->format('Y-m-d H:i:s') : 'N/A',
                    $user->last_login_at ? $user->last_login_at->format('Y-m-d H:i:s') : 'Never'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
