@extends('phs.sections.template-section-wrapper')

@php
    $sectionName = 'organization';
    $nextSection = 'miscellaneous';
    $sectionTitle = 'XIII: Organization';
    $sectionDescription = 'List all organizations you are or have been a member of.';
    $sectionIcon = 'fas fa-users-cog';
@endphp

@section('form-content')
    @include('phs.sections.organization-content')
@endsection 