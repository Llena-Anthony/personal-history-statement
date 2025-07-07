@php
    // Standardized section configuration
    $sectionName = 'organization';
    $sectionTitle = 'XII: Organization';
    $sectionDescription = 'List all organizations you are or have been a member of.';
    $sectionIcon = 'fas fa-users';
    $nextSection = 'character-reputation';
    
    // Always use the client PHS layout for identical UI
    $layout = 'layouts.phs-new';
@endphp

@extends('phs.sections.template-section-wrapper')

@section('form-content')
    @include('phs.sections.organization-content')
@endsection 