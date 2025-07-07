@php
    // Standardized section configuration
    $sectionName = 'character-reputation';
    $sectionTitle = 'XIII: Character and Reputation';
    $sectionDescription = 'Please provide your character references and neighbor information.';
    $sectionIcon = 'fas fa-user-shield';
    $nextSection = 'miscellaneous';
    
    // Always use the client PHS layout for identical UI
    $layout = 'layouts.phs-new';
@endphp

@extends('phs.sections.template-section-wrapper')

@section('form-content')
    @include('phs.sections.character-reputation-content')
@endsection 