@php
    // Standardized section configuration
    $sectionName = 'foreign-countries';
    $sectionTitle = 'IX: Foreign Countries Visited';
    $sectionDescription = 'Please provide information about foreign countries you have visited';
    $sectionIcon = 'fas fa-plane';
    $nextSection = 'credit-reputation';
    
    // Always use the client PHS layout for identical UI
    $layout = 'layouts.phs-new';
@endphp

@extends('phs.sections.template-section-wrapper')

@section('form-content')
    @include('phs.sections.foreign-countries-content')
@endsection