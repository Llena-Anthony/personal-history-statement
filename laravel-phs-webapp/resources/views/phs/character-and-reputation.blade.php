@php
    // Standardized section configuration
    $sectionName = 'character-and-reputation';
    $sectionTitle = 'XIII: Character and Reputation';
    $sectionDescription = 'Please provide your character references and neighbor information.';
    $sectionIcon = 'fas fa-user-shield';
    $nextSection = 'miscellaneous';
    
    // Always use the client PHS layout for identical UI
    $layout = 'layouts.phs-new';
@endphp

@extends('phs.sections.template-section-wrapper')

@section('form-content')
    <!-- Character References -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
        <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
            <i class="fas fa-user-friends mr-3 text-[#D4AF37]"></i>
            Character References
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @php
                $oldCharacterReferences = old('character_references', $character_references->toArray() ?? []);
            @endphp
            @for ($i = 0; $i < 5; $i++)
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Name</label>
                    <input type="text" name="character_references[{{ $i }}][name]" value="{{ $oldCharacterReferences[$i]['name'] ?? '' }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg" placeholder="Enter name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Address</label>
                    <input type="text" name="character_references[{{ $i }}][address]" value="{{ $oldCharacterReferences[$i]['address'] ?? '' }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg" placeholder="Enter address">
                </div>
            @endfor
        </div>
    </div>
    <!-- Neighbors -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
            <i class="fas fa-users mr-3 text-[#D4AF37]"> </i>
            Neighbors
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @php
                $oldNeighbors = old('neighbors', $neighbors->toArray() ?? []);
            @endphp
            @for ($i = 0; $i < 3; $i++)
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Name</label>
                    <input type="text" name="neighbors[{{ $i }}][name]" value="{{ $oldNeighbors[$i]['name'] ?? '' }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg" placeholder="Enter name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Address</label>
                    <input type="text" name="neighbors[{{ $i }}][address]" value="{{ $oldNeighbors[$i]['address'] ?? '' }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg" placeholder="Enter address">
                </div>
            @endfor
        </div>
    </div>
@endsection 