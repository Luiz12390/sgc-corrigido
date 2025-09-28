<div class="community-index-container">
    <div class="index-page-header">
        <h1>Comunidades</h1>
        <p>Encontre grupos, participe em discussões e colabore com pessoas com os mesmos interesses.</p>
    </div>

    <div class="page-search-bar">
        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Procurar por comunidades...">
    </div>

    <div class="space-y-6">
        @forelse ($communities as $community)
            <a href="{{ route('communities.show', $community) }}" class="community-list-item">
                <img src="{{ $community->logo_url }}" alt="Logo de {{ $community->name }}" class="community-list-logo">
                <div class="community-list-content">
                    <h4>{{ $community->name }}</h4>
                    <p>{{ Str::limit($community->description, 200) }}</p>

                    <div class="community-list-meta">
                        <div class="meta-item">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                            <span>{{ $community->members->count() }} {{ Str::plural('membro', $community->members->count()) }}</span>
                        </div>
                        <div class="meta-item">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                            <span>{{ $community->posts->count() }} {{ Str::plural('publicação', $community->posts->count()) }}</span>
                        </div>
                    </div>
                </div>
            </a>
        @empty
            <div class="card text-center py-12">
                <p>Nenhuma comunidade encontrada.</p>
            </div>
        @endforelse
    </div>

    <div class="pagination-container mt-12">
        {{ $communities->links() }}
    </div>
</div>
