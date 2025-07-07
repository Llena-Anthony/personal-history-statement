@php
    // Standardized section configuration
    $sectionName = 'places-of-residence';
    $sectionTitle = 'VII: Places of Residence Since Birth';
    $sectionDescription = 'Please provide your residence history';
    $sectionIcon = 'fas fa-home';
    $nextSection = 'employment-history';
    
    // Always use the client PHS layout for identical UI
    $layout = 'layouts.phs-new';
@endphp

@extends('phs.sections.template-section-wrapper')

@section('form-content')
@include('phs.sections.places-of-residence-content')
@endsection 