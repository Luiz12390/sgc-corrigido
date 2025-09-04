@extends('layouts.app')

@section('title', 'Criar Novo Desafio | SGC-Chapecó')

@push('styles')
<style>
    /* ESTILOS ESPECÍFICOS DA PÁGINA DE CRIAÇÃO */
    .page-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 2.5rem;
    }
    .page-header h1 {
        font-size: 2rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    .page-header p {
        font-size: 1rem;
        color: var(--gray-text-color);
        margin-bottom: 2rem;
    }
    .form-group {
        margin-bottom: 1.5rem;
    }
    .form-group label {
        display: block;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }
    .form-group input,
    .form-group textarea,
    .form-group select {
        width: 100%;
        padding: 0.8rem 1rem;
        border: 1px solid var(--border-color);
        background-color: var(--card-background-color);
        border-radius: 8px;
        font-size: 1rem;
        font-family: 'Poppins', sans-serif;
    }
    .form-group textarea {
        min-height: 150px;
        resize: vertical;
    }
    .btn-submit {
        display: inline-block;
        padding: 0.8rem 2rem;
        border: none;
        background-color: var(--primary-color);
        color: var(--white-color);
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .btn-submit:hover {
        background-color: #256e67;
    }
</style>
@endpush

@section('content')
<div class="page-container">
    <div class="page-header">
        <h1>Criar Novo Desafio</h1>
        <p>Preencha as informações abaixo para publicar um novo desafio na plataforma.</p>
    </div>

    <div class="card">
        <form action="{{ route('challenges.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Título do Desafio</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required>
                @error('title') <span style="color: #e53e3e; font-size: 0.8rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="type">Tipo</label>
                <select id="type" name="type">
                    <option value="Desafio Aberto" {{ old('type') == 'Desafio Aberto' ? 'selected' : '' }}>Desafio Aberto</option>
                    <option value="Artigo" {{ old('type') == 'Artigo' ? 'selected' : '' }}>Artigo</option>
                    <option value="Relatório" {{ old('type') == 'Relatório' ? 'selected' : '' }}>Relatório</option>
                    <option value="Estudo de Caso" {{ old('type') == 'Estudo de Caso' ? 'selected' : '' }}>Estudo de Caso</option>
                </select>
                @error('type') <span style="color: #e53e3e; font-size: 0.8rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea id="description" name="description" required>{{ old('description') }}</textarea>
                @error('description') <span style="color: #e53e3e; font-size: 0.8rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="cover_image_path">Imagem de Capa</label>
                <input type="file" id="cover_image_path" name="cover_image_path">
                @error('cover_image_path') <span style="color: #e53e3e; font-size: 0.8rem;">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn-submit">Publicar Desafio</button>
        </form>
    </div>
</div>
@endsection
