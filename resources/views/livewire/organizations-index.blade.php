<div>
    <div class="page-container">
        <div class="page-header">
            <h1>Organizações</h1>
            <p>Explore, conecte-se e colabore com as organizações do nosso ecossistema.</p>
        </div>

        <div class="page-search-bar">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-400">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Procurar por nome ou descrição...">
        </div>

        <div class="grid-container">
            @forelse ($organizations as $organization)
                <a href="{{ route('organizations.show', $organization) }}" class="org-card">
                    <div class="card-header-logo">
                        <img src="{{ $organization->logo_url }}" alt="Logo de {{ $organization->name }}" class="logo-img">
                        <h4>{{ $organization->name }}</h4>
                        <p>{{ $organization->type ?? 'Organização' }}</p>
                    </div>
                    <div class="card-body">
                        <p>{{ Str::limit($organization->description, 150) }}</p>
                    </div>
                </a>
            @empty
                <div class="card">
                    <p>Nenhuma organização encontrada para a sua busca.</p>
                </div>
            @endforelse
        </div>

        <div class="pagination-container">
            {{ $organizations->links() }}
        </div>
    </div>
</div>
