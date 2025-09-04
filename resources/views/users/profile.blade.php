@extends('layouts.app')

@section('title', $user->name . ' | SGC-Chapecó')

@push('styles')
<style>
    /* Cole aqui todos os estilos da sua página de perfil */
    .profile-banner { height: 200px; background-image: url('/images/profile_banner.png'); background-size: cover; background-position: center; }
    .profile-page-container { max-width: 1100px; margin: 0 auto; padding: 2.5rem; }
    .profile-header { display: flex; align-items: center; gap: 2rem; margin-bottom: 2.5rem; background-color: var(--card-background-color); padding: 2rem; border-radius: 12px; border: 1px solid var(--border-color); box-shadow: var(--box-shadow); }
    .profile-header-avatar { width: 120px; height: 120px; border-radius: 50%; object-fit: cover; border: 4px solid var(--white-color); box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
    .profile-header-info { flex-grow: 1; }
    .profile-header-info h1 { font-size: 1.75rem; font-weight: 600; }
    .profile-header-info p { font-size: 1rem; color: var(--gray-text-color); line-height: 1.5; }
    .profile-header-actions { display: flex; gap: 1rem; }
    .btn { padding: 0.7rem 1.5rem; border-radius: 8px; font-weight: 600; font-size: 0.9rem; cursor: pointer; transition: all 0.3s ease; border: 1px solid var(--primary-color); }
    .btn-secondary { background-color: var(--card-background-color); color: var(--primary-color); }
    .btn-primary { background-color: var(--primary-color); color: var(--white-color); }
    .profile-content { display: flex; flex-direction: column; gap: 2.5rem; }
    .about-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; }
    .about-item h4 { font-size: 0.9rem; font-weight: 600; color: #555; margin-bottom: 0.5rem; }
    .about-item p { font-size: 1rem; color: var(--gray-text-color); line-height: 1.6; }
    .organization-card { display: flex; align-items: center; gap: 2rem; background-color: var(--background-color); padding: 1.5rem; border-radius: 10px; }
    .organization-info { flex-grow: 1; }
    .organization-info h4 { font-size: 1.2rem; margin-bottom: 0.25rem; }
    .organization-info p { margin-bottom: 1rem; font-size: 1rem; color: var(--gray-text-color); }
    .organization-info a { font-weight: 500; color: var(--primary-color); }
    .organization-logo img { width: 180px; height: 100px; object-fit: cover; border-radius: 8px; flex-shrink: 0; }
    .alert-success { padding: 1rem; margin-bottom: 1.5rem; border-radius: 8px; background-color: #d1e7dd; color: #0f5132; }
</style>
@endpush

@section('content')
    <div class="profile-banner"></div>
    <div class="profile-page-container">

        @if (session('status'))
            <div class="alert-success"> {{ session('status') }} </div>
        @endif

        <div class="profile-header card">
            <img src="{{ $user->profile_photo_path ?? 'https://via.placeholder.com/120' }}" alt="Foto de {{ $user->name }}" class="profile-header-avatar">
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
        </div>

        <main class="profile-content">
            <section class="profile-section card">
                <h2 class="section-title">Sobre</h2>
                {{-- Conteúdo estático da seção sobre --}}
            </section>

            <section class="profile-section card">
                <h2 class="section-title">Organizações</h2>
                
                {{-- Agora usamos um loop, pois um usuário pode ter mais de uma organização --}}
                @forelse ($user->organizations as $organization)
                    <div class="organization-card" style="{{ !$loop->last ? 'margin-bottom: 1.5rem;' : '' }}">
                        <div class="organization-info">
                            <h4>{{ $organization->name }}</h4>
                            <p><strong>Função:</strong> {{ ucfirst($organization->pivot->role) }}</p>
                            <a href="{{ route('organizations.show', $organization) }}">Ver Organização</a>
                        </div>
                        @if($organization->logo_path)
                        <div class="organization-logo">
                            <img src="{{ asset($organization->logo_path) }}" alt="Logo de {{ $organization->name }}">
                        </div>
                        @endif
                    </div>
                @empty
                    <p style="color: var(--gray-text-color);">Este usuário não está vinculado a nenhuma organização.</p>
                @endforelse
            </section>

            <section class="profile-section card">
                <h2 class="section-title">Atividade Recente</h2>
                <p style="color: var(--gray-text-color);"><i>Funcionalidade a ser implementada.</i></p>
            </section>
        </main>
    </div>
@endsection