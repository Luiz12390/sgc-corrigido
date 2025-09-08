@extends('layouts.app')

@section('title', 'Editar Perfil | SGC-Chapecó')

@push('styles')
<style>
    .page-container { max-width: 800px; margin: 0 auto; padding: 2.5rem; }
    .page-header h1 { font-size: 2rem; font-weight: 600; margin-bottom: 2rem; }
    .form-group { margin-bottom: 1.5rem; }
    .form-group label { display: block; font-weight: 500; margin-bottom: 0.5rem; }
    .form-group input, .form-group textarea { width: 100%; padding: 0.8rem 1rem; border: 1px solid var(--border-color); background-color: var(--card-background-color); border-radius: 8px; font-size: 1rem; font-family: 'Poppins', sans-serif; }
    .form-group textarea { min-height: 120px; resize: vertical; }
    .btn-submit { display: inline-block; padding: 0.8rem 2rem; border: none; background-color: var(--primary-color); color: var(--white-color); border-radius: 8px; font-weight: 600; cursor: pointer; transition: background-color 0.3s ease; }
    .btn-submit:hover { background-color: #256e67; }
    .photo-upload-container { display: flex; align-items: center; gap: 1.5rem; }
    .photo-preview { width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 3px solid var(--border-color); }
    .btn-secondary { background-color: var(--card-background-color); color: var(--primary-color); border: 1px solid var(--border-color); padding: 0.6rem 1.2rem; }
    .alert {padding: 1rem;border-radius: 8px;margin-bottom: 1.5rem;border: 1px solid transparent;}
    .alert-success {color: #0f5132;background-color: #d1e7dd;border-color: #badbcc;}
</style>
@endpush

@section('content')
<div class="page-container">
    <div class="page-header"><h1>Editar Perfil</h1></div>

    @if (session('status'))
        <div class="alert alert-success mb-4">{{ session('status') }}</div>
    @endif

    <div class="card">
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            {{-- UPLOAD DA FOTO --}}
            <div class="form-group">
                <label>Foto de Perfil</label>
                <div class="photo-upload-container">
                    <img id="photo-preview" class="photo-preview" src="{{ auth()->user()->profile_photo_url }}" alt="Foto de {{ auth()->user()->name }}">
                    <div>
                        {{-- AQUI ESTÁ A CORREÇÃO: style="display: none;" --}}
                        <input type="file" name="photo" id="photo" style="display: none;" onchange="previewPhoto()">

                        <label for="photo" class="btn btn-secondary cursor-pointer">
                            Selecionar Nova Foto
                        </label>
                        @error('photo') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- INFORMAÇÕES BÁSICAS --}}
            <div class="form-group">
                <label for="name">Nome Completo</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            </div>
            <div class="form-group">
                <label for="title">Título (Ex: Cargo, Estudante de...)</label>
                <input type="text" id="title" name="title" value="{{ old('title', $user->title) }}">
            </div>

            <div class="form-group">
                <label for="bio">Sobre (Biografia)</label>
                <textarea id="bio" name="bio">{{ old('bio', $user->bio) }}</textarea>
            </div>
            <div class="form-group">
                <label for="institution">Instituição (Ex: UFFS)</label>
                <input type="text" id="institution" name="institution" value="{{ old('institution', $user->institution) }}">
            </div>
            <div class="form-group">
                <label for="competencies">Competências (separadas por vírgula)</label>
                <input type="text" id="competencies" name="competencies" value="{{ old('competencies', $user->competencies) }}" placeholder="Ex: Análise de Dados, Gestão de Projetos">
            </div>
            <div class="form-group">
                <label for="interests">Interesses (separados por vírgula)</label>
                <input type="text" id="interests" name="interests" value="{{ old('interests', $user->interests) }}" placeholder="Ex: Sustentabilidade, Energia Renovável">
            </div>

            <button type="submit" class="btn-submit">Salvar Alterações</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
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
