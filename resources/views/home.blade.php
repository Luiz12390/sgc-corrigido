@extends('layouts.app')

@section('title', 'Página Principal | SGC-Chapecó')

@push('styles')
<style>
    /* ... (todos os outros estilos da home permanecem iguais) ... */
    .main-container { display: grid; grid-template-columns: 320px 1fr; gap: 2rem; padding: 2rem 2.5rem; max-width: 1600px; margin: 0 auto; }
    .sidebar, .main-content { display: flex; flex-direction: column; gap: 2rem; }
    .recent-activities ul { list-style: none; display: flex; flex-direction: column; gap: 1.5rem; }
    .activity-item { display: flex; align-items: center; gap: 1rem; }
    .activity-item .icon { width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background-color: var(--background-color); }
    .activity-item .icon img { width: 100%; border-radius: 50%; object-fit: cover; }
    .activity-details p { font-size: 0.9rem; line-height: 1.4; }
    .activity-details span { font-size: 0.8rem; color: var(--gray-text-color); }

    /* === INÍCIO DAS CORREÇÕES DE CSS === */
    .suggested-connections ul {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .connection-item {
        display: flex; /* Habilita o Flexbox */
        flex-direction: column; /* Organiza os itens em coluna */
        align-items: center; /* Centraliza horizontalmente */
        text-align: center;
        padding: 1.5rem;
        border: 1px solid var(--border-color);
        border-radius: 10px;
        text-decoration: none;
        color: inherit;
        transition: box-shadow 0.2s ease-in-out;
    }
    .connection-item:hover {
        box-shadow: var(--box-shadow);
    }
    .connection-item .profile-pic {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 1rem;
    }
    .connection-item h4 {
        font-size: 1rem;
        font-weight: 600;
    }
    .connection-item p {
        font-size: 0.85rem;
        color: var(--gray-text-color);
        line-height: 1.4;
    }
    /* === FIM DAS CORREÇÕES DE CSS === */

    .grid-container { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; }
    .content-card { text-decoration: none; color: inherit; border-radius: 10px; overflow: hidden; box-shadow: var(--box-shadow); border: 1px solid var(--border-color); background-color: var(--card-background-color); }
    .content-card .card-image { height: 180px; width: 100%; background-color: #e0e0e0; object-fit: cover; }
    .content-card .card-content { padding: 1rem 1.25rem; }
    .content-card h4 { font-size: 1.1rem; font-weight: 600; margin-bottom: 0.25rem; }
    .content-card p { font-size: 0.9rem; color: var(--gray-text-color); line-height: 1.5; }
</style>
@endpush

@section('content')
<div class="main-container">
    <aside class="sidebar">
        <div class="card recent-activities">
            <h3 class="card-title">Atividades recentes</h3>
            <p class="text-gray-500">Nenhuma atividade recente para exibir.</p>
        </div>

        <div class="card suggested-connections">
            <h3 class="card-title">Conexões Sugeridas</h3>
            {{-- AQUI ESTÁ O HTML CORRIGIDO --}}
            <ul>
                @forelse($suggestedUsers as $user)
                    <li>
                        <a href="{{ route('profile.show', $user) }}" class="connection-item">
                            {{-- Usando o Accessor correto para a imagem --}}
                            <img src="{{ $user->profile_photo_url }}" alt="Foto de {{ $user->name }}" class="profile-pic">
                            <h4>{{ $user->name }}</h4>
                            <p>{{ $user->title }}</p>
                        </a>
                    </li>
                @empty
                    <p class="text-gray-500">Nenhuma sugestão no momento.</p>
                @endforelse
            </ul>
        </div>
    </aside>

    <main class="main-content">
        <section class="content-section">
            <h2 class="content-section-title">Desafios em Destaque</h2>
            <div class="grid-container">
                @forelse ($featuredChallenges as $challenge)
                <a href="{{ route('challenges.show', $challenge) }}" class="content-card">
                    <img src="{{ $challenge->cover_image_url }}" alt="Imagem do Desafio" class="card-image">
                    <div class="card-content">
                        <h4>{{ $challenge->title }}</h4>
                        <p>{{ Str::limit($challenge->description, 80) }}</p>
                    </div>
                </a>
                @empty
                <p class="text-gray-500">Nenhum desafio em destaque.</p>
                @endforelse
            </div>
        </section>

        <section class="content-section">
            <h2 class="content-section-title">Projetos em Andamento</h2>
            <div class="grid-container">
                @forelse ($ongoingProjects as $project)
                <a href="{{ route('projects.show', $project) }}" class="content-card">
                    <img src="{{ $project->cover_image_url }}" alt="Imagem do Projeto" class="card-image">
                    <div class="card-content">
                        <h4>{{ $project->title }}</h4>
                        <p>{{ Str::limit($project->description, 80) }}</p>
                    </div>
                </a>
                @empty
                <p class="text-gray-500">Nenhum projeto em andamento.</p>
                @endforelse
            </div>
        </section>

        <section class="content-section">
            <h2 class="content-section-title">Próximos Eventos</h2>
            <div class="grid-container">
                @forelse ($upcomingEvents as $event)
                <a href="#" class="content-card">
                    <img src="{{ $event->cover_image_url }}" alt="Imagem do Evento" class="card-image">
                    <div class="card-content">
                        <h4>{{ $event->title }}</h4>
                        <p>{{ $event->start_date->format('d/m/Y') }} - {{ Str::limit($event->description, 50) }}</p>
                    </div>
                </a>
                @empty
                <p class="text-gray-500">Nenhum evento agendado.</p>
                @endforelse
            </div>
        </section>

        <section class="content-section">
            <h2 class="content-section-title">Conteúdo Recomendado</h2>
            <div class="grid-container">
                @forelse ($recommendedResources as $resource)
                <a href="{{ route('recursos.show', $resource) }}" class="content-card">
                    <img src="{{ $resource->cover_image_url }}" alt="Imagem do Recurso" class="card-image">
                    <div class="card-content">
                        <h4>{{ $resource->title }}</h4>
                        <p>{{ Str::limit($resource->description, 80) }}</p>
                    </div>
                </a>
                @empty
                <p class="text-gray-500">Nenhum recurso recomendado.</p>
                @endforelse
            </div>
        </section>
    </main>
</div>
@endsection
