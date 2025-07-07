@php
    // Standardized section configuration
    $sectionName = 'family-background';
    $sectionTitle = request()->routeIs('phs.family-history.create') ? 'IV: Family History' : 'IV: Family Background';
    $sectionDescription = 'Please provide information about your family members';
    $sectionIcon = 'fas fa-users';
    $nextSection = 'educational-background';
    
    // Always use the client PHS layout for identical UI
    $layout = 'layouts.phs-new';
@endphp

@extends('phs.sections.template-section-wrapper')

@section('form-content')
    @include('phs.sections.family-background-content')
@endsection

{{-- Pass currentSection to layout --}}
@php($currentSection = 'family-background') 