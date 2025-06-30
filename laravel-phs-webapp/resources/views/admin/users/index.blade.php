@extends('layouts.admin')

@section('title', 'User Management')

@section('header', 'User Management')

@section('content')
<div class="space-y-6">
    <!-- Enhanced Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-[#1B365D] flex items-center gap-3">
                <div class="bg-gradient-to-br from-[#1B365D] to-[#2B4B7D] text-white p-3 rounded-xl shadow-lg">
                    <i class="fas fa-users text-xl"></i>
                </div>
                User Management
            </h1>
            <p class="text-gray-600 mt-2">Manage system users, their access levels, and account status</p>
        </div>
        <div class="flex items-center gap-4">
            <div class="text-right bg-white p-4 rounded-xl shadow-sm border border-gray-200">
                <div class="text-sm text-gray-500 font-medium">Total Users</div>
                <div class="text-3xl font-bold text-[#1B365D]">{{ $users->total() }}</div>
                <div class="text-xs text-[#D4AF37] mt-1">
                    <i class="fas fa-arrow-up mr-1"></i>
                    {{ $users->where('created_at', '>=', now()->subDays(30))->count() }} this month
                </div>
            </div>
            <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-gradient-to-r from-[#1B365D] to-[#2B4B7D] hover:from-[#2B4B7D] hover:to-[#1B365D] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D] transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
            <i class="fas fa-plus mr-2"></i>
            Add New User
        </a>
        </div>
    </div>

    <!-- Success Message for User Update -->
    @if (session('success'))
        <div class="bg-green-50 border border-green-200 rounded-xl p-4 fade-in mb-4">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-500 text-xl"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Enhanced Search Bar with Filter Dropdowns -->
    <x-admin.search-bar 
        :route="route('admin.users.index')"
        placeholder="Search by name, username, email, or any field..."
        :filters="[
            'status' => [
                'active' => 'Active',
                'disabled' => 'Disabled'
            ],
            'user_type' => [
                'admin' => 'Admin',
                'personnel' => 'Personnel',
                'client' => 'Client'
            ],
            'date_range' => true
        ]"
    />

    <!-- Success Messages with Enhanced Styling -->
    @if(session('generated_credentials'))
    <div class="bg-gradient-to-r from-[#1B365D]/10 to-[#2B4B7D]/10 border border-[#1B365D]/20 rounded-xl p-4 animate-fade-in">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <i class="fas fa-key text-[#1B365D] text-xl mt-1"></i>
            </div>
            <div class="ml-3 flex-1">
                <h3 class="text-sm font-medium text-[#1B365D]">Credentials Generated</h3>
                    <div class="mt-2 space-y-2">
                    <div class="flex items-center justify-between bg-white p-3 rounded-lg border border-[#1B365D]/20">
                        <div>
                            <span class="text-xs font-medium text-gray-500">Username:</span>
                            <span class="text-sm font-mono text-gray-900 ml-2">{{ session('generated_credentials')['username'] }}</span>
                        </div>
                        <button onclick="copyToClipboard('{{ session('generated_credentials')['username'] }}')" class="text-[#1B365D] hover:text-[#2B4B7D] p-1 rounded">
                                <i class="fas fa-copy"></i>
                            </button>
                    </div>
                    <div class="flex items-center justify-between bg-white p-3 rounded-lg border border-[#1B365D]/20">
                        <div>
                            <span class="text-xs font-medium text-gray-500">Password:</span>
                            <span class="text-sm font-mono text-gray-900 ml-2">{{ session('generated_credentials')['password'] }}</span>
                        </div>
                        <button onclick="copyToClipboard('{{ session('generated_credentials')['password'] }}')" class="text-[#1B365D] hover:text-[#2B4B7D] p-1 rounded">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                    </div>
                <div class="mt-3 text-xs text-[#1B365D]">
                    <i class="fas fa-info-circle mr-1"></i>
                    These credentials have been sent to the user's email address.
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Enhanced Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-gradient-to-br from-[#1B365D]/10 to-[#2B4B7D]/10 rounded-xl shadow-sm p-6 border border-[#1B365D]/20 hover:shadow-md transition-all duration-200">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-[#1B365D]/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-user-check text-[#1B365D] text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Active Users</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $users->where('is_active', true)->count() }}</p>
                    <p class="text-xs text-[#1B365D] mt-1">
                        <i class="fas fa-arrow-up mr-1"></i>
                        {{ number_format(($users->where('is_active', true)->count() / max($users->count(), 1)) * 100, 1) }}% of total
                    </p>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-[#D4AF37]/10 to-[#B38F2A]/10 rounded-xl shadow-sm p-6 border border-[#D4AF37]/20 hover:shadow-md transition-all duration-200">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-[#D4AF37]/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-user-times text-[#D4AF37] text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Disabled Users</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $users->where('is_active', false)->count() }}</p>
                    <p class="text-xs text-[#D4AF37] mt-1">
                        <i class="fas fa-arrow-down mr-1"></i>
                        {{ number_format(($users->where('is_active', false)->count() / max($users->count(), 1)) * 100, 1) }}% of total
                    </p>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-[#1B365D]/10 to-[#2B4B7D]/10 rounded-xl shadow-sm p-6 border border-[#1B365D]/20 hover:shadow-md transition-all duration-200">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-[#1B365D]/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-user-shield text-[#1B365D] text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Administrators</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $users->where('usertype', 'admin')->count() }}</p>
                    <p class="text-xs text-[#1B365D] mt-1">
                        <i class="fas fa-shield-alt mr-1"></i>
                        System access
                    </p>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-[#D4AF37]/10 to-[#B38F2A]/10 rounded-xl shadow-sm p-6 border border-[#D4AF37]/20 hover:shadow-md transition-all duration-200">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-[#D4AF37]/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-users text-[#D4AF37] text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Personnels</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $users->where('usertype', 'personnel')->count() }}</p>
                    <p class="text-xs text-[#D4AF37] mt-1">
                        <i class="fas fa-user-tie mr-1"></i>
                        Total personnel
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Results Count and Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-4 rounded-xl shadow-sm border border-gray-200">
        <div class="flex items-center gap-4">
            <div class="text-sm text-gray-600">
                <span class="font-medium">{{ $users->firstItem() ?? 0 }}</span> to 
                <span class="font-medium">{{ $users->lastItem() ?? 0 }}</span> of 
                <span class="font-medium">{{ $users->total() }}</span> results
            </div>
            @if($users->total() > 0)
            <div class="flex items-center gap-2">
                <span class="text-sm text-gray-500">Per page:</span>
                <select onchange="window.location.href='{{ request()->fullUrlWithQuery(['per_page' => '']) }}' + this.value" class="text-sm border border-gray-300 rounded-lg px-3 py-1 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('per_page', 10) == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('per_page', 10) == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('per_page', 10) == 100 ? 'selected' : '' }}>100</option>
                </select>
            </div>
            @endif
        </div>
    </div>

    <!-- Enhanced Users Table -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden animate-scale-in border border-gray-200">
        <div class="overflow-x-auto">
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-[#1B365D] to-[#2B4B7D]">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                            <span>User</span>
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Contact</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">User Type</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Organic Group</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($users as $user)
                    <tr class="hover:bg-gray-50 transition-colors duration-200 group">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-12 w-12 relative">
                                        <img class="h-12 w-12 rounded-full object-cover ring-2 ring-white shadow-sm" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
                                        @if($user->is_active)
                                        <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-400 border-2 border-white rounded-full"></div>
                                        @else
                                        <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-red-400 border-2 border-white rounded-full"></div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-semibold text-gray-900">{{ $user->name }}</div>
                                        <div class="text-sm text-gray-500 font-mono">{{ '@' . $user->username }}</div>
                                        @if($user->is_admin)
                                        <div class="text-xs text-[#1B365D] font-medium mt-1">
                                            <i class="fas fa-crown mr-1"></i>Admin Access
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900 font-medium">{{ $user->email }}</div>
                            <div class="text-xs text-gray-400 mt-1">
                                <i class="fas fa-calendar mr-1"></i>
                                Joined {{ $user->created_at->format('M Y') }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 inline-flex items-center text-xs leading-5 font-semibold rounded-full 
                                {{ $user->usertype === 'admin' ? 'bg-[#1B365D]/20 text-[#1B365D] border border-[#1B365D]/30' : 
                                   ($user->usertype === 'personnel' ? 'bg-[#D4AF37]/20 text-[#D4AF37] border border-[#D4AF37]/30' : 'bg-[#1B365D]/20 text-[#1B365D] border-[#1B365D]/30') }}">
                                <i class="fas {{ $user->usertype === 'admin' ? 'fa-user-shield' : ($user->usertype === 'personnel' ? 'fa-user-tie' : 'fa-user') }} mr-1"></i>
                                <span class="align-middle">{{ ucfirst($user->usertype) }}</span>
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 inline-flex items-center text-xs leading-5 font-semibold rounded-full bg-[#D4AF37]/20 text-[#D4AF37] border border-[#D4AF37]/30">
                                <span class="align-middle">{{ ucfirst($user->organic_role) }}</span>
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-1">
                                <a href="{{ route('admin.users.edit', $user) }}" 
                                   class="text-[#1B365D] hover:text-[#2B4B7D] p-2 rounded-lg hover:bg-[#1B365D]/10 transition-all duration-200 group-hover:bg-[#1B365D]/10" 
                                   title="Edit User">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-20 h-20 bg-[#1B365D]/10 rounded-full flex items-center justify-center mb-4">
                                    <i class="fas fa-users text-[#1B365D] text-3xl"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">No users found</h3>
                                <p class="text-gray-500 mb-4 max-w-md">Get started by creating your first user account. You can add administrators, personnel, and client users.</p>
                                <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-gradient-to-r from-[#1B365D] to-[#2B4B7D] hover:from-[#2B4B7D] hover:to-[#1B365D] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D] transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                    <i class="fas fa-plus mr-2"></i>
                                    Add New User
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($users->hasPages())
        <div class="px-6 py-4 border-t border-gray-200 bg-[#1B365D]/5">
            {{ $users->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Enhanced User Details Modal -->
<div id="userDetailsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-xl shadow-xl max-w-4xl w-full mx-auto max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-[#1B365D] to-[#2B4B7D]">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-semibold text-white flex items-center gap-2">
                    <i class="fas fa-user-circle text-[#D4AF37]"></i>
                    User Details
                </h3>
                <button onclick="closeUserDetailsModal()" class="text-white/80 hover:text-white p-2 rounded-lg hover:bg-white/10 transition-colors duration-200">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
        </div>
        <div id="userDetailsContent" class="p-6">
            <!-- Content will be loaded here -->
        </div>
    </div>
</div>

<script>
// Enhanced copy to clipboard functionality
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        const button = event.currentTarget;
        const originalIcon = button.innerHTML;
        button.innerHTML = '<i class="fas fa-check text-[#1B365D]"></i>';
        button.classList.add('text-[#1B365D]');
        
        // Show toast notification
        showToast('Copied to clipboard!', 'success');
        
        setTimeout(() => {
            button.innerHTML = originalIcon;
            button.classList.remove('text-[#1B365D]');
        }, 2000);
    }).catch(() => {
        showToast('Failed to copy to clipboard', 'error');
    });
}

// Toast notification function
function showToast(message, type = 'info') {
    const toast = document.createElement('div');
    toast.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg text-white font-medium shadow-lg transform transition-all duration-300 translate-x-full ${
        type === 'success' ? 'bg-[#1B365D]' : 
        type === 'error' ? 'bg-[#D4AF37]' : 'bg-[#1B365D]'
    }`;
    toast.textContent = message;
    
    document.body.appendChild(toast);
    
    // Animate in
    setTimeout(() => {
        toast.classList.remove('translate-x-full');
    }, 100);
    
    // Animate out and remove
    setTimeout(() => {
        toast.classList.add('translate-x-full');
        setTimeout(() => {
            document.body.removeChild(toast);
        }, 300);
    }, 3000);
}

// Enhanced user details modal
function viewUserDetails(userId) {
    const modal = document.getElementById('userDetailsModal');
    const content = document.getElementById('userDetailsContent');
    
    // Show loading with better animation
    content.innerHTML = `
        <div class="flex items-center justify-center py-12">
            <div class="text-center">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-[#1B365D] mx-auto mb-4"></div>
                <p class="text-gray-600">Loading user details...</p>
            </div>
        </div>
    `;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    // Load user details via AJAX
    fetch(`/admin/users/${userId}/details`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to load user details');
            }
            return response.json();
        })
        .then(data => {
            content.innerHTML = data.html;
        })
        .catch(error => {
            content.innerHTML = `
                <div class="text-center py-12">
                    <div class="w-16 h-16 bg-[#D4AF37]/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-exclamation-triangle text-[#D4AF37] text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Error Loading Details</h3>
                    <p class="text-gray-500">Failed to load user details. Please try again.</p>
                </div>
            `;
        });
}

function closeUserDetailsModal() {
    const modal = document.getElementById('userDetailsModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

// Enhanced toggle user status
function toggleUserStatus(userId, newStatus) {
    const action = newStatus ? 'enable' : 'disable';
    const userRow = event.target.closest('tr');
    
    if (confirm(`Are you sure you want to ${action} this user?`)) {
        // Show loading state
        const button = event.target.closest('button');
        const originalIcon = button.innerHTML;
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        button.disabled = true;
        
        fetch(`/admin/users/${userId}/toggle-status`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ is_active: newStatus })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast(`User ${action}d successfully!`, 'success');
                setTimeout(() => {
                    location.reload();
                }, 1000);
            } else {
                showToast(data.message || 'Failed to update user status', 'error');
                button.innerHTML = originalIcon;
                button.disabled = false;
            }
        })
        .catch(error => {
            showToast('An error occurred while updating user status', 'error');
            button.innerHTML = originalIcon;
            button.disabled = false;
        });
    }
}

// Enhanced export functionality
function exportUsers() {
    const selectedUsers = Array.from(document.querySelectorAll('.user-checkbox:checked')).map(cb => cb.value);
    const params = new URLSearchParams();
    
    if (selectedUsers.length > 0) {
        params.append('users', selectedUsers.join(','));
    }
    
    // Add current filters to export
    const currentUrl = new URL(window.location);
    const filters = ['search', 'status', 'user_type', 'date_from', 'date_to'];
    filters.forEach(filter => {
        if (currentUrl.searchParams.has(filter)) {
            params.append(filter, currentUrl.searchParams.get(filter));
        }
    });
    
    showToast('Preparing export...', 'info');
    window.location.href = `{{ route('admin.users.export') }}?${params.toString()}`;
}

// Close modal when clicking outside
document.getElementById('userDetailsModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeUserDetailsModal();
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const successAlert = document.querySelector('.fade-in.bg-green-50');
    if (successAlert) {
        setTimeout(() => {
            successAlert.classList.add('opacity-0', 'transition-opacity', 'duration-500');
            setTimeout(() => {
                successAlert.style.display = 'none';
            }, 500);
        }, 3000);
    }

    // Add smooth scrolling to pagination
    const paginationLinks = document.querySelectorAll('.pagination a');
    paginationLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const href = this.getAttribute('href');
            if (href && href !== '#') {
                window.location.href = href;
            }
        });
    });
});
</script>

<style>
.animate-fade-in {
    animation: fadeIn 0.5s ease-in-out;
}

.animate-scale-in {
    animation: scaleIn 0.3s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes scaleIn {
    from { opacity: 0; transform: scale(0.95); }
    to { opacity: 1; transform: scale(1); }
}

/* Enhanced hover effects */
.hover\:shadow-md:hover {
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

/* Smooth transitions */
.transition-all {
    transition: all 0.2s ease-in-out;
}

/* Custom scrollbar for modal */
#userDetailsModal .overflow-y-auto::-webkit-scrollbar {
    width: 6px;
}

#userDetailsModal .overflow-y-auto::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 3px;
}

#userDetailsModal .overflow-y-auto::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 3px;
}

#userDetailsModal .overflow-y-auto::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}
</style>
@endsection
