<div>
    <div class="community-banner"></div>
    <div class="community-page-container">
        <header class="community-header">
            <img src="{{ $community->logo_url }}" alt="Logo de {{ $community->name }}" class="community-header-avatar">
            <div class="community-header-info">
                <h1>{{ $community->name }}</h1>
                <p>{{ $community->description }}</p>
            </div>
            <div class="community-header-actions">
                @auth
                    @can('update', $community)
                        <a href="#" class="btn btn-primary">Editar Comunidade</a>
                        <a href="{{ route('communities.manageMembers', $community) }}" class="btn btn-secondary">Gerir Membros</a>
                    @else
                        <livewire:request-to-join-community-button :community="$community" />
                    @endcan
                @else
                    <livewire:request-to-join-community-button :community="$community" />
                @endauth
            </div>
        </header>

        <div class="community-nav-tabs">
            <button wire:click="setTab('feed')" class="tab-button {{ $tab === 'feed' ? 'active' : '' }}">Feed</button>
            <button wire:click="setTab('sobre')" class="tab-button {{ $tab === 'sobre' ? 'active' : '' }}">Sobre</button>
            <button wire:click="setTab('membros')" class="tab-button {{ $tab === 'membros' ? 'active' : '' }}">Membros</button>
        </div>

        <div>
            @if ($tab === 'feed')
                <div class="community-content-grid">
                    <main class="feed-column">
                        @if(auth()->check() && auth()->user()->communities->contains($community))
                            @livewire('create-post', ['community' => $community])
                        @endif
                        @livewire('post-feed', ['community' => $community])
                    </main>
                    <aside class="sidebar-column">
                        <div class="card">
                            <h3 class="card-title">Sobre esta Comunidade</h3>
                            <div class="meta-info space-y-2">
                                <p>Criada em {{ $community->created_at->format('d/m/Y') }}</p>
                                @if ($community->user)
                                    <p>Por <a href="{{ route('profile.show', $community->user) }}">{{ $community->user->name }}</a></p>
                                @endif
                            </div>
                        </div>
                        <div class="card">
                            <h3 class="card-title">Membros ({{ $community->members->count() }})</h3>
                            @if ($community->members->isNotEmpty())
                                <div class="members-list-sidebar">
                                    @foreach($community->members->take(14) as $member)
                                        <a href="{{ route('profile.show', $member) }}" title="{{ $member->name }}">
                                            <img src="{{ $member->profile_photo_url }}" alt="Foto de {{ $member->name }}" class="member-avatar-sidebar">
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </aside>
                </div>
            @elseif ($tab === 'sobre')
                <div class="card">
                    <h2 class="card-title">Sobre a Comunidade</h2>
                    <p>{{ $community->description }}</p>
                </div>
            @elseif ($tab === 'membros')
                <div class="members-grid-tab">
                    @foreach ($community->members as $member)
                        <a href="{{ route('profile.show', $member) }}" class="member-card-tab">
                            <img src="{{ $member->profile_photo_url }}" alt="Foto de {{ $member->name }}">
                            <h4>{{ $member->name }}</h4>
                            <p>{{ $member->title }}</p>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
