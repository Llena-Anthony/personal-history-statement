@php
    // Standardized section configuration
    $sectionName = 'arrest-record';
    $sectionTitle = 'XI: Arrest Record and Conduct';
    $sectionDescription = 'Please provide details of any arrest record or conduct issues.';
    $sectionIcon = 'fas fa-gavel';
    $nextSection = 'organization';
    
    // Always use the client PHS layout for identical UI
    $layout = 'layouts.phs-new';
@endphp

@extends('phs.sections.template-section-wrapper')

@section('form-content')
    @include('phs.sections.arrest-record-content')
@endsection 