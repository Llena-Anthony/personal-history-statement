@extends('layouts.phs-new')

@section('title', 'V: Educational Background')

@section('content')
    @include('phs.sections.educational-background-content')
@endsection

@php($currentSection = 'educational-background')

<form method="POST" action="{{ route('personnel.phs.educational-background.store') }}">
