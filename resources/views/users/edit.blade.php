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
    .btn-submit { display: inline-block; padding: 0.8rem 2rem; border: none; background-color: var(--primary-color); color: var(--white-color); border-radius: 8px; font-weight: 600; cursor: pointer; transition: background-color: 0.3s ease; }
    .btn-submit:hover { background-color: #256e67; }
</style>
@endpush

@section('content')
<div class="page-container">
    <div class="page-header"><h1>Editar Perfil</h1></div>
    <div class="card">
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                @error('name') <span>{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                @error('email') <span>{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="title">Título (Ex: Cargo na Empresa)</label>
                <input type="text" id="title" name="title" value="{{ old('title', $user->title) }}">
                @error('title') <span>{{ $message }}</span> @enderror
            </div>
            {{-- Adicionar campo de upload de foto aqui no futuro --}}
            <button type="submit" class="btn-submit">Salvar Alterações</button>
        </form>
    </div>
</div>
@endsection