@extends('layouts.app')

@section('title', $user->name . ' | SGC-Chapecó')

@push('styles')
<style>
    .profile-banner { height: 200px; background-image: url('{{ asset('/images/profile_banner.png') }}'); background-size: cover; background-position: center; }
    .profile-page-container { max-width: 1100px; margin: 0 auto; padding: 2.5rem; position: relative; }
    .profile-header { display: flex; align-items: center; gap: 2rem; margin-bottom: 2.5rem; background-color: var(--card-background-color); padding: 2rem; border-radius: 12px; border: 1px solid var(--border-color); box-shadow: var(--box-shadow); margin-top: -80px; position: relative; }
    .profile-header-avatar { width: 120px; height: 120px; border-radius: 50%; object-fit: cover; border: 4px solid var(--white-color); box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
    .profile-header-info { flex-grow: 1; }
    .profile-header-info h1 { font-size: 1.75rem; font-weight: 600; }
    .profile-header-info p { font-size: 1rem; color: var(--gray-text-color); line-height: 1.5; }
    .profile-header-actions { display: flex; gap: 1rem; }
    .profile-bio { margin-bottom: 1.5rem; line-height: 1.6; }
    .profile-content { display: flex; flex-direction: column; gap: 2.5rem; }
    .profile-section { padding: 2rem; }

    .btn { padding: 0.7rem 1.5rem; border-radius: 8px; font-weight: 600; font-size: 0.9rem; cursor: pointer; transition: all 0.3s ease; border: 1px solid transparent; }
    .btn-secondary { background-color: var(--card-background-color); color: var(--primary-color); border-color: var(--border-color); }
    .btn-primary { background-color: var(--primary-color); color: var(--white-color); }

    .section-title { font-size: 1.5rem; font-weight: 600; margin-bottom: 1.5rem; }

    .about-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; }
    .about-item h4 { font-size: 0.9rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: #555; margin-bottom: 0.5rem; }
    .about-item p { font-size: 1rem; color: var(--gray-text-color); line-height: 1.6; }

    .organization-card { display: flex; align-items: center; gap: 1.5rem; background-color: var(--background-color); padding: 1.5rem; border-radius: 12px; border: 1px solid var(--border-color); box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
    .organization-logo { width: 120px; height: 80px; flex-shrink: 0; }
    .organization-logo img, .organization-logo-placeholder { width: 100%; height: 100%; object-fit: contain; border-radius: 8px; }
    .organization-info { flex-grow: 1; }
    .organization-info h4 { font-size: 1.2rem; font-weight: 600; margin-bottom: 0.25rem; }
    .organization-info p { margin-bottom: 1rem; font-size: 1rem; color: var(--gray-text-color); }
    .organization-info a { font-weight: 500; color: var(--primary-color); text-decoration: none; }
    .organization-info a:hover { text-decoration: underline; }

    .activity-list { list-style: none; display: flex; flex-direction: column; gap: 1.5rem; }
    .activity-list-item { display: flex; gap: 1.5rem; align-items: center; }
    .activity-icon { flex-shrink: 0; width: 40px; height: 40px; border-radius: 8px; display: flex; align-items: center; justify-content: center; background-color: var(--background-color); }
    .activity-icon svg { width: 20px; height: 20px; stroke: var(--primary-color); }
    .activity-text p { font-size: 1rem; line-height: 1.5; }
    .activity-text span { font-size: 0.85rem; color: #999; }
</style>
@endpush

@section('content')
    <div class="profile-banner"></div>
    <div class="profile-page-container">

        <header class="profile-header card">
            <img src="{{ $user->profile_photo_url }}" alt="Foto de {{ $user->name }}" class="profile-header-avatar">
            <div class="profile-header-info">
                <h1>{{ $user->name }}</h1>
                <p>{{ $user->title }}</p>
            </div>
            <div class="profile-header-actions">
                @auth
                    @if (auth()->user()->id == $user->id)
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary">Editar Perfil</a>
                    @else
                        <button class="btn btn-secondary">Seguir</button>
                    @endif
                @endauth
            </div>
        </header>

        <main class="profile-content">
            <section class="profile-section card">
                <h2 class="section-title">Sobre</h2>
                @if ($user->bio)
                    <p class="profile-bio">{{ $user->bio }}</p>
                @endif
                <div class="about-grid">
                    @if ($user->competencies)
                        <div class="about-item">
                            <h4>COMPETÊNCIAS</h4>
                            <p>{{ $user->competencies }}</p>
                        </div>
                    @endif
                    @if ($user->interests)
                        <div class="about-item">
                            <h4>INTERESSES</h4>
                            <p>{{ $user->interests }}</p>
                        </div>
                    @endif
                    @if ($user->institution)
                        <div class="about-item">
                            <h4>INSTITUIÇÃO</h4>
                            <p>{{ $user->institution }}</p>
                        </div>
                    @endif
                </div>
                @if (!$user->bio && !$user->competencies && !$user->interests && !$user->institution)
                    <p class="text-gray-500">O utilizador ainda não preencheu esta secção.</p>
                @endif
            </section>

            <section class="profile-section card">
                <h2 class="section-title">Organizações</h2>
                @forelse ($user->organizations as $organization)
                    <div class="organization-card" style="{{ !$loop->last ? 'margin-bottom: 1.5rem;' : '' }}">
                        <div class="organization-logo">
                            @if ($organization->logo_path)
                                @php
                                    $isFullUrl = str_starts_with($organization->logo_path, 'http');
                                    $logoSrc = $isFullUrl ? $organization->logo_path : asset('storage/' . $organization->logo_path);
                                @endphp
                                <img src="{{ $logoSrc }}" alt="Logo de {{ $organization->name }}">
                            @else
                                <div class="organization-logo-placeholder flex items-center justify-center h-full bg-gray-200 rounded-lg text-gray-500 font-bold text-2xl">
                                    {{ Str::substr($organization->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <div class="organization-info">
                            <h4>{{ $organization->name }}</h4>
                            <p><strong>Função:</strong> {{ ucfirst($organization->pivot->role) }}</p>
                            <a href="{{ route('organizations.show', $organization) }}">Ver Organização</a>
                        </div>
                    </div>
                @empty
                    <p style="color: var(--gray-text-color);">Este utilizador não está vinculado a nenhuma organização.</p>
                @endforelse
            </section>

            <section class="profile-section card">
                <h2 class="section-title">Atividade Recente</h2>
                <ul class="activity-list">
                    @forelse ($user->projects->sortByDesc('pivot.created_at')->take(5) as $project)
                        <li class="activity-list-item">
                            <div class="activity-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24" stroke-width="1.5" stroke="currentColor">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h12M3.75 3h16.5v11.25c0 1.242-.93 2.25-2.086 2.25H6.086A2.25 2.25 0 013.75 14.25V3z" />
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9h16.5" />
                                </svg>
                            </div>
                            <div class="activity-text">
                                <p>Ingressou no projeto <a href="#" style="color: var(--primary-color); font-weight: 500;">{{ $project->title }}</a></p>
                                <span>{{ $project->pivot->created_at->diffForHumans() }}</span>
                            </div>
                        </li>
                    @empty
                        <p style="color: var(--gray-text-color);">Nenhuma atividade recente em projetos.</p>
                    @endforelse
                </ul>
            </section>
        </main>
    </div>
@endsection
