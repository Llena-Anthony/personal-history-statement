@extends('layouts.phs-new')

@section('title', 'VIII: Employment History')

@section('content')
    <form method="POST" action="{{ route('personnel.phs.employment-history.store') }}">
        @include('phs.sections.employment-history-content')
    </form>
@endsection

@php($currentSection = 'employment-history') 