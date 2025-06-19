@extends('layouts.admin')

@section('title', 'Reports')
@section('header', 'Reports')

@section('content')
<div class="space-y-6">
    <!-- Search Bar with Filter Dropdowns -->
    <x-admin.search-bar 
        :route="route('admin.reports.index')"
        placeholder="Search user, action, file, or any field..."
        :filters="[
            'status' => [
                'success' => 'Success',
                'warning' => 'Warning',
                'error' => 'Error'
            ],
            'user_type' => [
                'admin' => 'Admin',
                'personnel' => 'Personnel',
                'regular' => 'Regular'
            ],
            'date_range' => true
        ]"
    />

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
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            {{ $data->links() }}
        </div>
        @endif
    </div>
</div>
@endsection 