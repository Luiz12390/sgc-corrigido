@extends('layouts.app')

@section('title', 'Gerir Membros | ' . $organization->name)

@section('content')
    <div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">
            Gerir Membros e Pedidos para "{{ $organization->name }}"
        </h1>

        @livewire('manage-join-requests', ['organization' => $organization])
    </div>
@endsection
