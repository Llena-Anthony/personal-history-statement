@php
    // Standardized section configuration
    $sectionName = 'employment-history';
    $sectionTitle = 'VIII: Employment History';
    $sectionDescription = 'Please provide your employment history';
    $sectionIcon = 'fas fa-briefcase';
    $nextSection = 'foreign-countries';
    
    // Always use the client PHS layout for identical UI
    $layout = 'layouts.phs-new';
@endphp

@extends('phs.sections.template-section-wrapper')

@section('form-content')
        @include('phs.sections.employment-history-content')
@endsection