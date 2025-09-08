@extends('layouts.app')

@section('title', 'Membros de ' . $organization->name . ' | SGC-Chapecó')

@push('styles')
<style>
    /* ESTILOS ESPECÍFICOS DA PÁGINA DE MEMBROS */
    .page-container { max-width: 1200px; margin: 0 auto; padding: 2.5rem; }
    .page-header { margin-bottom: 2.5rem; padding-bottom: 1.5rem; border-bottom: 1px solid var(--border-color); }
    .page-header h1 { font-size: 2rem; font-weight: 600; }
    .page-header p { font-size: 1rem; color: var(--gray-text-color); }
    .members-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 2rem; }
    .member-card { text-align: center; transition: transform 0.3s ease, box-shadow 0.3s ease; text-decoration: none; color: inherit;}
    .member-card:hover { transform: translateY(-5px); box-shadow: 0 8px 25px rgba(0,0,0,0.1); }
    .member-card .member-avatar { width: 120px; height: 120px; border-radius: 50%; object-fit: cover; margin: 0 auto 1rem auto; border: 4px solid var(--white-color); box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
    .member-card h4 { font-size: 1.2rem; font-weight: 600; margin-bottom: 0.25rem; }
    .member-card p { font-size: 0.9rem; color: var(--gray-text-color); }
    .pagination-container { margin-top: 2.5rem; }
</style>
@endpush

@section('content')
<div class="page-container">
    <div class="page-header">
        <h1>Membros de {{ $organization->name }}</h1>
        <p>Conheça a equipa que impulsiona a inovação.</p>
    </div>

    <div class="members-grid">
        @forelse ($members as $member)
            <a href="{{ route('profile.show', $member) }}" class="member-card card">
                <img src="{{ $member->profile_photo_url }}" alt="Foto de {{ $member->name }}" class="member-avatar">
                <h4>{{ $member->name }}</h4>
                <p>{{ $member->title }}</p>
            </a>
        @empty
            <p>Esta organização ainda não tem membros.</p>
        @endforelse
    </div>

    <div class="pagination-container">
        {{ $members->links() }}
    </div>
</div>
@endsection
