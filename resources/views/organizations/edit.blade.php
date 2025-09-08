@extends('layouts.app')

@section('title', 'Editar ' . $organization->name . ' | SGC-Chapecó')

@push('styles')
<style>
    /* Reutilizamos os mesmos estilos da página de edição de perfil */
    .page-container { max-width: 800px; margin: 0 auto; padding: 2.5rem; }
    .page-header h1 { font-size: 2rem; font-weight: 600; margin-bottom: 2rem; }
    .form-group { margin-bottom: 1.5rem; }
    .form-group label { display: block; font-weight: 500; margin-bottom: 0.5rem; }
    .form-group input, .form-group textarea { width: 100%; padding: 0.8rem 1rem; border: 1px solid var(--border-color); background-color: var(--card-background-color); border-radius: 8px; font-size: 1rem; font-family: 'Poppins', sans-serif; }
    .form-group textarea { min-height: 120px; resize: vertical; }
    .btn-submit { display: inline-block; padding: 0.8rem 2rem; border: none; background-color: var(--primary-color); color: var(--white-color); border-radius: 8px; font-weight: 600; cursor: pointer; transition: background-color: 0.3s ease; }
    .photo-upload-container { display: flex; align-items: center; gap: 1.5rem; }
    .photo-preview { width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 3px solid var(--border-color); }
    .btn-secondary { background-color: var(--card-background-color); color: var(--primary-color); border: 1px solid var(--border-color); padding: 0.6rem 1.2rem; }
</style>
@endpush

@section('content')
<div class="page-container">
    <div class="page-header"><h1>Editar Organização</h1></div>

    <div class="card">
        <form method="POST" action="{{ route('organizations.update', $organization) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            {{-- Upload do Logo --}}
            <div class="form-group">
                <label>Logo da Organização</label>
                <div class="photo-upload-container">
                    <img id="photo-preview" class="photo-preview" src="{{ $organization->logo_url }}" alt="Logo de {{ $organization->name }}">
                    <div>
                        <input type="file" name="logo" id="photo" style="display: none;" onchange="previewPhoto()">
                        <label for="photo" class="btn btn-secondary cursor-pointer">Selecionar Novo Logo</label>
                        @error('logo') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- Campos de Informação --}}
            <div class="form-group">
                <label for="name">Nome da Organização</label>
                <input type="text" id="name" name="name" value="{{ old('name', $organization->name) }}" required>
            </div>
            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea id="description" name="description">{{ old('description', $organization->description) }}</textarea>
            </div>
            <div class="form-group">
                <label for="type">Tipo (Ex: Empresa de Tecnologia)</label>
                <input type="text" id="type" name="type" value="{{ old('type', $organization->type) }}">
            </div>
            <div class="form-group">
                <label for="specialization_areas">Áreas de Especialização (separadas por vírgula)</label>
                <input type="text" id="specialization_areas" name="specialization_areas" value="{{ old('specialization_areas', $organization->specialization_areas) }}">
            </div>
            <div class="form-group">
                <label for="competencies">Competências (separadas por vírgula)</label>
                <input type="text" id="competencies" name="competencies" value="{{ old('competencies', $organization->competencies) }}">
            </div>
            <div class="form-group">
                <label for="available_resources">Recursos Disponíveis (separados por vírgula)</label>
                <input type="text" id="available_resources" name="available_resources" value="{{ old('available_resources', $organization->available_resources) }}">
            </div>

            <button type="submit" class="btn-submit">Salvar Alterações</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Script para preview da imagem
    function previewPhoto() {
        const file = document.getElementById('photo').files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('photo-preview').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endpush
