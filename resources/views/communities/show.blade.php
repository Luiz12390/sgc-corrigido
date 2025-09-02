@extends('layouts.app')

@section('title', 'Comunidade: Centro de Inovadores de Tecnologia | SGC-Chapecó')

@push('styles')
<style>
    /* ESTILOS ESPECÍFICOS DA PÁGINA INTERNA DA COMUNIDADE */

    /* Banner e Cabeçalho (similar ao perfil da organização) */
    .community-banner {
        height: 250px;
        background-image: url('https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=1200');
        background-size: cover;
        background-position: center;
    }
    .community-header {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2.5rem;
        display: flex;
        align-items: flex-end;
        gap: 1.5rem;
        margin-top: -80px;
        position: relative;
        margin-bottom: 2rem;
    }
    .community-avatar {
        width: 160px;
        height: 160px;
        border-radius: 12px;
        object-fit: cover;
        border: 5px solid var(--card-background-color);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        flex-shrink: 0;
    }
    .community-info { flex-grow: 1; padding-bottom: 1rem; }
    .community-info h1 { font-size: 1.75rem; font-weight: 600; color: var(--text-color); }
    .community-info p { font-size: 1rem; color: var(--gray-text-color); }
    .community-actions { display: flex; gap: 1rem; padding-bottom: 1rem; }
    .btn { padding: 0.7rem 1.5rem; border-radius: 8px; font-weight: 600; font-size: 0.9rem; cursor: pointer; transition: all 0.3s ease; border: 1px solid var(--primary-color); }
    .btn-secondary { background-color: var(--card-background-color); color: var(--primary-color); }
    .btn-secondary:hover { background-color: #f1f1f1; }
    .btn-primary { background-color: var(--primary-color); color: var(--white-color); }
    .btn-primary:hover { background-color: #256e67; border-color: #256e67; }

    /* Layout Principal da Página */
    .page-container {
        display: grid;
        grid-template-columns: 1fr 320px; /* Conteúdo flexível, sidebar fixa */
        gap: 2.5rem;
        max-width: 1200px;
        margin: 0 auto;
        padding: 1rem 2.5rem 2.5rem 2.5rem;
    }

    /* Abas de Navegação */
    .community-nav {
        display: flex;
        gap: 1.5rem;
        border-bottom: 1px solid var(--border-color);
        margin-bottom: 2rem;
    }
    .community-nav a {
        padding: 0.5rem 0.25rem 1rem 0.25rem;
        font-weight: 500;
        color: var(--gray-text-color);
        border-bottom: 3px solid transparent;
    }
    .community-nav a.active, .community-nav a:hover {
        color: var(--primary-color);
        border-bottom-color: var(--primary-color);
    }

    /* Feed de Posts */
    .feed-container { display: flex; flex-direction: column; gap: 1.5rem; }

    /* Card para Nova Publicação */
    .new-post-card { display: flex; gap: 1rem; align-items: flex-start; }
    .new-post-card img { width: 48px; height: 48px; border-radius: 50%; }
    .new-post-card textarea {
        width: 100%;
        padding: 0.8rem 1rem;
        border: 1px solid var(--border-color);
        background-color: var(--card-background-color);
        border-radius: 8px;
        min-height: 60px;
        resize: vertical;
        font-family: 'Poppins', sans-serif;
    }

    /* Card de Publicação Existente */
    .post-card .post-header { display: flex; gap: 1rem; align-items: center; }
    .post-card img { width: 48px; height: 48px; border-radius: 50%; }
    .post-author-info strong { font-weight: 600; }
    .post-author-info span { font-size: 0.85rem; color: var(--gray-text-color); }
    .post-content { padding: 1rem 0 1rem 64px; /* Alinhado com o texto, abaixo da foto */ }
    .post-content p { line-height: 1.7; }
    .post-actions { padding-left: 64px; display: flex; gap: 1.5rem; color: var(--gray-text-color); font-size: 0.9rem; }
    .post-actions a { display: flex; align-items: center; gap: 0.5rem; }

    /* Sidebar da Comunidade */
    .community-sidebar { display: flex; flex-direction: column; gap: 1.5rem; }
    .sidebar-card h3 { font-size: 1.1rem; font-weight: 600; margin-bottom: 1rem; }
    .sidebar-card p, .sidebar-card li { font-size: 0.95rem; color: var(--gray-text-color); line-height: 1.6; }
    .featured-members-list { display: flex; flex-wrap: wrap; gap: 0.5rem; }
    .featured-members-list img { width: 40px; height: 40px; border-radius: 50%; }
</style>
@endpush

@section('content')
    <div class="community-banner"></div>

    <div class="community-header">
        <img src="https://via.placeholder.com/160" alt="Avatar da Comunidade" class="community-avatar">
        <div class="community-info">
            <h1>Centro de Inovadores de Tecnologia</h1>
            <p>1.234 Membros</p>
        </div>
        <div class="community-actions">
            <button class="btn btn-secondary">Convidar</button>
            <button class="btn btn-primary">Sair da Comunidade</button>
        </div>
    </div>

    <div class="page-container">
        <main class="main-content">
            <nav class="community-nav">
                <a href="#" class="active">Posts</a>
                <a href="#">Membros</a>
                <a href="#">Eventos</a>
                <a href="#">Recursos</a>
                <a href="#">Sobre</a>
            </nav>

            <div class="feed-container">
                <div class="card new-post-card">
                    <img src="https://i.pravatar.cc/150?u={{ auth()->id() ?? 'default' }}" alt="Seu avatar">
                    <textarea placeholder="No que você está pensando?"></textarea>
                </div>

                <div class="card post-card">
                    <div class="post-header">
                        <img src="https://i.pravatar.cc/150?u=olivia" alt="Avatar de Olivia Carter">
                        <div class="post-author-info">
                            <strong>Olivia Carter</strong>
                            <span>postou 2 horas atrás</span>
                        </div>
                    </div>
                    <div class="post-content">
                        <p>Alguém aqui já trabalhou com a nova biblioteca de IA do Google para análise de dados não-estruturados? Estou procurando alguns insights sobre a implementação em projetos de grande escala. Qualquer dica é bem-vinda!</p>
                    </div>
                    <div class="post-actions">
                        <a href="#">👍 Curtir</a>
                        <a href="#">💬 Comentar</a>
                        <a href="#">🔗 Compartilhar</a>
                    </div>
                </div>

                <div class="card post-card">
                    <div class="post-header">
                        <img src="https://i.pravatar.cc/150?u=ethan" alt="Avatar de Ethan Bennett">
                        <div class="post-author-info">
                            <strong>Ethan Bennett</strong>
                            <span>postou ontem às 17:45</span>
                        </div>
                    </div>
                    <div class="post-content">
                        <p>Convite para todos! Na próxima quinta-feira, teremos um meetup online para discutir o futuro do desenvolvimento low-code em Chapecó. Link para inscrição na seção de eventos da comunidade. Espero vocês lá!</p>
                    </div>
                     <div class="post-actions">
                        <a href="#">👍 Curtir</a>
                        <a href="#">💬 Comentar</a>
                        <a href="#">🔗 Compartilhar</a>
                    </div>
                </div>
            </div>
        </main>

        <aside class="community-sidebar">
            <div class="card sidebar-card">
                <h3>Sobre esta comunidade</h3>
                <p>Um espaço para entusiastas de tecnologia, desenvolvedores e inovadores compartilharem ideias e colaborarem em projetos.</p>
            </div>
            <div class="card sidebar-card">
                <h3>Membros em Destaque</h3>
                <div class="featured-members-list">
                    <a href="#"><img src="https://i.pravatar.cc/150?u=a" alt="Membro"></a>
                    <a href="#"><img src="https://i.pravatar.cc/150?u=b" alt="Membro"></a>
                    <a href="#"><img src="https://i.pravatar.cc/150?u=c" alt="Membro"></a>
                    <a href="#"><img src="https://i.pravatar.cc/150?u=d" alt="Membro"></a>
                    <a href="#"><img src="https://i.pravatar.cc/150?u=e" alt="Membro"></a>
                </div>
            </div>
            <div class="card sidebar-card">
                <h3>Próximos Eventos</h3>
                <ul>
                    <li><strong>Meetup Low-Code:</strong> 04/09/2025</li>
                    <li><strong>Workshop de IA:</strong> 18/09/2025</li>
                </ul>
            </div>
        </aside>
    </div>
@endsection
