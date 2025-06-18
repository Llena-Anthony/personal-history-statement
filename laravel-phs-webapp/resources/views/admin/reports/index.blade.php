@extends('layouts.admin')

@section('title', 'Reports')
@section('header', 'Reports')

@section('content')
<div class="space-y-6">
    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-sm p-6 scale-in">
        <form action="{{ route('admin.reports.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" 
                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#1B365D] focus:ring focus:ring-[#1B365D] focus:ring-opacity-50"
                    placeholder="Search user, action, file...">
            </div>
            <div>
                <label for="user_type" class="block text-sm font-medium text-gray-700 mb-1">User Role</label>
                <select name="user_type" id="user_type" 
                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#1B365D] focus:ring focus:ring-[#1B365D] focus:ring-opacity-50">
                    <option value="">All Roles</option>
                    @foreach($userTypes as $role)
                        <option value="{{ $role }}" {{ request('user_type') == $role ? 'selected' : '' }}>{{ ucfirst($role) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" id="status" 
                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#1B365D] focus:ring focus:ring-[#1B365D] focus:ring-opacity-50">
                    <option value="">All Status</option>
                    @foreach($statuses as $statusOpt)
                        <option value="{{ $statusOpt }}" {{ request('status') == $statusOpt ? 'selected' : '' }}>{{ ucfirst($statusOpt) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="date_from" class="block text-sm font-medium text-gray-700 mb-1">Date From</label>
                <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}" 
                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#1B365D] focus:ring focus:ring-[#1B365D] focus:ring-opacity-50">
            </div>
            <div>
                <label for="date_to" class="block text-sm font-medium text-gray-700 mb-1">Date To</label>
                <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}" 
                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#1B365D] focus:ring focus:ring-[#1B365D] focus:ring-opacity-50">
            </div>
            <div class="flex items-end space-x-2">
                <button type="submit" class="px-4 py-2 bg-[#1B365D] text-white rounded-lg hover:bg-[#2B4B7D] focus:outline-none focus:ring-2 focus:ring-[#1B365D] focus:ring-opacity-50">
                    <i class="fas fa-search mr-2"></i>Filter
                </button>
                <a href="{{ route('admin.reports.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">
                    <i class="fas fa-times mr-2"></i>Clear
                </a>
            </div>
        </form>
    </div>

    <!-- Export Button -->
    <div class="flex justify-end mb-2">
        <a href="{{ route('admin.reports.export', request()->query()) }}" 
           class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
            <i class="fas fa-download mr-2"></i>Export CSV
        </a>
    </div>

    <!-- Reports Table -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden scale-in">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Time</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($data as $log)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $log->user->name ?? 'N/A' }}</div>
                            <div class="text-xs text-gray-500">{{ $log->user->email ?? 'N/A' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ ucfirst($log->user->usertype ?? 'N/A') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ ucfirst($log->action) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $log->description }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if($log->status === 'success') bg-green-100 text-green-800
                                @elseif($log->status === 'warning') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($log->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $log->created_at->format('M d, Y h:i A') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            No records found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        @if(method_exists($data, 'links'))
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
            {{ $data->links() }}
        </div>
        @endif
    </div>
</div>
@endsection 