@extends('layouts.app')

@section('title', 'Perfil de Usuário | SGC-Chapecó')

@push('styles')
<style>
    /* ESTILOS ESPECÍFICOS DA PÁGINA DE PERFIL */
    .profile-banner {
        height: 200px;
        background-image: url('/images/profile_banner.png');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
    .profile-page-container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 2.5rem;
    }
    .profile-header {
        display: flex;
        align-items: center;
        gap: 2rem;
        margin-bottom: 2.5rem;
        background-color: var(--card-background-color);
        padding: 2rem;
        border-radius: 12px;
        border: 1px solid var(--border-color);
        box-shadow: var(--box-shadow);
    }
    .profile-header-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid var(--white-color);
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .profile-header-info { flex-grow: 1; }
    .profile-header-info h1 { font-size: 1.75rem; font-weight: 600; }
    .profile-header-info p { font-size: 1rem; color: var(--gray-text-color); line-height: 1.5; }
    .profile-header-actions { display: flex; gap: 1rem; }
    .btn { padding: 0.7rem 1.5rem; border-radius: 8px; font-weight: 600; font-size: 0.9rem; cursor: pointer; transition: all 0.3s ease; border: 1px solid var(--primary-color); }
    .btn-secondary { background-color: var(--card-background-color); color: var(--primary-color); }
    .btn-secondary:hover { background-color: #f1f1f1; }
    .btn-primary { background-color: var(--primary-color); color: var(--white-color); }
    .btn-primary:hover { background-color: #256e67; border-color: #256e67; }
    .profile-content { display: flex; flex-direction: column; gap: 2.5rem; }
    .about-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; }
    .about-item h4 { font-size: 0.9rem; font-weight: 600; color: #555; margin-bottom: 0.5rem; }
    .about-item p { font-size: 1rem; color: var(--gray-text-color); line-height: 1.6; }
    .activity-list { list-style: none; display: flex; flex-direction: column; gap: 1.5rem; }
    .activity-list-item { display: flex; gap: 1.5rem; align-items: flex-start; }
    .activity-icon { flex-shrink: 0; width: 40px; height: 40px; border-radius: 8px; display: flex; align-items: center; justify-content: center; background-color: var(--background-color); }
    .activity-icon svg { width: 20px; height: 20px; stroke: var(--primary-color); }
    .activity-text p { font-size: 1rem; line-height: 1.5; }
    .activity-text span { font-size: 0.85rem; color: #999; }
    .content-item a { font-size: 1.1rem; font-weight: 600; color: var(--primary-color); }
    .content-item span { font-size: 0.9rem; color: var(--gray-text-color); display: block; margin-top: 0.25rem; }
    .content-item p { font-size: 1rem; margin-top: 0.5rem; color: var(--gray-text-color); line-height: 1.6; }

    /* CSS para o novo card de organização */
    .organization-card {
        display: flex;
        align-items: center;
        gap: 2rem;
        background-color: var(--background-color);
        padding: 1.5rem;
        border-radius: 10px;
    }
    .organization-info { flex-grow: 1; }
    .organization-info h4 { font-size: 1.2rem; margin-bottom: 0.25rem; }
    .organization-info p { margin-bottom: 1rem; font-size: 1rem; color: var(--gray-text-color); line-height: 1.6; }
    .organization-info a { font-weight: 500; color: var(--primary-color); }
    .organization-logo img {
        width: 180px;
        height: 100px;
        object-fit: cover;
        border-radius: 8px;
        flex-shrink: 0;
    }
</style>
@endpush

@section('content')
    <div class="profile-banner"></div>

    <div class="profile-page-container">

        <div class="profile-header card">
            <img src="https://i.pravatar.cc/150?u=amelia" alt="Foto de Dr. Amelia Silva" class="profile-header-avatar">
            <div class="profile-header-info">
                <h1>Dr. Amelia Silva</h1>
                <p>Pesquisador na Universidade<br>Federal da Fronteira Sul (UFFS), Chapecó, Brazil</p>
            </div>
            <div class="profile-header-actions">
                <button class="btn btn-secondary">Ver Perfil</button>
                <button class="btn btn-primary">Editar Perfil</button>
            </div>
        </div>

        <main class="profile-content">
            <section class="profile-section card">
                <h2 class="section-title">Organização</h2>
                <div class="organization-card">
                    <div class="organization-info">
                        <h4>Tech Innovate Solutions</h4>
                        <p>Fornecedor líder de soluções sustentáveis para diversas indústrias.</p>
                        <a href="{{ route('organizations.show') }}">Ver Organização</a>
                    </div>
                    <div class="organization-logo">
                        <img src="https://via.placeholder.com/180x100.png?text=Logo+Empresa" alt="Logo da Empresa">
                    </div>
                </div>
            </section>

            <section class="profile-section card">
                <h2 class="section-title">Sobre</h2>
                <div class="about-grid">
                    <div class="about-item"><h4>Áreas de Conhecimento</h4> <p>Biotecnologia, Ciências Ambientais</p></div>
                    <div class="about-item"><h4>Competências</h4> <p>Análise de Dados, Gestão de Projetos</p></div>
                    <div class="about-item"><h4>Interesses</h4> <p>Desenvolvimento Sustentável, Energia Renovável</p></div>
                    <div class="about-item"><h4>Instituição</h4> <p>Universidade Federal da Fronteira Sul (UFFS) — Campus Chapecó</p></div>
                </div>
            </section>

            <section class="profile-section card">
                <h2 class="section-title">Atividade Recente</h2>
                <ul class="activity-list">
                    {{-- Itens de atividade aqui --}}
                </ul>
            </section>
        </main>
    </div>
@endsection
