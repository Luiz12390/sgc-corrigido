@extends('layouts.app')

@section('title', 'Comunidades | SGC-Chapecó')

@section('content')
    <div class="page-subheader">
        <div class="subheader-content">
            <nav class="breadcrumbs">
                <a href="{{ route('home') }}">Home</a> / <span>Comunidades</span>
            </nav>
            <div class="page-actions">
                @auth
                    <a href="{{ route('communities.create') }}" class="btn btn-primary">Criar Comunidade</a>
                @endauth
            </div>
        </div>
    </div>

    @livewire('communities-index')
@endsection
