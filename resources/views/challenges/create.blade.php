@extends('layouts.app')

@section('title', 'Criar Novo Desafio | SGC-Chapecó')

@push('styles')
<style>
    /* Estilos da sua página de formulário */
    .form-page-container { max-width: 800px; margin: 2.5rem auto; padding: 2.5rem; }
    .form-page-header h1 { font-size: 2rem; font-weight: 600; margin-bottom: 2rem; }
    .form-group { margin-bottom: 1.5rem; }
    .form-group label { display: block; font-weight: 500; margin-bottom: 0.5rem; }
    .form-group input, .form-group textarea, .form-group select { width: 100%; padding: 0.8rem 1rem; border: 1px solid var(--border-color); background-color: var(--card-background-color); border-radius: 8px; font-size: 1rem; font-family: 'Poppins', sans-serif; }
    .form-group textarea { min-height: 120px; resize: vertical; }
    .btn-submit { display: inline-block; padding: 0.8rem 2rem; border: none; background-color: var(--primary-color); color: var(--white-color); border-radius: 8px; font-weight: 600; cursor: pointer; }
    .error-message { color: #e53e3e; font-size: 0.875rem; margin-top: 0.25rem; }
</style>
@endpush

@section('content')
<div class="form-page-container">
    <div class="form-page-header">
        <h1>Criar Novo Desafio</h1>
    </div>
    <div class="card">
        <form action="{{ route('challenges.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Título do Desafio</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required>
                {{-- Exibe o erro específico para o campo 'title' --}}
                @error('title') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="type">Tipo (Ex: Inovação Aberta, Competição)</label>
                <input type="text" name="type" id="type" value="{{ old('type') }}" required>
                @error('type') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea name="description" id="description" rows="5" required>{{ old('description') }}</textarea>
                @error('description') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="organization_id">Organização Responsável</label>
                <select name="organization_id" id="organization_id" required>
                    <option value="">Selecione uma organização</option>
                    @foreach (\App\Models\Organization::all() as $organization)
                        <option value="{{ $organization->id }}">{{ $organization->name }}</option>
                    @endforeach
                </select>
                @error('organization_id') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="cover_image_path">Imagem de Capa (Opcional)</label>
                <input type="file" name="cover_image_path" id="cover_image_path">
                @error('cover_image_path') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="btn-submit">Criar Desafio</button>
        </form>
    </div>
</div>
@endsection
