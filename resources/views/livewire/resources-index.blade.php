<style>
    /* Usamos uma classe "mãe" para garantir que estes estilos só se aplicam nesta página */
    .resources-index-page .page-container { display: grid; grid-template-columns: 280px 1fr; gap: 2.5rem; padding: 2.5rem; max-width: 1600px; margin: 0 auto; }
    .resources-index-page .filters-sidebar h3 { font-size: 1.25rem; font-weight: 600; margin-bottom: 1.5rem; }
    .resources-index-page .filter-group { margin-bottom: 1.5rem; }
    .resources-index-page .filter-group label { display: block; font-weight: 500; margin-bottom: 0.75rem; font-size: 1rem; }
    .resources-index-page .custom-select { width: 100%; background-color: var(--card-background-color); border: 1px solid var(--border-color); border-radius: 8px; padding: 0.75rem 1rem; }
    .resources-index-page .content-area h1 { font-size: 2rem; font-weight: 600; }
    .resources-index-page .content-area > p { font-size: 1rem; color: var(--gray-text-color); margin-top: 0.5rem; margin-bottom: 2rem; }
    .resources-index-page .content-search-bar { display: flex; align-items: center; background-color: var(--card-background-color); border: 1px solid var(--border-color); padding: 0.75rem 1.25rem; border-radius: 8px; margin-bottom: 2.5rem; }
    .resources-index-page .content-search-bar input { border: none; background: none; outline: none; margin-left: 0.75rem; width: 100%; font-size: 1rem; }
    .resources-index-page .content-card { display: flex; gap: 1.5rem; background-color: var(--card-background-color); border: 1px solid var(--border-color); border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem; transition: box-shadow 0.3s ease, transform 0.3s ease; }
    .resources-index-page .content-card:hover { box-shadow: 0 8px 25px rgba(0,0,0,0.08); transform: translateY(-3px); }
    .resources-index-page .card-text { flex-grow: 1; }
    .resources-index-page .card-text .card-type { font-size: 0.85rem; font-weight: 500; color: var(--gray-text-color); margin-bottom: 0.5rem; display: block; }
    .resources-index-page .card-text h4 { font-size: 1.2rem; font-weight: 600; margin-bottom: 0.5rem; color: var(--primary-color); }
    .resources-index-page .card-text p { font-size: 0.95rem; line-height: 1.6; color: var(--gray-text-color); }
    .resources-index-page .card-image { width: 220px; height: 140px; object-fit: cover; border-radius: 8px; flex-shrink: 0; }
</style>

<div class="resources-index-page">
    <div class="page-container">
        <aside class="filters-sidebar card">
            <h3>Filtros</h3>
            <p class="text-gray-500">Filtros em breve.</p>
        </aside>

        <main class="content-area">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h1>Repositório de Conhecimento</h1>
                    <p>Explore artigos, relatórios, estudos de caso e muito mais.</p>
                </div>
                <a href="{{ route('recursos.create') }}" class="btn btn-primary">Adicionar Recurso</a>
            </div>

            @if (session('status'))
                <div class="alert alert-success mb-6">{{ session('status') }}</div>
            @endif

            <div class="resources-list">
                @forelse ($resources as $resource)
                    <a href="{{ route('recursos.show', $resource) }}" class="content-card">
                        <div class="card-text">
                            <span class="card-type">{{ $resource->type ?? 'Recurso' }}</span>
                            <h4>{{ $resource->title }}</h4>
                            <p>{{ Str::limit($resource->description, 150) }}</p>
                        </div>
                        <img src="{{ $resource->cover_image_url }}" alt="Imagem de {{ $resource->title }}" class="card-image">
                    </a>
                @empty
                    <div class="card">
                        <p>Nenhum recurso encontrado.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $resources->links() }}
            </div>
        </main>
    </div>
</div>
