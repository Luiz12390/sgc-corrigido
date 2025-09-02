@extends('layouts.app')

@section('title', 'Membros do Projeto | SGC-Chapecó')

@push('styles')
<style>
    /* ESTILOS ESPECÍFICOS DA PÁGINA DE MEMBROS */
    .page-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2.5rem;
    }
    .page-header {
        margin-bottom: 2.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid var(--border-color);
    }
    .page-header h1 {
        font-size: 2rem;
        font-weight: 600;
    }
    .page-header p {
        font-size: 1rem;
        color: var(--gray-text-color);
    }

    .members-grid {
        display: grid;
        /* Grid responsivo: ajusta o número de colunas conforme o espaço */
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 2rem;
    }

    .member-card {
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .member-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }
    .member-card .member-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        margin: 0 auto 1rem auto;
        border: 4px solid var(--white-color);
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .member-card h4 {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }
    .member-card p {
        font-size: 0.9rem;
        color: var(--gray-text-color);
    }
</style>
@endpush

@section('content')
<div class="page-container">
    <div class="page-header">
        <h1>Equipe do Projeto: Soluções de Embalagens Sustentáveis</h1>
        <p>Conheça os membros que estão colaborando nesta iniciativa.</p>
    </div>

    <div class="members-grid">
        <a href="#" class="member-card card">
            <img src="https://i.pravatar.cc/150?u=carlos_silva" alt="Foto de Dr. Carlos Silva" class="member-avatar">
            <h4>Dr. Carlos Silva</h4>
            <p>Líder do Projeto</p>
        </a>

        <a href="#" class="member-card card">
            <img src="https://i.pravatar.cc/150?u=ana_souza" alt="Foto de Ana Souza" class="member-avatar">
            <h4>Ana Souza</h4>
            <p>Designer de Produto</p>
        </a>

        <a href="#" class="member-card card">
            <img src="https://i.pravatar.cc/150?u=lucas_mendes" alt="Foto de Lucas Mendes" class="member-avatar">
            <h4>Lucas Mendes</h4>
            <p>Analista de Mercado</p>
        </a>

        <a href="#" class="member-card card">
            <img src="https://i.pravatar.cc/150?u=isabela_costa" alt="Foto de Isabela Costa" class="member-avatar">
            <h4>Isabela Costa</h4>
            <p>Engenheira de Materiais</p>
        </a>

        </div>
</div>
@endsection
