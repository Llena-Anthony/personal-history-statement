@extends('layouts.admin')

@section('title', 'View PHS Submission')

@section('header', 'View PHS Submission')

@section('content')
<div class="space-y-6">
    <!-- Submission Details -->
    <div class="bg-white rounded-xl shadow-sm p-6 scale-in">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Applicant Info -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 mb-4">Applicant Information</h3>
                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $submission->user->name }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Username</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $submission->user->username }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $submission->user->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Submission Status -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 mb-4">Submission Status</h3>
                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <span class="mt-1 inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                            @if($submission->status === 'pending') bg-yellow-100 text-yellow-800
                            @elseif($submission->status === 'reviewed') bg-blue-100 text-blue-800
                            @elseif($submission->status === 'approved') bg-green-100 text-green-800
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ ucfirst($submission->status) }}
                        </span>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Submitted Date</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $submission->created_at->format('M d, Y h:i A') }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Last Updated</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $submission->updated_at->format('M d, Y h:i A') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PHS Form Sections -->
    <div class="space-y-6">
        <!-- Personal Information -->
        @if($submission->personalInfo)
        <div class="bg-white rounded-xl shadow-sm p-6 scale-in">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Personal Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Date of Birth</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $submission->personalInfo->date_of_birth }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Place of Birth</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $submission->personalInfo->place_of_birth }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Civil Status</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $submission->personalInfo->civil_status }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Citizenship</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $submission->personalInfo->citizenship }}</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Family History -->
        @if($submission->familyHistory)
        <div class="bg-white rounded-xl shadow-sm p-6 scale-in">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Family History</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Father's Name</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $submission->familyHistory->father_name }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Mother's Name</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $submission->familyHistory->mother_name }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Spouse's Name</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $submission->familyHistory->spouse_name ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Educational Background -->
        @if($submission->educationalBackground)
        <div class="bg-white rounded-xl shadow-sm p-6 scale-in">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Educational Background</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Elementary School</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $submission->educationalBackground->elementary_school }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">High School</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $submission->educationalBackground->high_school }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">College/University</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $submission->educationalBackground->college }}</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Employment History -->
        @if($submission->employmentHistory)
        <div class="bg-white rounded-xl shadow-sm p-6 scale-in">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Employment History</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Current Employer</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $submission->employmentHistory->current_employer }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Position</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $submission->employmentHistory->position }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Years of Experience</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $submission->employmentHistory->years_of_experience }}</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Military History -->
        @if($submission->militaryHistory)
        <div class="bg-white rounded-xl shadow-sm p-6 scale-in">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Military History</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Service Branch</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $submission->militaryHistory->service_branch }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Rank</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $submission->militaryHistory->rank }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Years of Service</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $submission->militaryHistory->years_of_service }}</p>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Action Buttons -->
    <div class="flex justify-end space-x-3">
        <a href="{{ route('admin.phs.index') }}" class="btn-secondary inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D]">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to List
        </a>
        <a href="{{ route('admin.phs.edit', $submission->id) }}" class="btn-primary inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-[#1B365D] hover:bg-[#2B4B7D] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D]">
            <i class="fas fa-edit mr-2"></i>
            Edit Submission
        </a>
    </div>
</div>
@endsection 