@extends('layouts.phs-new')

@section('title', request()->routeIs('phs.family-history.create') ? 'IV: Family History' : 'IV: Family Background')

@section('content')
    @include('phs.sections.family-background-content')
@endsection

@php($currentSection = 'family-background') 