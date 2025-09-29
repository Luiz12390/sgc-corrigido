@extends('layouts.app')
@section('title', $community->name . ' | SGC-Chapecó')
@section('content')
    @livewire('community-profile', ['community' => $community])
@endsection
