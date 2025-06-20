<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');
        
        if (in_array($sort, ['name', 'username', 'email', 'usertype', 'organic_role', 'is_active', 'created_at'])) {
            $query->orderBy($sort, $direction);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // Get pagination per page from request or default to 10
        $perPage = $request->get('per_page', 10);
        $users = $query->paginate($perPage)->withQueryString();

        // Get searchable fields for the search bar
        $searchFields = collect((new User())->getSearchableFields())->mapWithKeys(function ($config, $field) {
            return [$field => $config['label'] ?? ucfirst(str_replace('_', ' ', $field))];
        })->toArray();

        return view('admin.users.index', compact('users', 'searchFields'));
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'user_type' => ['required', 'string', 'in:admin,personnel,regular'],
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
                'name' => trim(
                    ucwords(strtolower($userData['first_name'])) . ' ' .
                    ($userData['middle_name'] ? ucwords(strtolower($userData['middle_name'])) . ' ' : '') .
                    ucwords(strtolower($userData['last_name']))
                ),
                'email' => $userData['email'],
                'password' => Hash::make($validated['password']),
                'usertype' => $userData['user_type'],
                'organic_role' => $userData['organic_group'],
                'branch' => 'PMA',
                'created_by' => auth()->user()->username,
                'is_active' => true,
                'is_admin' => $userData['user_type'] === 'admin',
            ];

            Log::info('Attempting to create user with data', ['userData' => $userData]);

            $user = User::create($userData);

            if (!$user) {
                throw new \Exception('Failed to create user');
            }

            Log::info('User created successfully', ['user' => $user->toArray()]);

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

        $user->update([
            'usertype' => $validated['usertype'],
            'is_active' => $validated['is_active'],
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }
} 