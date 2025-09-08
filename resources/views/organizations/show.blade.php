@extends('layouts.app')

@section('title', $organization->name . ' | SGC-Chapecó')

@push('styles')
<style>
    /* ESTILOS ESPECÍFICOS DA PÁGINA DE PERFIL DA ORGANIZAÇÃO */
    .profile-banner { height: 200px; background-image: url('https://images.unsplash.com/photo-1522071820081-009f0129c7da?w=1200'); background-size: cover; background-position: center; }
    .profile-page-container { max-width: 1100px; margin: 0 auto; padding: 0 2.5rem 2.5rem 2.5rem; }
    .profile-header { display: flex; align-items: center; gap: 2rem; margin-top: -80px; position: relative; margin-bottom: 2.5rem; }
    .profile-header-avatar { width: 160px; height: 160px; border-radius: 50%; object-fit: cover; border: 5px solid var(--card-background-color); background-color: var(--card-background-color); box-shadow: 0 4px 12px rgba(0,0,0,0.1); flex-shrink: 0; }
    .profile-header-info { flex-grow: 1; padding-top: 80px; }
    .profile-header-info h1 { font-size: 1.75rem; font-weight: 600; }
    .profile-header-info p { font-size: 1rem; color: var(--gray-text-color); line-height: 1.5; }
    .profile-header-actions { display: flex; gap: 1rem; margin-left: auto; padding-top: 80px; align-items: center; }
    .btn { padding: 0.7rem 1.5rem; border-radius: 8px; font-weight: 600; font-size: 0.9rem; cursor: pointer; transition: all 0.3s ease; border: 1px solid var(--primary-color); }
    .btn-secondary { background-color: var(--card-background-color); color: var(--primary-color); }
    .btn-primary { background-color: var(--primary-color); color: var(--white-color); }
    .profile-content { display: flex; flex-direction: column; gap: 2.5rem; }
    .section-title { font-size: 1.5rem; font-weight: 600; margin-bottom: 1.5rem; }
    .section-header { display: flex; justify-content: space-between; align-items: center; }
    .view-all-link { font-weight: 500; color: var(--primary-color); font-size: 0.9rem; }
    .about-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; }
    .about-item h4 { font-size: 0.9rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: #555; margin-bottom: 0.5rem; }
    .about-item p { font-size: 1rem; color: var(--gray-text-color); line-height: 1.6; }
    .members-list { display: flex; gap: -15px; /* Efeito de sobreposição */ }
    .member-avatar { width: 48px; height: 48px; border-radius: 50%; object-fit: cover; border: 3px solid var(--card-background-color); box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    .owner-link { display: inline-flex; align-items: center; gap: 0.75rem; text-decoration: none; transition: opacity 0.3s ease; }
    .owner-link:hover { opacity: 0.8; }
    .owner-avatar { width: 32px; height: 32px; border-radius: 50%; object-fit: cover; }
    .owner-link span { font-size: 1rem; font-weight: 500; color: var(--primary-color); }
    .content-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; }
    .content-grid-card { border-radius: 10px; overflow: hidden; box-shadow: var(--box-shadow); border: 1px solid var(--border-color); background-color: var(--card-background-color); transition: transform 0.3s ease, box-shadow 0.3s ease; text-decoration: none; color: inherit; display: flex; flex-direction: column;}
    .content-grid-card:hover { transform: translateY(-5px); box-shadow: 0 8px 25px rgba(0,0,0,0.1); }
    .content-grid-card img { height: 160px; width: 100%; object-fit: cover; }
    .card-content { padding: 1.25rem; flex-grow: 1; display: flex; flex-direction: column;}
    .card-content h4 { font-size: 1.1rem; font-weight: 600; margin-bottom: 0.5rem; }
    .card-content p { font-size: 0.9rem; color: var(--gray-text-color); line-height: 1.5; flex-grow: 1;}
</style>
@endpush

@section('content')
    <div class="profile-banner"></div>
    <div class="profile-page-container">
        <div class="profile-header">
            {{-- Utilizando o Accessor que já criamos para a Logo, com Fallback --}}
            <img src="{{ $organization->logo_url }}" alt="Logo de {{ $organization->name }}" class="profile-header-avatar">

            <div class="profile-header-info">
                <h1>{{ $organization->name }}</h1>
                <p>{{ $organization->type ?? 'Organização' }}<br>Chapecó, Brazil</p>
            </div>
            <div class="profile-header-actions">
                @auth
                    @can('update', $organization)
                        <a href="{{ route('organizations.edit', $organization) }}" class="btn btn-primary">Editar Organização</a>
                        <a href="{{ route('organizations.manageMembers', $organization) }}" class="btn btn-secondary">Gerir Pedidos</a>
                    @else
                        <button class="btn btn-secondary">Seguir</button>
                        <button class="btn btn-primary">Mensagem</button>

                        <livewire:request-to-join-organization-button :organization="$organization" />
                    @endcan
                @else
                    <button class="btn btn-secondary">Seguir</button>
                    <a href="{{ route('login') }}" class="btn btn-primary" wire:navigate>Entrar para Interagir</a>
                @endguest
            </div>
        </div>

        <main class="profile-content">
            <section class="profile-section card">
                <h2 class="section-title">Sobre</h2>
                <div class="about-grid">
                    @if ($organization->type)
                        <div class="about-item"><h4>Tipo</h4><p>{{ $organization->type }}</p></div>
                    @endif
                    @if ($organization->specialization_areas)
                        <div class="about-item"><h4>Áreas de Especialização</h4><p>{{ $organization->specialization_areas }}</p></div>
                    @endif
                    @if ($organization->competencies)
                        <div class="about-item"><h4>Competências</h4><p>{{ $organization->competencies }}</p></div>
                    @endif
                    @if ($organization->available_resources)
                        <div class="about-item"><h4>Recursos Disponíveis</h4><p>{{ $organization->available_resources }}</p></div>
                    @endif
                    @if ($organization->owner)
                        <div class="about-item">
                            <h4>Proprietário</h4>
                            <a href="{{ route('profile.show', $organization->owner) }}" class="owner-link">
                                {{-- Usando o Accessor do Utilizador para a foto --}}
                                <img src="{{ $organization->owner->profile_photo_url }}" alt="Foto de {{ $organization->owner->name }}" class="owner-avatar">
                                <span>{{ $organization->owner->name }}</span>
                            </a>
                        </div>
                    @endif
                </div>
            </section>

            @if ($organization->members->isNotEmpty())
            <section class="profile-section card">
                <div class="section-header">
                    <h2 class="section-title">Membros ({{ $organization->members->count() }})</h2>
                    <a href="{{ route('organizations.members', $organization) }}" class="view-all-link">Ver todos &rarr;</a>
                </div>
                <div class="members-list">
                    @foreach($organization->members->take(10) as $member)
                        <a href="{{ route('profile.show', $member) }}" title="{{ $member->name }}">
                            {{-- Usando o Accessor do Utilizador para a foto --}}
                            <img src="{{ $member->profile_photo_url }}" alt="Foto de {{ $member->name }}" class="member-avatar">
                        </a>
                    @endforeach
                </div>
            </section>
            @endif

            {{-- Secções Dinâmicas de Conteúdo --}}
            @if ($organization->projects->isNotEmpty())
                <section class="profile-section card">
                    <h2 class="section-title">Projetos</h2>
                    <div class="content-grid">
                        @foreach ($organization->projects->take(3) as $project)
                            <a href="{{ route('projects.show', $project) }}" class="content-grid-card">
                                <img src="{{ $project->cover_image_url }}" alt="Capa do projeto {{ $project->title }}">
                                <div class="card-content">
                                    <h4>{{ $project->title }}</h4>
                                    <p>{{ Str::limit($project->description, 100) }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif

            {{-- Adicione secções para Desafios e Eventos aqui, seguindo o mesmo padrão dos Projetos --}}

        </main>
    </div>
@endsection
