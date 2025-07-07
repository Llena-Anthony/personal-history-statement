@php
    // Standardized section configuration
    $sectionName = 'military-history';
    $sectionTitle = 'VI: Military History';
    $sectionDescription = 'Please provide your military service information';
    $sectionIcon = 'fas fa-medal';
    $nextSection = 'places-of-residence';
    
    // Always use the client PHS layout for identical UI
    $layout = 'layouts.phs-new';
@endphp

@extends('phs.sections.template-section-wrapper')

@section('form-content')
    @include('phs.sections.military-history-content')
@endsection 