@extends('layouts.phs-new')

@section('title', 'Review and Save Changes')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <div class="w-12 h-12 bg-[#1B365D] rounded-full flex items-center justify-center">
                <i class="fas fa-check-circle text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-[#1B365D]">Review and Save Changes</h1>
                <p class="text-gray-600">Please review your Personal History Statement before final submission</p>
            </div>
        </div>
    </div>

    <!-- Unfilled Fields Warning -->
    @if(!empty($unfilledFields))
    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-8">
        <div class="flex items-center mb-4">
            <i class="fas fa-exclamation-triangle text-yellow-600 mr-3"></i>
            <h3 class="text-lg font-semibold text-yellow-800">Unfilled Fields Detected</h3>
        </div>
        <p class="text-yellow-700 mb-4">The following sections have incomplete information. Unfilled fields will be set to "NA" upon submission.</p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($unfilledFields as $section => $fields)
            <div class="bg-white rounded-lg p-4 border border-yellow-200">
                <h4 class="font-semibold text-yellow-800 mb-2">{{ ucwords(str_replace('_', ' ', $section)) }}</h4>
                <ul class="text-sm text-yellow-700">
                    @foreach($fields as $field)
                    <li class="flex items-center mb-1">
                        <i class="fas fa-times-circle text-red-500 mr-2"></i>
                        {{ $field }}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Review Sections -->
    <div class="space-y-8">
        <!-- Personal Details -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-user mr-3 text-[#D4AF37]"></i>
                Personal Details
            </h3>
            
            @if($phs && $phs->name)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <p class="text-gray-900 font-medium">{{ $phs->name->full_name }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                    <p class="text-gray-900">{{ ($phs && $phs->date_of_birth) ? $phs->date_of_birth->format('F j, Y') : 'Not provided' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Place of Birth</label>
                    <p class="text-gray-900">{{ $phs->place_of_birth ?? 'Not provided' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Rank</label>
                    <p class="text-gray-900">{{ $phs->rank ?? 'Not provided' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">AFPSN</label>
                    <p class="text-gray-900">{{ $phs->afpsn ?? 'Not provided' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Branch of Service</label>
                    <p class="text-gray-900">{{ $phs->branch_of_service ?? 'Not provided' }}</p>
                </div>
            </div>
            @else
            <div class="text-center py-8">
                <i class="fas fa-exclamation-circle text-gray-400 text-4xl mb-4"></i>
                <p class="text-gray-500">Personal details not provided</p>
            </div>
            @endif
        </div>

        <!-- Family Background -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-users mr-3 text-[#D4AF37]"></i>
                Family Background
            </h3>
            
            @if($familyBackground)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Father's Name</label>
                    <p class="text-gray-900">{{ $familyBackground->father_name_id ? 'Provided' : 'Not provided' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Mother's Name</label>
                    <p class="text-gray-900">{{ $familyBackground->mother_name_id ? 'Provided' : 'Not provided' }}</p>
                </div>
            </div>
            @else
            <div class="text-center py-8">
                <i class="fas fa-exclamation-circle text-gray-400 text-4xl mb-4"></i>
                <p class="text-gray-500">Family background not provided</p>
            </div>
            @endif
        </div>

        <!-- Educational Background -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-graduation-cap mr-3 text-[#D4AF37]"></i>
                Educational Background
            </h3>
            
            @if($educationalBackground)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Elementary</label>
                    <p class="text-gray-900">{{ $educationalBackground->elementary_school ?? 'Not provided' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">High School</label>
                    <p class="text-gray-900">{{ $educationalBackground->high_school ?? 'Not provided' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">College</label>
                    <p class="text-gray-900">{{ $educationalBackground->college ?? 'Not provided' }}</p>
                </div>
            </div>
            @else
            <div class="text-center py-8">
                <i class="fas fa-exclamation-circle text-gray-400 text-4xl mb-4"></i>
                <p class="text-gray-500">Educational background not provided</p>
            </div>
            @endif
        </div>

        <!-- Marital Status -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-heart mr-3 text-[#D4AF37]"></i>
                Marital Status
            </h3>
            
            @if($maritalStatus)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Civil Status</label>
                    <p class="text-gray-900">{{ $maritalStatus->civil_status ?? 'Not provided' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Spouse Name</label>
                    <p class="text-gray-900">{{ $maritalStatus->spouse_name_id ? 'Provided' : 'Not provided' }}</p>
                </div>
            </div>
            @else
            <div class="text-center py-8">
                <i class="fas fa-exclamation-circle text-gray-400 text-4xl mb-4"></i>
                <p class="text-gray-500">Marital status not provided</p>
            </div>
            @endif
        </div>

        <!-- Military History -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-medal mr-3 text-[#D4AF37]"></i>
                Military History
            </h3>
            
            @if($militaryHistory)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Service Information</label>
                    <p class="text-gray-900">{{ $militaryHistory->service_info ?? 'Not provided' }}</p>
                </div>
            </div>
            @else
            <div class="text-center py-8">
                <i class="fas fa-exclamation-circle text-gray-400 text-4xl mb-4"></i>
                <p class="text-gray-500">Military history not provided</p>
            </div>
            @endif
        </div>

        <!-- Employment History -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-briefcase mr-3 text-[#D4AF37]"></i>
                Employment History
            </h3>
            
            @if($employmentHistory)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Employment Information</label>
                    <p class="text-gray-900">{{ $employmentHistory->employment_info ?? 'Not provided' }}</p>
                </div>
            </div>
            @else
            <div class="text-center py-8">
                <i class="fas fa-exclamation-circle text-gray-400 text-4xl mb-4"></i>
                <p class="text-gray-500">Employment history not provided</p>
            </div>
            @endif
        </div>

        <!-- Personal Characteristics -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-user-tie mr-3 text-[#D4AF37]"></i>
                Personal Characteristics
            </h3>
            
            @if($personalCharacteristic)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Height</label>
                    <p class="text-gray-900">{{ $personalCharacteristic->height ?? 'Not provided' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Weight</label>
                    <p class="text-gray-900">{{ $personalCharacteristic->weight ?? 'Not provided' }}</p>
                </div>
            </div>
            @else
            <div class="text-center py-8">
                <i class="fas fa-exclamation-circle text-gray-400 text-4xl mb-4"></i>
                <p class="text-gray-500">Personal characteristics not provided</p>
            </div>
            @endif
        </div>

        <!-- Credit Reputation -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-credit-card mr-3 text-[#D4AF37]"></i>
                Credit Reputation
            </h3>
            
            @if($creditReputation)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Credit Information</label>
                    <p class="text-gray-900">{{ $creditReputation->credit_info ?? 'Not provided' }}</p>
                </div>
            </div>
            @else
            <div class="text-center py-8">
                <i class="fas fa-exclamation-circle text-gray-400 text-4xl mb-4"></i>
                <p class="text-gray-500">Credit reputation not provided</p>
            </div>
            @endif
        </div>

        <!-- Arrest Record -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-gavel mr-3 text-[#D4AF37]"></i>
                Arrest Record
            </h3>
            
            @if($arrestRecord)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Arrest Information</label>
                    <p class="text-gray-900">{{ $arrestRecord->arrest_info ?? 'Not provided' }}</p>
                </div>
            </div>
            @else
            <div class="text-center py-8">
                <i class="fas fa-exclamation-circle text-gray-400 text-4xl mb-4"></i>
                <p class="text-gray-500">Arrest record not provided</p>
            </div>
            @endif
        </div>

        <!-- Character Reference -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-user-friends mr-3 text-[#D4AF37]"></i>
                Character Reference
            </h3>
            
            @if($characterReference)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Reference Name</label>
                    <p class="text-gray-900">{{ $characterReference->ref_name_id ? 'Provided' : 'Not provided' }}</p>
                </div>
            </div>
            @else
            <div class="text-center py-8">
                <i class="fas fa-exclamation-circle text-gray-400 text-4xl mb-4"></i>
                <p class="text-gray-500">Character reference not provided</p>
            </div>
            @endif
        </div>

        <!-- Miscellaneous -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-ellipsis-h mr-3 text-[#D4AF37]"></i>
                Miscellaneous
            </h3>
            
            @if($miscellaneous)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Additional Information</label>
                    <p class="text-gray-900">{{ $miscellaneous->additional_info ?? 'Not provided' }}</p>
                </div>
            </div>
            @else
            <div class="text-center py-8">
                <i class="fas fa-exclamation-circle text-gray-400 text-4xl mb-4"></i>
                <p class="text-gray-500">Miscellaneous information not provided</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="mt-12 flex justify-between items-center">
        <a href="{{ route('phs.miscellaneous') }}" 
           class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D] transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Edit
        </a>
        
        <form method="POST" action="{{ route('phs.review.finalize') }}" class="inline">
            @csrf
            <button type="submit" 
                    class="inline-flex items-center px-8 py-3 bg-[#1B365D] text-white rounded-lg hover:bg-[#152a4a] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D] transition-colors">
                <i class="fas fa-check mr-2"></i>
                Submit PHS
            </button>
        </form>
    </div>
</div>
@endsection 