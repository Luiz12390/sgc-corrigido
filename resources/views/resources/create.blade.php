@extends('layouts.app')
@section('title', 'Adicionar Novo Recurso')

@section('content')
<div class="page-container max-w-4xl mx-auto py-8 px-4">
    <h1 class="text-3xl font-bold mb-6">Adicionar Novo Recurso</h1>

    <div class="card">
        <form action="{{ route('recursos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-4">
                <label for="title" class="block font-semibold mb-2">Título</label>
                <input type="text" name="title" id="title" class="w-full border rounded p-2" value="{{ old('title') }}" required>
            </div>

            <div class="form-group mb-4">
                <label for="description" class="block font-semibold mb-2">Descrição</label>
                <textarea name="description" id="description" class="w-full border rounded p-2" rows="5" required>{{ old('description') }}</textarea>
            </div>

            <div class="form-group mb-4">
                <label for="type" class="block font-semibold mb-2">Tipo de Recurso</label>
                <input type="text" name="type" id="type" class="w-full border rounded p-2" value="{{ old('type') }}" placeholder="Ex: PDF, Artigo, Estudo de Caso">
            </div>

            <div class="form-group mb-6">
                <label for="file" class="block font-semibold mb-2">Ficheiro (PDF, DOC, ZIP, etc. - Máx 20MB)</label>
                <input type="file" name="file" id="file" class="w-full border rounded p-2" required>
                @error('file') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Enviar Recurso</button>
        </form>
    </div>
</div>
@endsection
