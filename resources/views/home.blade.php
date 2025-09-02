@extends('layouts.app')

@section('title', 'Página Principal | SGC-Chapecó')

@push('styles')
<style>
    /* ESTILOS ESPECÍFICOS DA PÁGINA HOME */
    .main-container {
        display: grid;
        grid-template-columns: 320px 1fr;
        gap: 2rem;
        padding: 2rem 2.5rem;
        max-width: 1600px;
        margin: 0 auto;
    }

    .sidebar, .main-content {
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    .recent-activities ul, .suggested-connections ul {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .activity-item, .connection-item {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .activity-item .icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--background-color);
    }

    .activity-item .icon img {
        width: 100%;
        border-radius: 50%;
        object-fit: cover;
    }

    .activity-item .icon svg {
        width: 20px;
        height: 20px;
        stroke: var(--primary-color);
    }

    .activity-details p {
        font-size: 0.9rem;
        line-height: 1.4;
    }

    .activity-details span {
        font-size: 0.8rem;
        color: var(--gray-text-color);
    }

    .connection-item {
        flex-direction: column;
        text-align: center;
        padding: 1.5rem;
        border: 1px solid var(--border-color);
        border-radius: 10px;
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

    .grid-container {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 2rem;
    }

    .content-card {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: var(--box-shadow);
        border: 1px solid var(--border-color);
        background-color: var(--card-background-color);
    }

    .content-card .card-image {
        height: 180px;
        background-color: #e0e0e0;
        object-fit: cover;
    }

    .content-card .card-content {
        padding: 1rem 1.25rem;
    }

    .content-card h4 {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .content-card p {
        font-size: 0.9rem;
        color: var(--gray-text-color);
        line-height: 1.5;
    }
</style>
@endpush

@section('content')
<div class="main-container">
    <aside class="sidebar">

        <div class="card recent-activities">
            <h3 class="card-title">Atividades recentes</h3>
            <ul>
                <li class="activity-item">
                    <div class="icon">
                        <img src="https://i.pravatar.cc/150?u=alex" alt="Foto de Alex">
                    </div>
                    <div class="activity-details">
                        <p><strong>Alex</strong> te enviou uma mensagem</p>
                        <span>Nova mensagem de Alex</span>
                    </div>
                </li>
                <li class="activity-item">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h12M3.75 3h16.5v11.25c0 1.242-.93 2.25-2.086 2.25H6.086A2.25 2.25 0 013.75 14.25V3z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9h16.5" />
                        </svg>
                    </div>
                    <div class="activity-details">
                        <p><strong>Desafio:</strong> Embalagens Sustentáveis</p>
                        <span>Prazo do desafio se aproximando</span>
                    </div>
                </li>
            </ul>
        </div>

        <div class="card suggested-connections">
            <h3 class="card-title">Conexões Sugeridas</h3>
            <ul>
                <li class="connection-item">
                    <img src="https://i.pravatar.cc/150?u=olivia" alt="Foto de Dr. Olivia Carter" class="profile-pic">
                    <h4>Dr. Olivia Carter</h4>
                    <p>Pesquisadora na Universidade Federal da Fronteira Sul (UFFS) — Campus Chapecó</p>
                </li>
                <li class="connection-item">
                    <img src="https://i.pravatar.cc/150?u=ethan" alt="Foto de Prof. Ethan Bennett" class="profile-pic">
                    <h4>Prof. Ethan Bennett</h4>
                    <p>Empreendedor na Tech Innovators Inc.</p>
                </li>
            </ul>
        </div>

    </aside>

    <main class="main-content">

        <section class="content-section">
            <h2 class="content-section-title">Desafios em Destaque</h2>
            <div class="grid-container">
                <a href="#" class="content-card">
                    <img src="https://images.unsplash.com/photo-1598439213713-9a152781b058?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3wzOTAxM3wwfDF8c2VhcmNofDI3fHxwb3VjaCUyMHByb2R1Y3R8ZW58MHx8fHwxNzIzMDIxODc5fDA&ixlib=rb-4.0.3&q=80&w=400" alt="Embalagens" class="card-image">
                    <div class="card-content">
                        <h4>Desafio de Embalagens Sustentáveis</h4>
                        <p>Buscando soluções de embalagens ecologicamente corretas</p>
                    </div>
                </a>
                <a href="#" class="content-card">
                    <img src="https://images.unsplash.com/photo-1499529112087-3cb3b73cec95?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3wzOTAxM3wwfDF8c2VhcmNofDEyfHxmYXJtJTIwZmllbGR8ZW58MHx8fHwxNzIzMDIxOTc3fDA&ixlib=rb-4.0.3&q=80&w=400" alt="Agricultura" class="card-image">
                    <div class="card-content">
                        <h4>Soluções para Agricultura Inteligente</h4>
                        <p>Inovar em tecnologias de agricultura de precisão</p>
                    </div>
                </a>
            </div>
        </section>

        <section class="content-section">
            <h2 class="content-section-title">Projetos em Andamento</h2>
            <div class="grid-container">
                <a href="#" class="content-card">
                    <img src="https://images.unsplash.com/photo-1416518037887-3a1681b42b78?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3wzOTAxM3wwfDF8c2VhcmNofDl8fHdpbmQlMjB0dXJiaW5lfGVufDB8fHx8MTcyMzAyMjAyMnww&ixlib=rb-4.0.3&q=80&w=400" alt="Energia Renovável" class="card-image">
                    <div class="card-content">
                        <h4>Projeto de Energia Renovável</h4>
                        <p>Desenvolvendo tecnologia para painéis solares</p>
                    </div>
                </a>
                <a href="#" class="content-card">
                    <img src="https://images.unsplash.com/photo-1579154230002-385010073539?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3wzOTAxM3wwfDF8c2VhcmNofDExfHxkbkElMjBoZWxpeHxlbnwwfHx8fDE3MjMwMjIwNjZ8MA&ixlib=rb-4.0.3&q=80&w=400" alt="Biotecnologia" class="card-image">
                    <div class="card-content">
                        <h4>Iniciativa de Pesquisa em Biotecnologia</h4>
                        <p>Explorar novos métodos na descoberta de medicamentos</p>
                    </div>
                </a>
            </div>
        </section>

         <section class="content-section">
                <h2 class="content-section-title">Próximos Eventos</h2>
                <div class="grid-container">
                    <a href="#" class="content-card">
                        <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3wzOTAxM3wwfDF8c2VhcmNofDd8fHdvcmtzaG9wfGVufDB8fHx8MTcyMzAyMjEwNHww&ixlib=rb-4.0.3&q=80&w=400" alt="Oficina de inovação" class="card-image">
                        <div class="card-content">
                            <h4>Oficina de Inovação</h4>
                            <p>Aprenda sobre design thinking</p>
                        </div>
                    </a>
                    <a href="#" class="content-card">
                        <img src="https://images.unsplash.com/photo-1587825140708-dfaf72ae4b04?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3wzOTAxM3wwfDF8c2VhcmNofDE1fHxjb25mZXJlbmNlfGVufDB8fHx8MTcyMzAyMjE0Mnww&ixlib=rb-4.0.3&q=80&w=400" alt="Conferência" class="card-image">
                        <div class="card-content">
                            <h4>Conferência de Tecnologia</h4>
                            <p>Networking com líderes do setor</p>
                        </div>
                    </a>
                </div>
            </section>

            <section class="content-section">
                <h2 class="content-section-title">Conteúdo Recomendado</h2>
                <div class="grid-container">
                    <a href="#" class="content-card">
                        <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3wzOTAxM3wwfDF8c2VhcmNofDN8fGFydGljbGUlMjBkZXNpZ258ZW58MHx8fHwxNzIzMDIyMTg5fDA&ixlib=rb-4.0.3&q=80&w=400" alt="Artigo" class="card-image">
                        <div class="card-content">
                            <h4>Artigo sobre Economia Circular</h4>
                            <p>Insights sobre modelos de negócios sustentáveis</p>
                        </div>
                    </a>
                    <a href="#" class="content-card">
                        <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3wzOTAxM3wwfDF8c2VhcmNofDE0fHxzdHVkeSUyMGdyb3VwfGVufDB8fHx8MTcyMzAyMjIzMHww&ixlib=rb-4.0.3&q=80&w=400" alt="Estudo de caso" class="card-image">
                        <div class="card-content">
                            <h4>Estudo de Caso sobre Inovação Aberta</h4>
                            <p>Exemplos reais de colaborações bem-sucedidas</p>
                        </div>
                    </a>
                </div>
            </section>
    </main>
</div>
@endsection
