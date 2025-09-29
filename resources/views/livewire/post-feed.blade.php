<div class="space-y-6">
    @forelse ($posts as $post)
        <div class="card post-card" wire:key="post-{{ $post->id }}">
            <div class="post-header">
                <a href="{{ route('profile.show', $post->user) }}">
                    <img src="{{ $post->user->profile_photo_url }}" alt="{{ $post->user->name }}" class="post-author-avatar">
                </a>
                <div class="post-author-info">
                    <a href="{{ route('profile.show', $post->user) }}" class="author-name hover:underline">{{ $post->user->name }}</a>
                    <p class="timestamp">{{ $post->created_at->diffForHumans() }}</p>
                </div>

                @can('delete', $post)
                    <div class="ml-auto">
                        <button wire:click="deletePost({{ $post->id }})"
                                wire:confirm="Tem a certeza que quer excluir este post?"
                                class="text-gray-400 hover:text-red-500"
                                title="Excluir post">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                @endcan
            </div>

            <div class="post-content">
                <p>{{ $post->content }}</p>
            </div>

            {{-- BLOCO DE ANEXO CORRIGIDO --}}
            @if ($post->file_path)
                <div class="mt-4 border rounded-lg p-3">
                    {{-- O erro de digitação foi corrigido aqui --}}
                    <a href="{{ asset('storage/' . $post->file_path) }}" target="_blank" class="flex items-center gap-3 hover:text-primary-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" /></svg>
                        <span class="font-semibold">Ver Anexo</span>
                    </a>
                </div>
            @endif

            <div class="comments-section">
                {{-- A key foi simplificada para evitar erros de sintaxe --}}
                @livewire('post-comments', ['post' => $post], key('comments-'.$post->id))

                {{-- A verificação agora usa a variável $community que o componente PostFeed recebe --}}
                @if(auth()->check() && auth()->user()->communities->contains($community))
                    @livewire('create-comment', ['post' => $post], key('create-comment-'.$post->id))
                @endif
            </div>
        </div>
    @empty
        <div class="card text-center text-gray-500">
            <p>Ainda não há publicações nesta comunidade. Seja o primeiro a partilhar algo!</p>
        </div>
    @endforelse
</div>
