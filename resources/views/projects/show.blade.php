@extends('layouts.app')

@section('title', 'Detalhes do Projeto | SGC-Chapecó')

@push('styles')
<style>
    /* ESTILOS ESPECÍFICOS DA PÁGINA DE DETALHES DO PROJETO */
    .project-detail-container {
        max-width: 950px;
        margin: 0 auto;
        padding: 2.5rem;
    }

    .project-header h1 {
        font-size: 2.25rem;
        font-weight: 600;
        line-height: 1.3;
        margin-bottom: 0.5rem;
    }
    .project-header > p {
        font-size: 1.1rem;
        color: var(--gray-text-color);
        margin-bottom: 2.5rem;
    }

    /* Estilo para todos os cards da página */
    .project-section-card {
        margin-bottom: 2rem;
        padding: 2rem;
    }
    .project-section-card h2 {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
    }

    /* Visão Geral */
    .overview-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
    }
    .overview-item h4 {
        font-size: 0.9rem;
        color: #555;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }
    .overview-item p {
        font-size: 1rem;
        line-height: 1.6;
    }

    /* Membros da Equipe (Estilo Padrão) */
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
    .members-list {
        display: flex;
        margin-top: 1rem; /* Adiciona um espaço abaixo do título */
    }
    .member-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid var(--card-background-color);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        transition: transform 0.2s ease;
    }
    .member-avatar:not(:first-child) {
        margin-left: -20px; /* Efeito de sobreposição */
    }
    .member-avatar:hover {
        transform: translateY(-4px); /* Efeito de levantar ao passar o mouse */
        z-index: 1;
    }

    /* Tabela de Tarefas */
    .tasks-table {
        width: 100%;
        border-collapse: collapse;
    }
    .tasks-table th, .tasks-table td {
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid var(--border-color);
        font-size: 0.95rem;
    }
    .tasks-table thead th {
        color: var(--gray-text-color);
        font-weight: 500;
        font-size: 0.85rem;
        text-transform: uppercase;
    }
    .status-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 12px;
        font-weight: 500;
        font-size: 0.8rem;
    }
    .status-em-andamento { background-color: #e6f7ff; color: #1890ff; border: 1px solid #91d5ff; }
    .status-concluido { background-color: #f6ffed; color: #52c41a; border: 1px solid #b7eb8f; }
    .status-pendente { background-color: #fffbe6; color: #faad14; border: 1px solid #ffe58f; }
    .status-nao-iniciado { background-color: #fafafa; color: #8c8c8c; border: 1px solid #d9d9d9; }

    /* Barra de Progresso */
    .progress-info {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
        font-weight: 500;
    }
    .progress-bar-container {
        width: 100%;
        height: 8px;
        background-color: var(--border-color);
        border-radius: 4px;
        overflow: hidden;
    }
    .progress-bar-fill {
        height: 100%;
        background-color: var(--primary-color);
        border-radius: 4px;
    }

    /* Seção de Comunicação */
    .comment-list { display: flex; flex-direction: column; gap: 1.5rem; margin-bottom: 2rem; }
    .comment-item { display: flex; gap: 1rem; }
    .comment-item img { width: 40px; height: 40px; border-radius: 50%; flex-shrink: 0; }
    .comment-body strong { font-weight: 600; }
    .comment-body .comment-date { font-size: 0.8rem; color: #999; margin-left: 0.5rem; }
    .comment-body p { font-size: 0.95rem; }

    .new-comment-form { display: flex; gap: 1rem; align-items: flex-start; }
    .new-comment-form img { width: 40px; height: 40px; border-radius: 50%; }
    .comment-input-wrapper { flex-grow: 1; position: relative; }
    .comment-input-wrapper textarea {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        min-height: 40px;
        resize: vertical;
        font-family: 'Poppins', sans-serif;
        font-size: 0.95rem;
    }
    .comment-actions { display: flex; gap: 0.5rem; margin-top: 0.5rem; justify-content: flex-end; }
    .comment-actions button { border: none; background: none; cursor: pointer; color: var(--gray-text-color); }
    .comment-actions .btn-send { background-color: var(--primary-color); color: var(--white-color); padding: 0.5rem 1rem; border-radius: 6px; }
</style>
@endpush

@section('content')
<div class="project-detail-container">
    <div class="project-header">
        <h1>Projeto: Soluções de Embalagens Sustentáveis</h1>
        <p>Desenvolver alternativas de embalagens ecologicamente corretas para empresas locais.</p>
    </div>

    <div class="card project-section-card">
        <h2>Visão Geral do Projeto</h2>
        <div class="overview-grid">
            <div class="overview-item">
                <h4>Objetivos</h4>
                <p>Projetar e prototipar materiais de embalagem sustentável, realizar pesquisas de mercado e implementar programas piloto com empresas locais.</p>
            </div>
            <div class="overview-item">
                <h4>Timeline</h4>
                <p>Data de Início: 15/01/2025, Data de Término: 31/12/2025</p>
                <h4 style="margin-top: 1rem;">Orçamento</h4>
                <p>R$ 270.360,00</p>
            </div>
        </div>
    </div>

    <div class="card project-section-card">
        <div class="section-header">
            <h2>Membros da Equipe</h2>
            <a href="{{ route('projetos.members') }}" class="view-all-link">Ver todos &rarr;</a>
        </div>
        <div class="members-list">
            <img src="https://i.pravatar.cc/150?u=a" alt="Membro 1" class="member-avatar">
            <img src="https://i.pravatar.cc/150?u=b" alt="Membro 2" class="member-avatar">
            <img src="https://i.pravatar.cc/150?u=c" alt="Membro 3" class="member-avatar">
            <img src="https://i.pravatar.cc/150?u=d" alt="Membro 4" class="member-avatar">
        </div>
    </div>

    <div class="card project-section-card">
        <div class="section-header">
            <h2>Tarefas</h2>
            <a href="{{ route('projetos.tasks') }}" class="view-all-link">Ver todas as tarefas &rarr;</a>
        </div>
        <table class="tasks-table">
            <thead>
                <tr>
                    <th>Tarefas</th>
                    <th>Status</th>
                    <th>Responsável</th>
                    <th>Prazo Final</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Pesquisa de Materiais</td>
                    <td><span class="status-badge status-em-andamento">Em Andamento</span></td>
                    <td>Dr. Carlos Silva</td>
                    <td>2024-03-15</td>
                </tr>
                <tr>
                    <td>Design de Protótipo</td>
                    <td><span class="status-badge status-concluido">Concluído</span></td>
                    <td>Ana Souza</td>
                    <td>2024-05-20</td>
                </tr>
                <tr>
                    <td>Análise de Mercado</td>
                    <td><span class="status-badge status-pendente">Pendente</span></td>
                    <td>Lucas Mendes</td>
                    <td>2024-07-30</td>
                </tr>
                <tr>
                    <td>Programa Piloto</td>
                    <td><span class="status-badge status-nao-iniciado">Não Iniciado</span></td>
                    <td>Isabela Costa</td>
                    <td>2024-10-15</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="card project-section-card">
        <h2>Acompanhamento do Progresso</h2>
        <div class="progress-info">
            <span>Progresso Geral do Projeto</span>
            <span>60%</span>
        </div>
        <div class="progress-bar-container">
            <div class="progress-bar-fill" style="width: 60%;"></div>
        </div>
    </div>

    <div class="card project-section-card">
        <h2>Comunicação</h2>
        <div class="comment-list">
            <div class="comment-item">
                <img src="https://i.pravatar.cc/150?u=carlos_silva" alt="Avatar">
                <div class="comment-body">
                    <p>
                        <strong>Dr. Carlos Silva</strong>
                        <span class="comment-date">2024-02-28</span>
                    </p>
                    <p>Equipe, vamos agendar uma reunião na próxima semana para discutir as descobertas iniciais da pesquisa de materiais.</p>
                </div>
            </div>
        </div>
        <div class="new-comment-form">
            <img src="https://i.pravatar.cc/150?u={{ auth()->id() ?? 'default' }}" alt="Seu avatar">
            <div class="comment-input-wrapper">
                <textarea placeholder="Escreva"></textarea>
                <div class="comment-actions">
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0z"/></svg>
                    </button>
                    <button class="btn-send">Enviar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
