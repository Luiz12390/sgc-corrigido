@extends('layouts.app')

@section('title', 'Visualizar Recurso | SGC-Chapecó')

@push('styles')
<style>
    /* ESTILOS ESPECÍFICOS DA PÁGINA DE VISUALIZAÇÃO DE RECURSO */
    .page-container {
        display: grid;
        grid-template-columns: 2.5fr 1fr; /* Coluna do PDF 2.5x maior que a da info */
        gap: 2.5rem;
        max-width: 1600px;
        margin: 0 auto;
        padding: 2.5rem;
    }

    /* Visualizador de PDF */
    .pdf-viewer-card {
        padding: 0;
        overflow: hidden; /* Garante que o conteúdo não vaze */
    }
    .pdf-viewer-header {
        background-color: #333;
        color: white;
        padding: 0.75rem 1.5rem;
        font-size: 0.9rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .pdf-viewer-body {
        height: 100vh; /* Faz o visualizador ocupar a altura da tela */
    }
    .pdf-viewer-body embed {
        width: 100%;
        height: 100%;
    }

    /* Barra Lateral de Informações */
    .resource-sidebar {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }
    .sidebar-card h3 {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--border-color);
    }
    .actions-buttons {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    .btn {
        display: block;
        width: 100%;
        text-align: center;
        padding: 0.8rem;
        border-radius: 8px;
        font-weight: 500;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .btn-primary {
        background-color: var(--primary-color);
        color: var(--white-color);
        border: 1px solid var(--primary-color);
    }
    .btn-primary:hover { background-color: #256e67; }
    .btn-secondary {
        background-color: var(--card-background-color);
        color: var(--primary-color);
        border: 1px solid var(--primary-color);
    }
    .btn-secondary:hover { background-color: #f1f1f1; }

    .resource-details-list {
        list-style: none;
    }
    .resource-details-list li {
        margin-bottom: 1rem;
        font-size: 0.95rem;
    }
    .resource-details-list li strong {
        display: block;
        color: #555;
        font-weight: 500;
        font-size: 0.85rem;
    }
    .resource-summary p {
        font-size: 0.95rem;
        line-height: 1.6;
        color: var(--gray-text-color);
    }
</style>
@endpush

@section('content')
<div class="page-container">
    <main class="pdf-viewer-area">
        <div class="card pdf-viewer-card">
            <div class="pdf-viewer-header">
                <span>Visualizador de Documento</span>
                <span>Página 1 de 12</span>
            </div>
            <div class="pdf-viewer-body">
                <embed src="https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf" type="application/pdf" />
            </div>
        </div>
    </main>

    <aside class="resource-sidebar">
        <div class="card sidebar-card">
            <h3>Ações</h3>
            <div class="actions-buttons">
                <a href="#" class="btn btn-primary">Visualizar PDF</a>
                <a href="#" class="btn btn-secondary">Baixar PDF</a>
            </div>
        </div>

        <div class="card sidebar-card">
            <h3>Detalhes do Recurso</h3>
            <ul class="resource-details-list">
                <li>
                    <strong>Título</strong>
                    Análise do Ecossistema de Startups de Chapecó
                </li>
                <li>
                    <strong>Autor(es)</strong>
                    Dr. Olivia Carter, Prof. Ethan Bennett
                </li>
                <li>
                    <strong>Data de Publicação</strong>
                    15 de Agosto de 2025
                </li>
                <li>
                    <strong>Categoria</strong>
                    Relatório
                </li>
                 <li>
                    <strong>Tags</strong>
                    Startups, Ecossistema, Inovação, Chapecó
                </li>
            </ul>
        </div>

        <div class="card sidebar-card resource-summary">
            <h3>Resumo</h3>
            <p>Uma visão aprofundada do cenário de startups em Chapecó, incluindo os principais atores, desafios e oportunidades. Este relatório serve como um guia para investidores, empreendedores e formuladores de políticas públicas.</p>
        </div>
    </aside>
</div>
@endsection
