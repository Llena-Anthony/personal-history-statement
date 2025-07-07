@php
    // Standardized section configuration
    $sectionName = 'marital-status';
    $sectionTitle = 'III: Marital Status';
    $sectionDescription = 'Please provide your marital status information';
    $sectionIcon = 'fas fa-heart';
    $nextSection = 'family-background';
    
    // Always use the client PHS layout for identical UI
    $layout = 'layouts.phs-new';
@endphp

@extends('phs.sections.template-section-wrapper')

@section('form-content')
@include('phs.sections.marital-status-content')
@endsection

{{-- Pass currentSection to layout --}}
@php($currentSection = 'marital-status')
