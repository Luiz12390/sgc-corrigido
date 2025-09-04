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
    .pagination-results-text { text-align: center; margin-top: 1rem; font-size: 0.9rem; color: var(--gray-text-color); }
</style>
@endpush

@section('content')
    <div class="page-container">
        <aside class="filters-sidebar card">
            <h3>Filters</h3>
            {{-- Conteúdo dos filtros aqui --}}
        </aside>

        <main class="content-area">
            <h1>Repositório de Projetos</h1>
            <p>Explore projetos, junte-se a iniciativas e colabore com o ecossistema de inovação.</p>

            <div class="content-search-bar">
                <input type="text" placeholder="Buscar por projetos...">
            </div>

            <section class="content-section">
                <h2>Todos os Projetos</h2>
                <div class="projects-list">
                    @forelse ($projects as $project)
                        <a href="#" class="content-card">
                            <div class="card-text">
                                <span class="card-type">Status: {{ $project->status }}</span>
                                <h4>{{ $project->title }}</h4>
                                <p>{{ Str::limit($project->description, 150) }}</p>
                            </div>
                            <img src="{{ $project->cover_image_path }}" alt="Imagem para {{ $project->title }}" class="card-image">
                        </a>
                    @empty
                        <div class="card">
                            <p>Nenhum projeto encontrado no momento.</p>
                        </div>
                    @endforelse
                </div>
            </section>
            
            @if ($projects->hasPages())
                <nav>
                    <ul class="pagination">
                        {{-- Link da Página Anterior --}}
                        @if ($projects->onFirstPage())
                            <li class="page-item disabled" aria-disabled="true"><span class="page-link">&lt;</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $projects->previousPageUrl() }}" rel="prev">&lt;</a></li>
                        @endif

                        {{-- Elementos da Paginação --}}
                        @foreach ($projects->links()->elements as $element)
                            @if (is_string($element))
                                <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                            @endif
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $projects->currentPage())
                                        <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                                    @else
                                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach

                        {{-- Link da Próxima Página --}}
                        @if ($projects->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $projects->nextPageUrl() }}" rel="next">&gt;</a></li>
                        @else
                            <li class="page-item disabled" aria-disabled="true"><span class="page-link">&gt;</span></li>
                        @endif
                    </ul>
                </nav>
            @endif

            <div class="pagination-results-text">
                Mostrando {{ $projects->firstItem() }} a {{ $projects->lastItem() }} de {{ $projects->total() }} resultados
            </div>
        </main>
    </div>
@endsection