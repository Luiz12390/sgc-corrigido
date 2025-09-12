<div
    x-data="{ open: false }"
    @open-search-modal.window="open = true"
    @keydown.escape.window="open = false"
    x-show="open"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    style="display: none;"
    class="search-modal-container"
    wire:key="global-search-modal"
    wire:ignore.self
>
    <div class="search-modal-overlay" @click="open = false"></div>

    <div class="search-modal-content" @click.stop>
        <div class="search-modal-input-wrapper">
            <svg class="search-modal-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
            <input
                type="text"
                wire:model.live.debounce.300ms="term"
                class="search-modal-input"
                placeholder="Pesquisar em toda a plataforma..."
                autofocus
            >
        </div>

        <div class="search-modal-results">
            @if (strlen($term) < 2)
                <p class="text-gray-500 p-4">Digite pelo menos 2 caracteres para pesquisar.</p>
            @else
                @if (empty($results) || (empty($results['Projetos']) && empty($results['Organizações']) && empty($results['Utilizadores'])))
                    <p class="text-gray-500 p-4">Nenhum resultado encontrado para "{{ $term }}".</p>
                @else
                    @foreach ($results as $type => $models)
                        @if ($models->isNotEmpty())
                            <h3>{{ $type }}</h3>
                            <ul>
                                @foreach ($models as $model)
                                    <li class="search-result-item">
                                        @php
                                            $routeName = '';
                                            if ($type === 'Projetos') $routeName = 'projects.show';
                                            if ($type === 'Organizações') $routeName = 'organizations.show';
                                            if ($type === 'Utilizadores') $routeName = 'profile.show';
                                        @endphp

                                        @if ($routeName)
                                            <a href="{{ route($routeName, $model) }}">
                                                <p class="result-title">{{ $model->name ?? $model->title }}</p>
                                                <p class="result-description">{{ Str::limit($model->description ?? $model->title, 70) }}</p>
                                            </a>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    @endforeach
                @endif
            @endif
        </div>
    </div>

</div>
