<div>
    <style>
        /* Sub-Header da Página (Breadcrumbs e Ações) */
        .page-subheader {background-color: var(--card-background-color);border-bottom: 1px solid var(--border-color);padding: 1rem 2.5rem;}
        .subheader-content {display: flex;justify-content: space-between;align-items: center;}
        .breadcrumbs {font-size: 1rem;font-weight: 500;color: var(--gray-text-color);}
        .breadcrumbs a {color: var(--primary-color);font-weight: 500;}
        .btn-primary-header {background-color: var(--primary-color);color: var(--white-color);padding: 0.7rem 1.5rem;border-radius: 8px;font-weight: 500;font-size: 0.9rem;transition: background-color 0.3s ease;white-space: nowrap;}
        .btn-primary-header:hover {background-color: #256e67;}
        /* ESTILOS ESPECÍFICOS DA PÁGINA (Idênticos ao de Desafios) */
        .page-container {display: grid;grid-template-columns: 280px 1fr;gap: 2.5rem;padding: 2.5rem;max-width: 1600px;margin: 0 auto;}
        .filters-sidebar h3 { font-size: 1.25rem; font-weight: 600; margin-bottom: 1.5rem; }
        .filter-group { margin-bottom: 1.5rem; }
        .filter-group label { display: block; font-weight: 500; margin-bottom: 0.75rem; font-size: 1rem; }
        .custom-select { width: 100%; background-color: var(--card-background-color); border: 1px solid var(--border-color); border-radius: 8px; padding: 0.75rem 1rem; font-family: 'Poppins', sans-serif; font-size: 1rem; }
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
        .project-cover-image { width: 250px; height: 160px; object-fit: cover; border-radius: 8px; }
    </style>
    <div class="page-subheader">
        <div class="subheader-content">
            <nav class="breadcrumbs">
                <a href="{{ route('projects.index') }}">Projetos</a> / <span>Repositório de Projetos</span>
            </nav>
            <div class="page-actions">
                <a href="{{ route('projects.create') }}" class="btn-primary-header">Novo Projeto</a>
            </div>
        </div>
    </div>
    <div class="page-container">
        <aside class="filters-sidebar card">
            <h3>Filters</h3>
            <div class="filter-group">
                <label for="status">Status</label>
                <select wire:model.live="status" id="status" class="custom-select">
                    <option value="all">Todos</option>
                    <option value="Em Andamento">Em Andamento</option>
                    <option value="Concluído">Concluído</option>
                    <option value="Planejamento">Planejamento</option>
                </select>
            </div>
        </aside>

        <main class="content-area">
            <h1>Repositório de Projetos</h1>
            <p>Explore projetos, junte-se a iniciativas e colabore com o ecossistema de inovação.</p>

            <div class="content-search-bar">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Buscar por projetos...">
            </div>

            @if ($featuredProject)
            <section class="content-section">
                <h2>Projeto em Destaque</h2>
                <a href="{{ route('projects.show', $featuredProject) }}" class="content-card">
                    <div class="card-text">
                        <span class="card-type">Status: {{ $featuredProject->status }}</span>
                        <h4>{{ $featuredProject->title }}</h4>
                        <p>{{ Str::limit($featuredProject->description, 150) }}</p>
                    </div>
                    @if ($featuredProject->cover_image_path)
                        @php
                            $isFullUrl = str_starts_with($featuredProject->cover_image_path, 'http');
                        @endphp

                        <img class="project-cover-image"
                            src="{{ $isFullUrl ? $featuredProject->cover_image_path : asset('storage/' . $featuredProject->cover_image_path) }}"
                            alt="Capa do projeto {{ $featuredProject->title }}">
                    @endif
                </a>
            </section>
            @endif

            <section class="content-section">
                <h2>Todos os Projetos</h2>
                <div class="projects-list">
                    @forelse ($projects as $project)
                        <a href="{{ route('projects.show', $project) }}" class="content-card">
                            <div class="card-text">
                                <span class="card-type">Status: {{ $project->status }}</span>
                                <h4>{{ $project->title }}</h4>
                                <p>{{ Str::limit($project->description, 150) }}</p>
                            </div>
                            @if ($project->cover_image_path)
                                @php
                                    $isFullUrl = str_starts_with($project->cover_image_path, 'http');
                                @endphp

                                <img class="project-cover-image"
                                     src="{{ $isFullUrl ? $project->cover_image_path : asset('storage/' . $project->cover_image_path) }}"
                                     alt="Capa do projeto {{ $project->title }}">
                            @endif
                        </a>
                    @empty
                        <div class="card">
                            <p>Nenhum projeto encontrado para a sua busca.</p>
                        </div>
                    @endforelse
                </div>
            </section>

            @if ($projects->hasPages())
                <nav>
                    <ul class="pagination">
                        @if ($projects->onFirstPage())
                            <li class="page-item disabled" aria-disabled="true"><span class="page-link">&lt;</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $projects->previousPageUrl() }}" rel="prev">&lt;</a></li>
                        @endif

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

                        @if ($projects->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $projects->nextPageUrl() }}" rel="next">&gt;</a></li>
                        @else
                            <li class="page-item disabled" aria-disabled="true"><span class="page-link">&gt;</span></li>
                        @endif
                    </ul>
                </nav>
                <div class="pagination-results-text">
                    Mostrando {{ $projects->firstItem() }} a {{ $projects->lastItem() }} de {{ $projects->total() }} resultados
                </div>
            @endif
        </main>
    </div>
</div>
