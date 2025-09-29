    <div class="card" x-data="{ isUploading: false, progress: 0 }"
     x-on:livewire-upload-start="isUploading = true"
     x-on:livewire-upload-finish="isUploading = false"
     x-on:livewire-upload-error="isUploading = false"
     x-on:livewire-upload-progress="progress = $event.detail.progress">

    <form wire:submit="save" class="create-post-form">
        <img src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}" class="post-author-avatar flex-shrink-0">
        <div class="flex-1">
            <textarea wire:model="content" class="w-full border-0 focus:ring-0 p-0" rows="3" placeholder="No que você está a pensar, {{ auth()->user()->name }}?"></textarea>

            <div class="mt-2 space-y-2">
                @if ($files)
                    <div class="p-2 border rounded-lg text-sm">
                        <p class="font-semibold mb-1">Ficheiro(s) selecionado(s):</p>
                        <ul>
                            @foreach ($files as $file)
                                <li class="text-xs text-gray-500 flex justify-between items-center">
                                    <span>- {{ $file->getClientOriginalName() }}</span>
                                    <button type="button" wire:click="removeUpload('files', '{{ $file->getFilename() }}')" class="text-red-500 hover:text-red-700 font-bold">&times;</button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div x-show="isUploading" class="w-full bg-gray-200 rounded-full h-2.5">
                    <div class="bg-primary-500 h-2.5 rounded-full" :style="`width: ${progress}%`"></div>
                </div>
            </div>

            @error('content') <span class="text-red-500 text-sm block mt-1">{{ $message }}</span> @enderror
            @error('files.*') <span class="text-red-500 text-sm block mt-1">{{ $message }}</span> @enderror

            <div class="create-post-actions">
                <div class="action-buttons-group">
                    <label for="file-upload-{{ $this->getId() }}" class="action-button" title="Anexar ficheiro(s)">
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.122 2.122l7.81-7.81" /></svg>
                    </label>
                    <input type="file" wire:model="files" id="file-upload-{{ $this->getId() }}" class="hidden" multiple>
                </div>
                <button type="submit" class="btn btn-primary">Publicar</button>
            </div>
        </div>
    </form>
</div>
