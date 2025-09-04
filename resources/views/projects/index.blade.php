@extends('layouts.app')

@section('title', 'Projetos | SGC-Chapecó')

@push('styles')
<style>
    /* ESTILOS ESPECÍFICOS DA PÁGINA (Idênticos ao de Desafios) */
    .page-container {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 2.5rem;
        padding: 2.5rem;
        max-width: 1600px;
        margin: 0 auto;
    }
    .filters-sidebar h3 { font-size: 1.25rem; font-weight: 600; margin-bottom: 1.5rem; }
    .filter-group { margin-bottom: 1.5rem; }
    .filter-group label { display: block; font-weight: 500; margin-bottom: 0.75rem; font-size: 1rem; }
    .custom-select { background-color: var(--card-background-color); border: 1px solid var(--border-color); border-radius: 8px; padding: 0.75rem 1rem; display: flex; justify-content: space-between; align-items: center; cursor: pointer; }
    .apply-filters-btn { width: 100%; padding: 0.8rem; border: none; background-color: #e9ecef; color: #adb5bd; border-radius: 8px; font-weight: 600; font-size: 1rem; cursor: not-allowed; margin-top: 1rem; }
    .content-area h1 { font-size: 2rem; font-weight: 600; }
    .content-area > p { font-size: 1rem; color: var(--gray-text-color); margin-top: 0.5rem; margin-bottom: 2rem; }
    .content-search-bar { display: flex; align-items: center; background-color: var(--card-background-color); border: 1px solid var(--border-color); padding: 0.75rem 1.25rem; border-radius: 8px; margin-bottom: 2.5rem; }
    .content-search-bar input { border: none; background: none; outline: none; margin-left: 0.75rem; width: 100%; font-size: 1rem; font-family: 'Poppins', sans-serif; }
    .content-card { display: flex; gap: 1.5rem; background-color: var(--card-background-color); border: 1px solid var(--border-color); border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem; transition: box-shadow 0.3s ease, transform 0.3s ease; }
    .content-card:hover { box-shadow: 0 8px 25px rgba(0,0,0,0.08); transform: translateY(-3px); }
    .card-text { flex-grow: 1; }
    .card-text .card-type { font-size: 0.85rem; font-weight: 500; color: var(--gray-text-color); margin-bottom: 0.5rem; display: block; }
    .card-text h4 { font-size: 1.2rem; font-weight: 600; margin-bottom: 0.5rem; color: var(--primary-color); }
    .card-text p { font-size: 0.95rem; line-height: 1.6; color: var(--gray-text-color); }
    .card-image { width: 220px; height: 140px; object-fit: cover; border-radius: 8px; flex-shrink: 0; }
    .pagination { display: flex; justify-content: center; align-items: center; gap: 0.5rem; margin-top: 3rem; }
    .page-link { display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 8px; border: 1px solid var(--border-color); background-color: var(--card-background-color); font-weight: 500; transition: all 0.3s ease; }
    .page-link:hover { border-color: var(--primary-color); color: var(--primary-color); }
    .page-link.active { background-color: var(--primary-color); color: var(--white-color); border-color: var(--primary-color); }
    .page-link.disabled { color: #ccc; cursor: default; }
</style>
@endpush

@section('content')
    <div class="page-container">
        <aside class="filters-sidebar card">
            <h3>Filters</h3>
            <div class="filter-group">
                <label for="category">Categoria</label>
                <div class="custom-select"><span>Todas</span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708 .708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg></div>
            </div>
            <div class="filter-group">
                <label for="tags">Tags</label>
                 <div class="custom-select"><span>Qualquer</span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg></div>
            </div>
            <div class="filter-group">
                <label for="status">Status</label>
                 <div class="custom-select"><span>Em Andamento</span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg></div>
            </div>
            <button class="apply-filters-btn" disabled>Aplicar Filtros</button>
        </aside>

        <main class="content-area">
            <h1>Repositório de Projetos</h1>
            <p>Explore projetos, junte-se a iniciativas e colabore com o ecossistema de inovação.</p>

            <div class="content-search-bar"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:20px; height:20px; color: var(--gray-text-color);"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg><input type="text" placeholder="Buscar por projetos..."></div>

            <section class="content-section">
                <h2>Projeto em Destaque</h2>
                <a href="{{ route('projects.show') }}" class="content-card">
                    <div class="card-text">
                        <span class="card-type">Projeto de P&D</span>
                        <h4>Desenvolvinto de App de Mobilidade Urbana</h4>
                        <p>Um projeto colaborativo para criar um aplicativo que otimiza o transporte público em Chapecó.</p>
                    </div>
                    <img src="https://images.unsplash.com/photo-1570125910385-033512938886?w=400" alt="Mobilidade Urbana" class="card-image">
                </a>
            </section>

            <section class="content-section">
                <h2>Todos os Projetos</h2>
                <div class="projects-list">
                    <a href="#" class="content-card">
                        <div class="card-text">
                            <span class="card-type">Iniciativa Comunitária</span>
                            <h4>Hortas Urbanas Comunitárias</h4>
                            <p>Implementação de hortas em espaços públicos para promover a segurança alimentar e a integração da comunidade.</p>
                        </div>
                        <img src="https://images.unsplash.com/photo-1597362924946-88c27187e078?w=400" alt="Horta Urbana" class="card-image">
                    </a>
                    <a href="#" class="content-card">
                        <div class="card-text">
                            <span class="card-type">Projeto de Software</span>
                            <h4>Plataforma de Gestão para ONGs</h4>
                            <p>Desenvolvimento de uma plataforma de código aberto para ajudar organizações não-governamentais na gestão de seus recursos.</p>
                        </div>
                        <img src="https://images.unsplash.com/photo-1516321497487-e288fb19713f?w=400" alt="Gestão" class="card-image">
                    </a>
                </div>
            </section>

            <nav class="pagination">
                <a href="#" class="page-link disabled">&lt;</a>
                <a href="#" class="page-link active">1</a>
                <a href="#" class="page-link">2</a>
                <a href="#" class="page-link">3</a>
                <span class="page-link disabled">...</span>
                <a href="#" class="page-link">8</a>
                <a href="#" class="page-link">&gt;</a>
            </nav>
        </main>
    </div>
@endsection
