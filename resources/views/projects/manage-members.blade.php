@extends('layouts.app')

@section('title', 'Gerir Membros do Projeto | SGC-Chapecó')

@section('content')
    <div class="page-container">
        <h1 class="text-3xl font-bold mb-4">
            Gerir Membros e Pedidos para "{{ $project->name }}"
        </h1>

        @livewire('manage-project-members', ['project' => $project])
    </div>
@endsection
