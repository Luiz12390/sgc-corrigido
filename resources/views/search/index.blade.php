@extends('layouts.app')

@section('title', 'Resultados da Busca por "' . $term . '"')

@section('content')
    <div class="container mx-auto py-8 px-4">
        <h1 class="text-3xl font-bold mb-4">
            Resultados da busca por: <span class="text-primary-500">"{{ $term }}"</span>
        </h1>
        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">Projetos ({{ $projects->count() }})</h2>
            @forelse($projects as $project)
                <div class="card mb-4">
                    <a href="{{ route('projects.show', $project) }}">
                        <h4 class="font-bold text-lg text-primary-500">{{ $project->title }}</h4>
                        <p class="text-gray-600">{{ Str::limit($project->description, 150) }}</p>
                    </a>
                </div>
            @empty
                <p>Nenhum projeto encontrado.</p>
            @endforelse
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">Organizações ({{ $organizations->count() }})</h2>
            @forelse($organizations as $organization)
                <div class="card mb-4">
                    <a href="{{ route('organizations.show', $organization) }}">
                        <h4 class="font-bold text-lg text-primary-500">{{ $organization->name }}</h4>
                        <p class="text-gray-600">{{ Str::limit($organization->description, 150) }}</p>
                    </a>
                </div>
            @empty
                <p>Nenhuma organização encontrada.</p>
            @endforelse
        </section>
    </div>
@endsection
