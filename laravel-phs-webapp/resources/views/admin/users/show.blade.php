<div class="space-y-6">
    <!-- User Header -->
    <div class="flex items-center space-x-4">
        <div class="flex-shrink-0">
            <img class="h-16 w-16 rounded-full object-cover border-4 border-white shadow-lg" 
                 src="{{ $user->profile_photo_url }}" 
                 alt="{{ $user->first_name }}">
        </div>
        <div class="flex-1">
            <h3 class="text-xl font-bold text-gray-900">{{ $user->first_name }}</h3>
            <p class="text-gray-500">@{{ $user->username }}</p>
            <div class="flex items-center gap-2 mt-1">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                    {{ $user->usertype === 'admin' ? 'bg-purple-100 text-purple-800' : 
                       ($user->usertype === 'personnel' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800') }}">
                    {{ ucfirst($user->usertype) }}
                </span>
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                    {{ ucfirst($user->organic_role) }}
                </span>
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    <i class="fas {{ $user->is_active ? 'fa-check-circle' : 'fa-times-circle' }} mr-1"></i>
                    {{ $user->is_active ? 'Active' : 'Disabled' }}
                </span>
            </div>
        </div>
    </div>

    <!-- User Information Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Personal Information -->
        <div class="bg-gray-50 rounded-lg p-4">
            <h4 class="text-sm font-semibold text-gray-700 mb-3 flex items-center">
                <i class="fas fa-user mr-2 text-[#1B365D]"></i>
                Personal Information
            </h4>
            <div class="space-y-3">
                <div>
                    <label class="text-xs font-medium text-gray-500">Full Name</label>
                    <p class="text-sm text-gray-900">{{ $user->first_name }}</p>
                </div>
                <div>
                    <label class="text-xs font-medium text-gray-500">Username</label>
                    <p class="text-sm text-gray-900 font-mono">{{ $user->username }}</p>
                </div>
                <div>
                    <label class="text-xs font-medium text-gray-500">Email Address</label>
                    <p class="text-sm text-gray-900">{{ $user->email }}</p>
                </div>
                <div>
                    <label class="text-xs font-medium text-gray-500">Branch</label>
                    <p class="text-sm text-gray-900">{{ $user->branch ?? 'PMA' }}</p>
                </div>
            </div>
        </div>

        <!-- Account Information -->
        <div class="bg-gray-50 rounded-lg p-4">
            <h4 class="text-sm font-semibold text-gray-700 mb-3 flex items-center">
                <i class="fas fa-shield-alt mr-2 text-[#1B365D]"></i>
                Account Information
            </h4>
            <div class="space-y-3">
                <div>
                    <label class="text-xs font-medium text-gray-500">User Type</label>
                    <p class="text-sm text-gray-900 capitalize">{{ $user->usertype }}</p>
                </div>
                <div>
                    <label class="text-xs font-medium text-gray-500">Organic Group</label>
                    <p class="text-sm text-gray-900 capitalize">{{ $user->organic_role }}</p>
                </div>
                <div>
                    <label class="text-xs font-medium text-gray-500">Account Status</label>
                    <p class="text-sm">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $user->is_active ? 'Active' : 'Disabled' }}
                        </span>
                    </p>
                </div>
                <div>
                    <label class="text-xs font-medium text-gray-500">Admin Access</label>
                    <p class="text-sm">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->is_admin ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $user->is_admin ? 'Yes' : 'No' }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Activity Information -->
    <div class="bg-gray-50 rounded-lg p-4">
        <h4 class="text-sm font-semibold text-gray-700 mb-3 flex items-center">
            <i class="fas fa-clock mr-2 text-[#1B365D]"></i>
            Activity Information
        </h4>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="text-xs font-medium text-gray-500">Account Created</label>
                <p class="text-sm text-gray-900">{{ $user->created_at ? $user->created_at->format('M d, Y \a\t g:i A') : 'N/A' }}</p>
<p class="text-xs text-gray-500">{{ $user->created_at ? $user->created_at->diffForHumans() : 'N/A' }}</p>
            </div>
            <div>
                <label class="text-xs font-medium text-gray-500">Last Login</label>
                @if($user->last_login_at)
                    <p class="text-sm text-gray-900">{{ $user->last_login_at->format('M d, Y \a\t g:i A') }}</p>
                    <p class="text-xs text-gray-500">{{ $user->last_login_at->diffForHumans() }}</p>
                @else
                    <p class="text-sm text-gray-500">Never logged in</p>
                @endif
            </div>
            <div>
                <label class="text-xs font-medium text-gray-500">Created By</label>
                <p class="text-sm text-gray-900">{{ $user->created_by ?? 'System' }}</p>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200">
        <a href="{{ route('admin.users.edit', $user) }}" 
           class="inline-flex items-center px-4 py-2 border border-[#1B365D] text-[#1B365D] bg-white hover:bg-[#1B365D] hover:text-white rounded-lg font-medium text-sm transition-all duration-200">
            <i class="fas fa-edit mr-2"></i>
            Edit User
        </a>
        <button onclick="toggleUserStatus('{{ $user->username }}', {{ $user->is_active ? 'false' : 'true' }})" 
                class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg font-medium text-sm transition-all duration-200
                       {{ $user->is_active ? 'bg-red-100 text-red-700 hover:bg-red-200' : 'bg-green-100 text-green-700 hover:bg-green-200' }}">
            <i class="fas {{ $user->is_active ? 'fa-user-times' : 'fa-user-check' }} mr-2"></i>
            {{ $user->is_active ? 'Disable' : 'Enable' }} User
        </button>
    </div>
</div> 