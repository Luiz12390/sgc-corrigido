@extends('layouts.app')

{{-- O título da página agora usa o título do desafio --}}
@section('title', ($challenge->title ?? 'Detalhes do Desafio') . ' | SGC-Chapecó')

@push('styles')
<style>
    /* ESTILOS ESPECÍFICOS DA PÁGINA DE DETALHE DO DESAFIO */

    /* Sub-Header da Página (Breadcrumbs e Ações) */
    .page-subheader {
        background-color: var(--card-background-color);
        border-bottom: 1px solid var(--border-color);
        padding: 1rem 2.5rem;
    }
    .subheader-content {
        /* Ajustado para ocupar 100% da largura */
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .breadcrumbs {
        font-size: 1rem;
        font-weight: 500;
        color: var(--gray-text-color);
    }
    .breadcrumbs a {
        color: var(--primary-color);
        font-weight: 500;
    }
    .btn-primary-header {
        background-color: var(--primary-color);
        color: var(--white-color);
        padding: 0.7rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.9rem;
        transition: background-color 0.3s ease;
        white-space: nowrap;
    }
    .btn-primary-header:hover {
        background-color: #256e67;
    }

    /* Container Principal do Conteúdo */
    .challenge-detail-container {
        max-width: 900px;
        margin: 2.5rem auto;
    }

    .challenge-title-section h1 {
        font-size: 2.25rem;
        font-weight: 600;
        line-height: 1.3;
        margin-bottom: 0.5rem;
    }
    .challenge-title-section .meta-info {
        font-size: 0.9rem;
        color: var(--gray-text-color);
        margin-bottom: 2.5rem;
    }

    .challenge-section { margin-bottom: 2.5rem; }
    .challenge-section h2 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1rem;
        border-bottom: 1px solid var(--border-color);
        padding-bottom: 0.75rem;
    }
    .challenge-section p, .challenge-section li { font-size: 1rem; line-height: 1.7; color: var(--gray-text-color); }

    .requirements-list { list-style: none; padding-left: 0; }
    .requirements-list li { display: flex; align-items: flex-start; gap: 1rem; margin-bottom: 1.5rem; }
    .requirements-list .icon { flex-shrink: 0; margin-top: 5px; width: 18px; height: 18px; border: 2px solid var(--border-color); border-radius: 4px; }
    .requirements-list a { font-size: 0.85rem; color: var(--primary-color); font-weight: 500; display: block; margin-top: 0.5rem; }

    .organization-card { display: flex; align-items: center; gap: 2rem; background-color: var(--background-color); padding: 1.5rem; border-radius: 10px; }
    .organization-info { flex-grow: 1; }
    .organization-info h4 { font-size: 1.2rem; margin-bottom: 0.25rem; }
    .organization-info p { margin-bottom: 1rem; }
    .organization-info a { font-weight: 500; color: var(--primary-color); }
    .organization-logo img { width: 180px; height: 100px; object-fit: cover; border-radius: 8px; flex-shrink: 0; }

    .proposal-form .form-group { margin-bottom: 1.5rem; }
    .proposal-form label { display: block; font-weight: 500; margin-bottom: 0.5rem; }
    .proposal-form input,
    .proposal-form textarea { width: 100%; padding: 0.8rem 1rem; border: 1px solid var(--border-color); background-color: var(--background-color); border-radius: 8px; font-size: 1rem; font-family: 'Poppins', sans-serif; }
    .proposal-form textarea { min-height: 120px; resize: vertical; }
    .proposal-form .btn-submit { display: inline-block; padding: 0.8rem 2rem; border: none; background-color: var(--primary-color); color: var(--white-color); border-radius: 8px; font-weight: 600; cursor: pointer; transition: background-color 0.3s ease; }
    .proposal-form .btn-submit:hover { background-color: #256e67; }
</style>
@endpush

@section('content')
    <div class="page-subheader">
        <div class="subheader-content">
            <nav class="breadcrumbs">
                <a href="{{ route('challenges.index') }}">Desafios</a> / <span>{{ Str::limit($challenge->title, 30) }}</span>
            </nav>
            <div class="page-actions">
                <a href="{{ route('challenges.create') }}" class="btn-primary-header">Novo Desafio</a>
            </div>
        </div>
    </div>

    <div class="challenge-detail-container">
        <div class="card">
            <div class="challenge-title-section">
                <h1>{{ $challenge->title }}</h1>
                <p class="meta-info">Publicado por Innovate Solutions Inc. — Criado em {{ $challenge->created_at->translatedFormat('d \d\e F \d\e Y') }}</p>
            </div>

            <section class="challenge-section">
                <h2>Descrição do Desafio</h2>
                <p>{{ $challenge->description }}</p>
            </section>

            <section class="challenge-section">
                <h2>Requisitos</h2>
                <ul class="requirements-list">
                    <li>
                        <div class="icon"></div>
                        <div>Inovação de Materiais: As propostas devem focar em materiais biodegradáveis, compostáveis ou recicláveis que minimizem o impacto ambiental. <a href="#">Criar Resumo em Áudio</a></div>
                    </li>
                    <li>
                        <div class="icon"></div>
                        <div>Eficiência de Design: As soluções devem otimizar o tamanho e o peso da embalagem para reduzir o uso de material e os custos de transporte.</div>
                    </li>
                     <li>
                        <div class="icon"></div>
                        <div>Gestão de Fim de Vida: As propostas devem abordar a reciclabilidade, compostabilidade ou reutilização dos materiais de embalagem, promovendo os princípios da economia circular.</div>
                    </li>
                </ul>
            </section>

            <section class="challenge-section">
                <h2>Resultados Esperados</h2>
                <p>Propostas bem-sucedidas demonstrarão uma clara compreensão dos princípios de sustentabilidade e oferecerão soluções práticas e escaláveis. Esperamos resultados que incluam redução do consumo de materiais, menor pegada de carbono e maior reciclabilidade ou compostabilidade das embalagens.</p>
            </section>

            <section class="challenge-section">
                <h2>Organização Proponente</h2>
                <div class="organization-card">
                    <div class="organization-info">
                        <h4>Innovate Solutions Inc.</h4>
                        <p>Fornecedor líder de soluções sustentáveis para diversas indústrias.</p>
                        <a href="#">Ver Organização</a>
                    </div>
                    <div class="organization-logo">
                        <img src="https://via.placeholder.com/180x100.png?text=Logo+Empresa" alt="Logo da Empresa">
                    </div>
                </div>
            </section>

            <section class="challenge-section proposal-form">
                <h2>Enviar Sua Proposta</h2>
                <form action="#" method="POST">
                    @csrf
                    <div class="form-group"><label for="proposal_title">Título da Proposta</label><input type="text" id="proposal_title" name="proposal_title" placeholder="Enter"></div>
                    <div class="form-group"><label for="proposal_description">Descrição da Proposta</label><textarea id="proposal_description" name="proposal_description" placeholder="Descreva sua proposta"></textarea></div>
                    <div class="form-group"><label for="contact_email">E-mail de Contato</label><input type="email" id="contact_email" name="contact_email" placeholder="Enter"></div>
                    <button type="submit" class="btn-submit">Enviar Proposta</button>
                </form>
            </section>
        </div>
    </div>
@endsection
