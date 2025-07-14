@php
    // Standardized section configuration
    $sectionName = 'personal-details';
    $sectionTitle = 'I: Personal Details';
    $sectionDescription = 'Please provide your basic personal information';
    $sectionIcon = 'fas fa-user';
    $nextSection = 'personal-characteristics';

    // Always use the client PHS layout for identical UI
    $layout = 'layouts.phs-new';
    
    // Set form action directly to ensure it's correct
    $formAction = route('phs.personal-details.store');
    
    // Debug output
    \Log::info('Personal Details variables:', [
        'sectionName' => $sectionName,
        'sectionTitle' => $sectionTitle,
        'nextSection' => $nextSection,
        'layout' => $layout,
        'formAction' => $formAction
    ]);
@endphp

@extends('phs.sections.template-section-wrapper')

@section('form-content')
    @include('phs.sections.personal-details-content')
@endsection

@push('scripts')
<script>
    window.prefilledHomeRegion = @json($home_region ?? '');
    window.prefilledBusinessRegion = @json($business_region ?? '');
    window.prefilledBirthRegion = @json($birth_region ?? '');
    
    // Ensure proper initialization
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Personal Details DOMContentLoaded triggered');
        
        // Initialize Personal Details section
        if (typeof window.initializePersonalDetails === 'function') {
            console.log('Calling initializePersonalDetails');
            window.initializePersonalDetails();
        }
        
        // Debug form action
        const form = document.getElementById('phs-form');
        if (form) {
            console.log('Form found:', form);
            console.log('Form action:', form.action);
            console.log('Form method:', form.method);
            console.log('Form action type:', typeof form.action);
            console.log('Form action value:', form.action);
            console.log('Form action toString:', form.action.toString());
            
            // Ensure form action is set correctly
            if (!form.action || form.action === '[object HTMLButtonElement]' || form.action.includes('object%20HTMLButtonElement')) {
                console.error('Form action is incorrect, setting it manually');
                const correctAction = '{{ $formAction }}';
                console.log('Setting form action to:', correctAction);
                form.action = correctAction;
                console.log('Form action after setting:', form.action);
            }
            
            // Monitor form action changes
            const originalAction = form.action;
            Object.defineProperty(form, 'action', {
                get: function() {
                    return this._action || originalAction;
                },
                set: function(value) {
                    console.log('Form action being set to:', value);
                    this._action = value;
                }
            });
            
            // Set the correct action as a data attribute for backup
            form.setAttribute('data-action', '{{ $formAction }}');
        } else {
            console.error('Form not found!');
        }
    });
</script>
@endpush
