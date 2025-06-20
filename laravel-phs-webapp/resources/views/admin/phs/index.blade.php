@extends('layouts.admin')

@section('title', 'PHS Submissions')

@section('header', 'PHS Submissions')

@section('content')
<div class="space-y-6">
    <!-- Search Bar with Filter Dropdowns -->
    <x-admin.search-bar
        :route="route('admin.phs.index')"
        placeholder="Search by name, username, status, notes, or any field..."
        :filters="[
            'status' => [
                'pending' => 'Pending',
                'reviewed' => 'Reviewed',
                'approved' => 'Approved',
                'rejected' => 'Rejected'
            ],
            'date_range' => true
        ]"
    />

    <!-- Submissions Table -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden scale-in">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center space-x-1">
                                <span>Applicant</span>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'name', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="text-gray-400 hover:text-gray-500">
                                    <i class="fas fa-sort"></i>
                                </a>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center space-x-1">
                                <span>Status</span>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'status', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="text-gray-400 hover:text-gray-500">
                                    <i class="fas fa-sort"></i>
                                </a>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center space-x-1">
                                <span>Submitted Date</span>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'created_at', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="text-gray-400 hover:text-gray-500">
                                    <i class="fas fa-sort"></i>
                                </a>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center space-x-1">
                                <span>Last Updated</span>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'updated_at', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="text-gray-400 hover:text-gray-500">
                                    <i class="fas fa-sort"></i>
                                </a>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($submissions as $submission)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <div class="h-10 w-10 rounded-full bg-[#1B365D] flex items-center justify-center text-white">
                                        {{ strtoupper(substr($submission->user->name, 0, 1)) }}
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $submission->user->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $submission->user->username }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                @if($submission->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($submission->status === 'reviewed') bg-blue-100 text-blue-800
                                @elseif($submission->status === 'approved') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($submission->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $submission->created_at->format('M d, Y h:i A') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $submission->updated_at->format('M d, Y h:i A') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end space-x-2">
                                <a href="{{ route('admin.phs.show', $submission->id) }}" class="text-[#1B365D] hover:text-[#2B4B7D]">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.phs.edit', $submission->id) }}" class="text-[#1B365D] hover:text-[#2B4B7D]">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" onclick="confirmPHSDelete('{{ $submission->id }}', '{{ $submission->user->name }}')" class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            No PHS submissions found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($submissions->hasPages())
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            {{ $submissions->links() }}
        </div>
        @endif
    </div>
    <a href="{{route('admin.phs.preview')}}"><hr><br>Print</a>
</div>

<!-- Confirmation Modal for PHS Delete -->
<x-confirmation-modal
    id="phsDeleteModal"
    title="Confirm PHS Deletion"
    message="Are you sure you want to delete this PHS submission? This action cannot be undone."
    confirmText="Delete Submission"
    cancelText="Cancel"
    confirmClass="bg-red-600 hover:bg-red-700"
/>

<!-- Hidden form for delete -->
<form id="delete-phs-form" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
function confirmPHSDelete(submissionId, userName) {
    showConfirmationModal(
        'phsDeleteModal',
        `Are you sure you want to delete the PHS submission for "${userName}"? This action cannot be undone and will permanently remove all associated data.`,
        function() {
            const form = document.getElementById('delete-phs-form');
            form.action = '{{ route("admin.phs.destroy", ":id") }}'.replace(':id', submissionId);
            form.submit();
        }
    );
}
</script>
@endsection
