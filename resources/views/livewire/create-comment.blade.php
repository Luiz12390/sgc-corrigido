<div class="comment-form">
    <img src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}" class="comment-avatar">
    <div class="flex-1">
        <form wire:submit="save">
            <textarea wire:model="content" class="w-full" rows="1" placeholder="Escreva um comentário..." @keydown.enter.prevent="save"></textarea>
            @error('content') <span class="text-red-500 text-sm block mt-1">{{ $message }}</span> @enderror
            <div class="flex justify-end mt-2">
                <button type="submit" class="btn btn-primary">Comentar</button>
            </div>
        </form>
    </div>
</div>
