@php
    // Standardized section configuration
    $sectionName = 'miscellaneous';
    $sectionTitle = 'XIV: Miscellaneous';
    $sectionDescription = 'Please provide additional information about hobbies, languages, and other details.';
    $sectionIcon = 'fas fa-puzzle-piece';
    $nextSection = 'review';
    
    // Always use the client PHS layout for identical UI
    $layout = 'layouts.phs-new';
@endphp

@extends('phs.sections.template-section-wrapper')

@section('form-content')
    @include('phs.sections.miscellaneous-content')
@endsection