@extends('layouts.app')

@section('title', 'Perfil da Organização | SGC-Chapecó')

@push('styles')
<style>
    /* ESTILOS ESPECÍFICOS DA PÁGINA DE PERFIL DA ORGANIZAÇÃO */

    /* Banner e Cabeçalho do Perfil */
    .profile-banner {
        height: 200px;
        background-image: url('https://images.unsplash.com/photo-1522071820081-009f0129c7da?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3wzOTAxM3wwfDF8c2VhcmNofDEwfHx0ZWFtfGVufDB8fHx8MTcyNTAyNTc4NHww&ixlib=rb-4.0.3&q=80&w=1200');
        background-size: cover;
        background-position: center;
    }
    .profile-page-container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 2.5rem 2.5rem 2.5rem;
    }
    .profile-header {
        display: flex;
        align-items: center;
        gap: 2rem;
        margin-top: -80px; /* Puxa a logo para cima */
        position: relative;
        margin-bottom: 2.5rem;
    }
    .profile-header-avatar {
        width: 160px;
        height: 160px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid var(--card-background-color);
        background-color: var(--card-background-color);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        flex-shrink: 0;
    }
    .profile-header-info { flex-grow: 1; padding-top: 80px; }
    .profile-header-info h1 { font-size: 1.75rem; font-weight: 600; }
    .profile-header-info p { font-size: 1rem; color: var(--gray-text-color); line-height: 1.5; }
    .profile-header-actions { display: flex; gap: 1rem; margin-left: auto; padding-top: 80px; }
    .btn { padding: 0.7rem 1.5rem; border-radius: 8px; font-weight: 600; font-size: 0.9rem; cursor: pointer; transition: all 0.3s ease; border: 1px solid var(--primary-color); }
    .btn-secondary { background-color: var(--card-background-color); color: var(--primary-color); }
    .btn-secondary:hover { background-color: #f1f1f1; }
    .btn-primary { background-color: var(--primary-color); color: var(--white-color); }
    .btn-primary:hover { background-color: #256e67; border-color: #256e67; }

    /* Seções de Conteúdo */
    .profile-content { display: flex; flex-direction: column; gap: 2.5rem; }
    .section-title { font-size: 1.5rem; font-weight: 600; margin-bottom: 1.5rem; }

    /* Seção Sobre */
    .about-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; }
    .about-item h4 { font-size: 0.9rem; font-weight: 600; color: #555; margin-bottom: 0.5rem; }
    .about-item p { font-size: 1rem; color: var(--gray-text-color); line-height: 1.6; }

    /* Seção Membros */
    .members-list {
        display: flex;
        gap: 1rem;
    }
    .member-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid var(--white-color);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    /* Grid de Cards (Projetos, Desafios, Eventos) */
    .content-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr); /* 3 colunas */
        gap: 2rem;
    }
    .content-grid-card {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: var(--box-shadow);
        border: 1px solid var(--border-color);
        background-color: var(--card-background-color);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .content-grid-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }
    .content-grid-card img {
        height: 160px;
        width: 100%;
        object-fit: cover;
    }
    .card-content {
        padding: 1.25rem;
    }
    .card-content h4 {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }
    .card-content p {
        font-size: 0.9rem;
        color: var(--gray-text-color);
        line-height: 1.5;
    }
    .owner-link {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        text-decoration: none;
        transition: opacity 0.3s ease;
    }
    .owner-link:hover {
        opacity: 0.8;
    }
    .owner-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        object-fit: cover;
    }
    .owner-link span {
        font-size: 1rem;
        font-weight: 500;
        color: var(--primary-color);
    }
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .view-all-link {
        font-weight: 500;
        color: var(--primary-color);
        font-size: 0.9rem;
    }
</style>
@endpush

@section('content')
    <div class="profile-banner"></div>

    <div class="profile-page-container">
        <div class="profile-header">
            <img src="https://via.placeholder.com/160" alt="Logo da Tech Innovate Solutions" class="profile-header-avatar">
            <div class="profile-header-info">
                <h1>Tech Innovate Solutions</h1>
                <p>Innovation Hub<br>Chapecó, Brazil</p>
            </div>
            <div class="profile-header-actions">
                <button class="btn btn-secondary">Seguir</button>
                <button class="btn btn-primary">Mensagem</button>
            </div>
        </div>

        <main class="profile-content">
            <section class="profile-section card">
                <h2 class="section-title">Sobre</h2>
                <div class="about-grid">
                    <div class="about-item"><h4>Tipo</h4><p>Empresa de Tecnologia</p></div>
                    <div class="about-item">
                        <h4>Proprietario</h4>
                        <a href="{{ route('profile') }}" class="owner-link">
                            <img src="https://i.pravatar.cc/150?u=joao_silva" alt="Foto de João Silva" class="owner-avatar">
                            <span>João Silva</span>
                        </a>
                    </div>
                    <div class="about-item"><h4>Áreas de Especialização</h4><p>Desenvolvimento de Software, IA, Aprendizado de Máquina</p></div>
                    <div class="about-item"><h4>Competências</h4><p>Desenvolvimento Ágil, Gestão de Projetos, Análise de dados</p></div>
                    <div class="about-item"><h4>Recursos Disponíveis</h4><p>Computação em Nuvem, Centros de Dados, Ferramentas de Desenvolvimento</p></div>
                </div>
            </section>

            <section class="profile-section card">
                <div class="section-header">
                    <h2 class="section-title">Membros</h2>
                    <a href="{{ route('organizations.members') }}" class="view-all-link">Ver todos &rarr;</a>
                </div>
                <div class="members-list">
                    <img src="https://i.pravatar.cc/150?u=member1" alt="Membro 1" class="member-avatar">
                    <img src="https://i.pravatar.cc/150?u=member2" alt="Membro 2" class="member-avatar">
                    <img src="https://i.pravatar.cc/150?u=member3" alt="Membro 3" class="member-avatar">
                    <img src="https://i.pravatar.cc/150?u=member4" alt="Membro 4" class="member-avatar">
                </div>
            </section>

            <section>
                <h2 class="section-title">Projetos</h2>
                <div class="content-grid">
                    <a href="#" class="content-grid-card"><img src="https://images.unsplash.com/photo-1517430816045-df4b7de11d1d?w=400" alt="Projeto 1"><div class="card-content"><h4>Iniciativa Cidade Inteligente</h4><p>Desenvolvendo soluções para desafios urbanos</p></div></a>
                    <a href="#" class="content-grid-card"><img src="https://images.unsplash.com/photo-1581092921462-20524a2a9170?w=400" alt="Projeto 2"><div class="card-content"><h4>Projeto de Automação Robótica</h4><p>Automatizando processos industriais com robótica</p></div></a>
                    <a href="#" class="content-grid-card"><img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=400" alt="Projeto 3"><div class="card-content"><h4>Plataforma de Análise com IA</h4><p>Análises avançadas para insights de negócios</p></div></a>
                </div>
            </section>

            <section>
                <h2 class="section-title">Desafios</h2>
                <div class="content-grid">
                    <a href="#" class="content-grid-card"><img src="https://images.unsplash.com/photo-1542601904-86986a848528?w=400" alt="Desafio 1"><div class="card-content"><h4>Desafio de Energia Renovável</h4><p>Buscando soluções inovadoras em energia renovável</p></div></a>
                    <a href="#" class="content-grid-card"><img src="https://images.unsplash.com/photo-1560493676-04071c5f467b?w=400" alt="Desafio 2"><div class="card-content"><h4>Inovação em Agricultura de Precisão</h4><p>Melhorando a eficiência agrícola com tecnologia</p></div></a>
                    <a href="#" class="content-grid-card"><img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=400" alt="Desafio 3"><div class="card-content"><h4>Soluções em Tecnologia para Saúde</h4><p>Desenvolvendo novas tecnologias para a saúde</p></div></a>
                </div>
            </section>

            <section>
                <h2 class="section-title">Eventos</h2>
                <div class="content-grid">
                    <a href="#" class="content-grid-card"><img src="https://images.unsplash.com/photo-1505373877841-8d25f7d46678?w=400" alt="Evento 1"><div class="card-content"><h4>Cúpula de Inovação 2024</h4><p>Conferência anual de inovação</p></div></a>
                    <a href="#" class="content-grid-card"><img src="https://images.unsplash.com/photo-1543269865-cbf427effbad?w=400" alt="Evento 2"><div class="card-content"><h4>Tech Connect Chapecó</h4><p>Encontro mensal de tecnologia</p></div></a>
                    <a href="#" class="content-grid-card"><img src="https://images.unsplash.com/photo-1517486808906-6538cb3b8656?w=400" alt="Evento 3"><div class="card-content"><h4>Noite de Pitch de Startups</h4><p>Apresentando startups inovadoras</p></div></a>
                </div>
            </section>

        </main>
    </div>
@endsection
