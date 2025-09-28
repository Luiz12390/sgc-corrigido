@extends('layouts.app')

@section('title', 'Criar Nova Organização | SGC-Chapecó')

@push('styles')
<style>
    /* Reutilizamos os mesmos estilos dos outros formulários */
    .form-page-container { max-width: 800px; margin: 2.5rem auto; padding: 2.5rem; }
    .form-page-header h1 { font-size: 2rem; font-weight: 600; margin-bottom: 2rem; }
    .form-group { margin-bottom: 1.5rem; }
    .form-group label { display: block; font-weight: 500; margin-bottom: 0.5rem; }
    .form-group input, .form-group textarea { width: 100%; padding: 0.8rem 1rem; border: 1px solid var(--border-color); background-color: var(--card-background-color); border-radius: 8px; font-size: 1rem; font-family: 'Poppins', sans-serif; }
    .form-group textarea { min-height: 120px; resize: vertical; }
    .btn-submit { display: inline-block; padding: 0.8rem 2rem; border: none; background-color: var(--primary-color); color: var(--white-color); border-radius: 8px; font-weight: 600; cursor: pointer; }
</style>
@endpush

@section('content')
<div class="form-page-container">
    <div class="form-page-header">
        <h1>Criar Nova Organização</h1>
    </div>
    <div class="card">
        <form action="{{ route('organizations.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Nome da Organização</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea name="description" id="description" rows="5" required>{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <label for="logo_path">Logo da Organização (Opcional)</label>
                <input type="file" name="logo_path" id="logo_path">
            </div>
            <hr style="margin: 2rem 0;">
            <h3 style="font-size: 1.2rem; font-weight: 600; margin-bottom: 1.5rem;">Detalhes Adicionais</h3>
            <div class="form-group">
                <label for="type">Tipo (Ex: Empresa de Tecnologia, Universidade)</label>
                <input type="text" name="type" id="type" value="{{ old('type') }}">
            </div>
            <div class="form-group">
                <label for="specialization_areas">Áreas de Especialização (separadas por vírgula)</label>
                <input type="text" name="specialization_areas" id="specialization_areas" value="{{ old('specialization_areas') }}">
            </div>
            <div class="form-group">
                <label for="competencies">Competências (separadas por vírgula)</label>
                <input type="text" name="competencies" id="competencies" value="{{ old('competencies') }}">
            </div>
            <div class="form-group">
                <label for="available_resources">Recursos Disponíveis (separadas por vírgula)</label>
                <input type="text" name="available_resources" id="available_resources" value="{{ old('available_resources') }}">
            </div>

            <button type="submit" class="btn-submit">Criar Organização</button>
        </form>
    </div>
</div>
@endsection
