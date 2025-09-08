@extends('layouts.app')

@section('title', 'Editar Projeto | SGC-Chapecó')

@push('styles')
<style>
    /* Estilos idênticos aos da página de criação */
    .page-container { max-width: 800px; margin: 2.5rem auto; padding: 2.5rem; }
    .page-header h1 { font-size: 2rem; font-weight: 600; margin-bottom: 2rem; }
    .form-group { margin-bottom: 1.5rem; }
    .form-group label { display: block; font-weight: 500; margin-bottom: 0.5rem; }
    .form-group input, .form-group textarea, .form-group select { width: 100%; padding: 0.8rem 1rem; border: 1px solid var(--border-color); background-color: var(--card-background-color); border-radius: 8px; font-size: 1rem; font-family: 'Poppins', sans-serif; }
    .form-group textarea { min-height: 120px; }
    .btn-submit { display: inline-block; padding: 0.8rem 2rem; border: none; background-color: var(--primary-color); color: var(--white-color); border-radius: 8px; font-weight: 600; cursor: pointer; }
</style>
@endpush

@section('content')
<div class="page-container">
    <div class="page-header"><h1>Editar Projeto: {{ $project->title }}</h1></div>
    <div class="card">
        <form action="{{ route('projects.update', $project) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Título do Projeto</label>
                <input type="text" id="title" name="title" value="{{ old('title', $project->title) }}" required>
            </div>
            <div class="form-group">
                <label for="description">Descrição Curta</label>
                <input type="text" id="description" name="description" value="{{ old('description', $project->description) }}" required>
            </div>
            <div class="form-group">
                <label for="objectives">Objetivos</label>
                <textarea id="objectives" name="objectives" required>{{ old('objectives', $project->objectives) }}</textarea>
            </div>
            <div class="form-group">
                <label for="cover_image_path">Nova Imagem de Capa (opcional)</label>
                <input type="file" id="cover_image_path" name="cover_image_path">
            </div>
            <button type="submit" class="btn-submit">Salvar Alterações</button>
        </form>
    </div>
</div>
@endsection
