@extends('layouts.app')

@section('title', 'Repositório de Conhecimento | SGC-Chapecó')

@push('styles')
<style>
    /* ESTILOS ESPECÍFICOS DA PÁGINA (Idênticos ao de Desafios/Projetos) */
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
                 <div class="custom-select"><span>Qualquer</span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708 .708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg></div>
            </div>
            <div class="filter-group">
                <label for="autores">Autores</label>
                 <div class="custom-select"><span>Todos</span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708 .708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg></div>
            </div>
             <div class="filter-group">
                <label for="data">Data de Publicação</label>
                 <div class="custom-select"><span>Qualquer</span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708 .708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg></div>
            </div>
            <button class="apply-filters-btn" disabled>Aplicar Filtros</button>
        </aside>

        <main class="content-area">
            <h1>Repositório de Conhecimento</h1>
            <p>Explore artigos, relatórios, estudos de caso e muito mais.</p>

            <div class="content-search-bar"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:20px; height:20px; color: var(--gray-text-color);"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg><input type="text" placeholder="Search"></div>

            <section class="content-section">
                <h2>Conteúdo em Destaque</h2>
                <a href="{{ route('recursos.show') }}" class="content-card">
                    <div class="card-text">
                        <span class="card-type">Artigo</span>
                        <h4>O Futuro da Inovação em Chapecó</h4>
                        <p>Explore as últimas tendências e insights que moldam o cenário da inovação em Chapecó.</p>
                    </div>
                    <img src="https://images.unsplash.com/photo-1449824913935-59a10b8d2000?w=400" alt="Cidade" class="card-image">
                </a>
            </section>

            <section class="content-section">
                <h2>Todo o Conteúdo</h2>
                <div class="resources-list">
                    <a href="{{ route('recursos.show') }}" class="content-card">
                        <div class="card-text">
                            <span class="card-type">Relatório</span>
                            <h4>Análise do Ecossistema de Startups de Chapecó</h4>
                            <p>Uma visão aprofundada do cenário de startups em Chapecó, incluindo os principais atores, desafios e oportunidades.</p>
                        </div>
                        <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=400" alt="Reunião de negócios" class="card-image">
                    </a>
                    <a href="{{ route('recursos.show') }}" class="content-card">
                        <div class="card-text">
                            <span class="card-type">Estudo de Caso</span>
                            <h4>Colaboração de Sucesso entre Universidade e Indústria</h4>
                            <p>Um estudo de caso destacando uma colaboração bem-sucedida entre uma universidade local e uma empresa, levando a soluções inovadoras.</p>
                        </div>
                        <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=400" alt="Colaboração" class="card-image">
                    </a>
                </div>
            </section>

            <nav class="pagination">
                <a href="#" class="page-link disabled">&lt;</a>
                <a href="#" class="page-link active">1</a>
                <a href="#" class="page-link">2</a>
                <a href="#" class="page-link">3</a>
                <span class="page-link disabled">...</span>
                <a href="#" class="page-link">10</a>
                <a href="#" class="page-link">&gt;</a>
            </nav>
        </main>
    </div>
@endsection
