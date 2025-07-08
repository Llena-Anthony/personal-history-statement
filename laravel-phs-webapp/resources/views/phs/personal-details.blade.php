@php
    // Standardized section configuration
    $sectionName = 'personal-details';
    $sectionTitle = 'I: Personal Details';
    $sectionDescription = 'Please provide your basic personal information';
    $sectionIcon = 'fas fa-user';
    $nextSection = 'personal-characteristics';

    // Always use the client PHS layout for identical UI
    $layout = 'layouts.phs-new';
@endphp

@extends('phs.sections.template-section-wrapper')

@section('form-content')
    @include('phs.sections.personal-details-content')
@endsection

{{-- Inline script to pass prefilled region values to JS --}}
<script>
    window.prefilledHomeRegion = @json($home_region ?? '');
    window.prefilledBusinessRegion = @json($business_region ?? '');
    window.prefilledBirthRegion = @json($birth_region ?? '');
</script>
