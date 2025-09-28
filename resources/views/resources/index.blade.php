@extends('layouts.app')
@section('title', 'Recursos | SGC-Chapecó')
@section('content')
    <div class="page-subheader">
        <div class="subheader-content">
            <nav class="breadcrumbs">
                <a href="{{ route('home') }}">Home</a> / <span>Recursos</span>
            </nav>
            <div class="page-actions">
                @auth
                    <a href="{{ route('recursos.create') }}" class="btn btn-primary">Adicionar Recurso</a>
                @endauth
            </div>
        </div>
    </div>
    @livewire('resources-index')
@endsection
