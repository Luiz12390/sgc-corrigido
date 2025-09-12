@extends('layouts.app')

@section('title', 'Gerir Membros | ' . $community->name)

@section('content')
    <div class="page-container">
        <h1 class="text-3xl font-bold mb-4">
            Gerir Membros e Pedidos para "{{ $community->name }}"
        </h1>

        @livewire('manage-community-members', ['community' => $community])
    </div>
@endsection
