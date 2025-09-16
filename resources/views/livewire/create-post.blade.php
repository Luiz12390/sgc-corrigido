<div class="card">
    <form wire:submit="save" class="create-post-form">
        <img src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}" class="post-author-avatar flex-shrink-0">
        <div class="flex-1">
            <textarea wire:model="content" class="w-full border rounded-lg p-3" rows="3" placeholder="No que você está a pensar, {{ auth()->user()->name }}?"></textarea>
            @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            <div class="flex justify-end mt-2">
                <button type="submit" class="btn btn-primary">Publicar</button>
            </div>
        </div>
    </form>
</div>
