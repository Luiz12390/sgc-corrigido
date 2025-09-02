@extends('layouts.app')

@section('title', 'Membros da Organização | SGC-Chapecó')

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
        <h1>Membros da Tech Innovate Solutions</h1>
        <p>Conheça a equipe que impulsiona a inovação.</p>
    </div>

    <div class="members-grid">
        <a href="{{ route('profile') }}" class="member-card card">
            <img src="https://i.pravatar.cc/150?u=joao_silva" alt="Foto de João Silva" class="member-avatar">
            <h4>João Silva</h4>
            <p>CEO & Fundador</p>
        </a>

        <a href="#" class="member-card card">
            <img src="https://i.pravatar.cc/150?u=amelia" alt="Foto de Dr. Amelia Silva" class="member-avatar">
            <h4>Dr. Amelia Silva</h4>
            <p>Pesquisadora Chefe</p>
        </a>

        <a href="#" class="member-card card">
            <img src="https://i.pravatar.cc/150?u=ethan" alt="Foto de Ethan Bennett" class="member-avatar">
            <h4>Ethan Bennett</h4>
            <p>Desenvolvedor de IA</p>
        </a>

        <a href="#" class="member-card card">
            <img src="https://i.pravatar.cc/150?u=olivia" alt="Foto de Olivia Carter" class="member-avatar">
            <h4>Olivia Carter</h4>
            <p>Gerente de Projetos</p>
        </a>

        <a href="#" class="member-card card">
            <img src="https://i.pravatar.cc/150?u=member1" alt="Foto de Carlos Pereira" class="member-avatar">
            <h4>Carlos Pereira</h4>
            <p>Engenheiro de Software</p>
        </a>

        <a href="#" class="member-card card">
            <img src="https://i.pravatar.cc/150?u=member2" alt="Foto de Sofia Rossi" class="member-avatar">
            <h4>Sofia Rossi</h4>
            <p>Designer UX/UI</p>
        </a>

        </div>
</div>
@endsection
