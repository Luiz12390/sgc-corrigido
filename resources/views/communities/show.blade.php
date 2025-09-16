@extends('layouts.app')

@section('title', $community->name . ' | SGC-Chapecó')

@push('styles')
<style>
    /* Estilos adaptados da página de perfil da Organização */
    .community-banner { height: 200px; background-image: url('https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=1200'); background-size: cover; background-position: center; }
    .community-page-container { max-width: 1100px; margin: 0 auto; padding: 0 2.5rem 2.5rem 2.5rem; }
    .community-header { display: flex; align-items: center; gap: 2rem; margin-top: -80px; position: relative; margin-bottom: 2.5rem; background-color: var(--card-background-color); padding: 2rem; border-radius: 12px; border: 1px solid var(--border-color); }
    .community-header-avatar { width: 160px; height: 160px; border-radius: 50%; object-fit: cover; border: 5px solid var(--card-background-color); background-color: var(--card-background-color); box-shadow: 0 4px 12px rgba(0,0,0,0.1); flex-shrink: 0; }
    .community-header-info { flex-grow: 1; padding-top: 80px; }
    .community-header-info h1 { font-size: 1.75rem; font-weight: 600; }
    .community-header-info p { font-size: 1rem; color: var(--gray-text-color); line-height: 1.5; }
    .community-header-actions { display: flex; gap: 1rem; margin-left: auto; padding-top: 80px; align-items: center; }
    .community-content { display: grid; grid-template-columns: 1fr 320px; gap: 2.5rem; align-items: start; }
    .feed-column { display: flex; flex-direction: column; gap: 1.5rem; }
    .sidebar-column { display: flex; flex-direction: column; gap: 1.5rem; }
    .section-title { font-size: 1.25rem; font-weight: 600; margin-bottom: 1rem; }
    .members-list { display: flex; gap: -15px; }
    .member-avatar { width: 48px; height: 48px; border-radius: 50%; object-fit: cover; border: 3px solid var(--card-background-color); }
</style>
@endpush

@section('content')
    <div class="community-banner"></div>
    <div class="community-page-container">
        <header class="community-header">
            <img src="{{ $community->logo_url }}" alt="Logo de {{ $community->name }}" class="community-header-avatar">
            <div class="community-header-info">
                <h1>{{ $community->name }}</h1>
                <p>{{ $community->description }}</p>
            </div>
            <div class="community-header-actions">
                @can('update', $community)
                    <a href="{{ route('communities.manageMembers', $community) }}" class="btn btn-secondary">Gerir Membros</a>
                @else
                    <livewire:request-to-join-community-button :community="$community" />
                @endcan
            </div>
        </header>

        <div class="community-content">
            {{-- Coluna Principal: Feed de Posts --}}
            <main class="feed-column">
                {{-- Formulário para criar post (só para membros) --}}
                @if(auth()->check() && auth()->user()->communities->contains($community))
                    @livewire('create-post', ['community' => $community])
                @endif

                {{-- O Feed de Posts --}}
                @livewire('post-feed', ['community' => $community])
            </main>

            {{-- Coluna Lateral: Sobre e Membros --}}
            <aside class="sidebar-column">
                <div class="card">
                    <h3 class="section-title">Sobre esta Comunidade</h3>
                    <p class="text-sm text-gray-600">Criada em {{ $community->created_at->format('d/m/Y') }}</p>
                    @if ($community->user)
                        <p class="text-sm text-gray-600">
                            Por <a href="{{ route('profile.show', $community->user) }}" class="font-semibold text-primary-500 hover:underline">{{ $community->user->name }}</a>
                        </p>
                    @endif
                </div>

                <div class="card">
                    <h3 class="section-title">Membros ({{ $community->members->count() }})</h3>
                    @if ($community->members->isNotEmpty())
                        <div class="members-list">
                            @foreach($community->members->take(8) as $member)
                                <a href="{{ route('profile.show', $member) }}" title="{{ $member->name }}">
                                    <img src="{{ $member->profile_photo_url }}" alt="Foto de {{ $member->name }}" class="member-avatar">
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-sm">Ainda não há membros.</p>
                    @endif
                </div>
            </aside>
        </div>
    </div>
@endsection
