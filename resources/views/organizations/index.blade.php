@extends('layouts.app')

@section('title', 'Organizações | SGC-Chapecó')

@section('content')
<div class="page-subheader">
        <div class="subheader-content">
            <nav class="breadcrumbs">
                <a href="{{ route('home') }}">Home</a> / <span>Organizações</span>
            </nav>
            <div class="page-actions">
                @auth
                    <a href="{{ route('organizations.create') }}" class="btn btn-primary">Criar Organização</a>
                @endauth
            </div>
        </div>
    </div>
    @livewire('organizations-index')
@endsection
