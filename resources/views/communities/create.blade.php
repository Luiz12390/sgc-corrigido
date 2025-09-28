@extends('layouts.app')

@section('title', 'Criar Nova Comunidade | SGC-Chapecó')

@push('styles')
<style>
    /* Estilos específicos para a página de formulário, seguindo o seu padrão */
    .form-page-container { max-width: 800px; margin: 2.5rem auto; padding: 2.5rem; }
    .form-page-header h1 { font-size: 2rem; font-weight: 600; margin-bottom: 2rem; }
    .form-group { margin-bottom: 1.5rem; }
    .form-group label { display: block; font-weight: 500; margin-bottom: 0.5rem; }
    .form-group input, .form-group textarea { width: 100%; padding: 0.8rem 1rem; border: 1px solid var(--border-color); background-color: var(--card-background-color); border-radius: 8px; font-size: 1rem; font-family: 'Poppins', sans-serif; }
    .form-group textarea { min-height: 120px; resize: vertical; }
    .btn-submit { display: inline-block; padding: 0.8rem 2rem; border: none; background-color: var(--primary-color); color: var(--white-color); border-radius: 8px; font-weight: 600; cursor: pointer; transition: background-color 0.3s ease; }
    .btn-submit:hover { background-color: #256e67; }
    .text-red-500 { color: #ef4444; }
    .text-sm { font-size: 0.875rem; }
</style>
@endpush

@section('content')
<div class="form-page-container">
    <div class="form-page-header">
        <h1>Criar Nova Comunidade</h1>
    </div>
    <div class="card">
        <form action="{{ route('communities.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Nome da Comunidade</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required>
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea name="description" id="description" rows="5" required>{{ old('description') }}</textarea>
                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="logo_path">Logo da Comunidade (Opcional)</label>
                <input type="file" name="logo_path" id="logo_path">
                @error('logo_path') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn-submit">Criar Comunidade</button>
        </form>
    </div>
</div>
@endsection
