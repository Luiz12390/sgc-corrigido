<div>
    {{-- É importante ter um <div> raiz envolvendo todo o componente Livewire --}}

    <style>
        /* ESTILOS ESPECÍFICOS DA PÁGINA (agora dentro do componente) */
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
        .custom-select { width: 100%; background-color: var(--card-background-color); border: 1px solid var(--border-color); border-radius: 8px; padding: 0.75rem 1rem; font-family: 'Poppins', sans-serif; font-size: 1rem; }
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
    </style>

    <div class="page-container">
        <aside class="filters-sidebar card">
            <h3>Filters</h3>
            <div class="filter-group">
                <label for="status">Status</label>
                <select wire:model.live="status" id="status" class="custom-select">
                    <option value="all">Todos</option>
                    <option value="Desafio Aberto">Desafio Aberto</option>
                    <option value="Relatório">Relatórios</option>
                    <option value="Artigo">Artigos</option>
                    <option value="Estudo de Caso">Estudo de Caso</option>
                </select>
            </div>
            {{-- Outros filtros podem ser adicionados da mesma forma --}}
            <button class="apply-filters-btn" disabled>Aplicar Filtros</button>
        </aside>

        <main class="content-area">
            <h1>Repositório de Desafios</h1>
            <p>Explore desafios, proponha soluções e colabore com o ecossistema de inovação.</p>

            <div class="content-search-bar">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:20px; height:20px; color: var(--gray-text-color);"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Buscar por desafios...">
            </div>

            @if ($featuredChallenge)
            <section class="content-section">
                <h2>Desafio em Destaque</h2>
                <a href="#" class="content-card">
                    <div class="card-text">
                        <span class="card-type">{{ $featuredChallenge->type }}</span>
                        <h4>{{ $featuredChallenge->title }}</h4>
                        <p>{{ Str::limit($featuredChallenge->description, 150) }}</p>
                    </div>
                    <img src="{{ $featuredChallenge->cover_image_path }}" alt="Imagem para {{ $featuredChallenge->title }}" class="card-image">
                </a>
            </section>
            @endif

            <section class="content-section">
                <h2>Todos os Desafios</h2>
                <div class="challenges-list">
                    @forelse ($challenges as $challenge)
                        <a href="#" class="content-card">
                            <div class="card-text">
                                <span class="card-type">{{ $challenge->type }}</span>
                                <h4>{{ $challenge->title }}</h4>
                                <p>{{ Str::limit($challenge->description, 150) }}</p>
                            </div>
                            <img src="{{ $challenge->cover_image_path }}" alt="Imagem para {{ $challenge->title }}" class="card-image">
                        </a>
                    @empty
                        <div class="card">
                            <p>Nenhum desafio encontrado para a sua busca.</p>
                        </div>
                    @endforelse
                </div>
            </section>

            <div>
                {{ $challenges->links() }}
            </div>
        </main>
    </div>
</div>
