@extends('layouts.app')

@section('title', 'Gerir Membros | ' . $organization->name)

@section('content')
    <div class="page-container">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">
            Gerir Membros e Pedidos para "{{ $organization->name }}"
        </h1>

        @livewire('manage-join-requests', ['organization' => $organization])
    </div>
@endsection
