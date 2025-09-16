<div class="space-y-4">
    @forelse ($comments as $comment)
        <div class="comment-item" wire:key="comment-{{ $comment->id }}">
            <a href="{{ route('profile.show', $comment->user) }}">
                <img src="{{ $comment->user->profile_photo_url }}" alt="{{ $comment->user->name }}" class="comment-avatar">
            </a>
            <div class="comment-body">
                {{-- Cabeçalho do Comentário --}}
                <div class="flex items-center justify-between">
                    <a href="{{ route('profile.show', $comment->user) }}" class="comment-author-name hover:underline">{{ $comment->user->name }}</a>

                    {{-- Botão de Excluir (só aparece para o autor) --}}
                    @can('delete', $comment)
                        <button wire:click="deleteComment({{ $comment->id }})"
                                wire:confirm="Tem a certeza que quer excluir este comentário?"
                                class="text-gray-400 hover:text-red-500"
                                title="Excluir comentário">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    @endcan
                </div>
                {{-- Conteúdo do Comentário --}}
                <p class="comment-content mt-1">{{ $comment->content }}</p>
            </div>
        </div>
    @empty
        <p class="text-xs text-gray-500 text-center pt-2">Ainda não há comentários.</p>
    @endforelse
</div>
