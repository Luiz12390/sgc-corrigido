@extends('layouts.app')

@section('title', 'Editar Recurso | SGC-Chapecó')

@push('styles')
<style>
    /* Exatamente os mesmos estilos da página de criação */
    .form-page-container { max-width: 800px; margin: 2.5rem auto; padding: 2.5rem; }
    .form-page-header h1 { font-size: 2rem; font-weight: 600; margin-bottom: 2rem; }
    .form-group { margin-bottom: 1.5rem; }
    .form-group label { display: block; font-weight: 500; margin-bottom: 0.5rem; }
    .form-group input, .form-group textarea { width: 100%; padding: 0.8rem 1rem; border: 1px solid var(--border-color); background-color: var(--card-background-color); border-radius: 8px; font-size: 1rem; font-family: 'Poppins', sans-serif; }
    .form-group textarea { min-height: 120px; resize: vertical; }
    .btn-submit { display: inline-block; padding: 0.8rem 2rem; border: none; background-color: var(--primary-color); color: var(--white-color); border-radius: 8px; font-weight: 600; cursor: pointer; transition: background-color 0.3s ease; }
    .btn-submit:hover { background-color: #256e67; }
</style>
@endpush

@section('content')
<div class="form-page-container">
    <div class="form-page-header">
        <h1>Editar Recurso</h1>
    </div>
    <div class="card">
        <form action="{{ route('recursos.update', $resource) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" name="title" id="title" value="{{ old('title', $resource->title) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea name="description" id="description" rows="5" required>{{ old('description', $resource->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="type">Tipo de Recurso</label>
                <input type="text" name="type" id="type" value="{{ old('type', $resource->type) }}">
            </div>

            <div class="form-group">
                <label for="file">Substituir Ficheiro (Opcional)</label>
                @if ($resource->file_path)
                    <p class="text-sm text-gray-500 mb-2">Ficheiro atual: {{ basename($resource->file_path) }}</p>
                @endif
                <input type="file" name="file" id="file">
                <p class="text-xs text-gray-500 mt-1">Envie um novo ficheiro apenas se quiser substituir o atual.</p>
            </div>

            <button type="submit" class="btn-submit">Salvar Alterações</button>
        </form>
    </div>
</div>
@endsection
