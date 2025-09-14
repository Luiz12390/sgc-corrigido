@extends('layouts.app')

@section('title', $resource->title)

@push('styles')
<style>
    .resource-show-page .page-container { display: grid; grid-template-columns: 2.5fr 1fr; gap: 2.5rem; max-width: 1600px; margin: 0 auto; padding: 2.5rem; }
    .resource-show-page .pdf-viewer-card { padding: 0; overflow: hidden; }
    .resource-show-page .pdf-viewer-header { background-color: #333; color: white; padding: 0.75rem 1.5rem; font-size: 0.9rem; }
    .resource-show-page .pdf-viewer-body { height: 100vh; }
    .resource-show-page .pdf-viewer-body embed { width: 100%; height: 100%; }
    .resource-show-page .resource-sidebar { display: flex; flex-direction: column; gap: 1.5rem; }
    .resource-show-page .sidebar-card h3 { font-size: 1.25rem; font-weight: 600; margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px solid var(--border-color); }
    .resource-show-page .actions-buttons { display: flex; flex-direction: column; gap: 1rem; }
    .resource-show-page .btn { display: block; width: 100%; text-align: center; }
    .resource-show-page .resource-details-list { list-style: none; }
    .resource-show-page .resource-details-list li { margin-bottom: 1rem; font-size: 0.95rem; }
    .resource-show-page .resource-details-list li strong { display: block; color: #555; font-weight: 500; font-size: 0.85rem; text-transform: uppercase; }
    .resource-show-page .resource-summary p { font-size: 0.95rem; line-height: 1.6; color: var(--gray-text-color); }
</style>
@endpush

@section('content')
<div class="resource-show-page"> {{-- Classe "mãe" para isolar o CSS --}}
    <div class="page-container">
        <main class="pdf-viewer-area">
            <div class="card pdf-viewer-card">
                <div class="pdf-viewer-header">
                    <span>{{ $resource->title }}</span>
                </div>
                <div class="pdf-viewer-body">
                    {{-- A tag <embed> usa o accessor file_url para obter o link do ficheiro --}}
                    <embed src="{{ $resource->file_url }}" type="application/pdf" />
                </div>
            </div>
        </main>

        <aside class="resource-sidebar">
            <div class="card sidebar-card">
                <h3>Ações</h3>
                <div class="actions-buttons">
                    <a href="{{ $resource->file_url }}" target="_blank" class="btn btn-primary">Descarregar Ficheiro</a>
                    @can('update', $resource)
                        <a href="{{ route('recursos.edit', $resource) }}" class="btn btn-secondary">Editar</a>
                    @endcan
                    @can('delete', $resource)
                        <form action="{{ route('recursos.destroy', $resource) }}" method="POST" onsubmit="return confirm('Tem a certeza?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-full">Excluir</button> {{-- Adicione a classe .btn-danger no seu app.css --}}
                        </form>
                    @endcan
                </div>
            </div>

            <div class="card sidebar-card">
                <h3>Detalhes do Recurso</h3>
                <ul class="resource-details-list">
                    <li><strong>Título</strong> {{ $resource->title }}</li>
                    <li>
                        <strong>Autor</strong>
                        <a href="{{ route('profile.show', $resource->user) }}" class="text-primary-500 hover:underline">{{ $resource->user->name }}</a>
                    </li>
                    <li><strong>Data de Publicação</strong> {{ $resource->created_at->format('d/m/Y') }}</li>
                    @if ($resource->type)
                        <li><strong>Categoria</strong> {{ $resource->type }}</li>
                    @endif
                </ul>
            </div>

            <div class="card sidebar-card resource-summary">
                <h3>Resumo</h3>
                <p>{{ $resource->description }}</p>
            </div>
        </aside>
    </div>
</div>
@endsection
