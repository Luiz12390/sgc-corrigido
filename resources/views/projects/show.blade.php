@extends('layouts.app')

@section('title', $project->title . ' | SGC-Chapecó')

@push('styles')
<style>
    /* Cole aqui todos os estilos da página de detalhes do projeto */
    .page-subheader { background-color: var(--card-background-color); border-bottom: 1px solid var(--border-color); padding: 1rem 2.5rem; }
    .subheader-content { display: flex; justify-content: space-between; align-items: center; }
    .breadcrumbs { font-size: 1rem; color: var(--gray-text-color); }
    .breadcrumbs a { color: var(--primary-color); font-weight: 500; }
    .page-actions { display: flex; align-items: center; gap: 1rem; }
    .project-detail-container { max-width: 950px; margin: 2.5rem auto; }
    .project-header h1 { font-size: 2.25rem; font-weight: 600; line-height: 1.3; margin-bottom: 0.5rem; }
    .project-header > p { font-size: 1.1rem; color: var(--gray-text-color); margin-bottom: 2.5rem; }
    .project-section-card { margin-bottom: 2rem; padding: 2rem; }
    .project-section-card h2 { font-size: 1.25rem; font-weight: 600; margin-bottom: 1.5rem; }
    .section-header { display: flex; justify-content: space-between; align-items: center; }
    .view-all-link { font-weight: 500; color: var(--primary-color); font-size: 0.9rem; }
    .overview-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; }
    .overview-item h4 { font-size: 0.9rem; color: #555; font-weight: 500; margin-bottom: 0.5rem; }
    .overview-item p { font-size: 1rem; line-height: 1.6; }
    .members-list { display: flex; margin-top: 1rem; }
    .member-avatar { width: 48px; height: 48px; border-radius: 50%; object-fit: cover; border: 3px solid var(--card-background-color); box-shadow: 0 2px 4px rgba(0,0,0,0.1); transition: transform 0.2s ease; }
    .member-avatar:not(:first-child) { margin-left: -20px; }
    .member-avatar:hover { transform: translateY(-4px); z-index: 1; }
    .tasks-table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
    .tasks-table th, .tasks-table td { padding: 1rem; text-align: left; border-bottom: 1px solid var(--border-color); font-size: 0.95rem; }
    .tasks-table thead th { color: var(--gray-text-color); font-weight: 500; font-size: 0.85rem; text-transform: uppercase; }
    .status-badge { padding: 0.25rem 0.75rem; border-radius: 12px; font-weight: 500; font-size: 0.8rem; }
    .status-em-andamento { background-color: #e6f7ff; color: #1890ff; border: 1px solid #91d5ff; }
    .status-concluido { background-color: #f6ffed; color: #52c41a; border: 1px solid #b7eb8f; }
    .status-pendente { background-color: #fffbe6; color: #faad14; border: 1px solid #ffe58f; }
    .status-nao-iniciado { background-color: #fafafa; color: #8c8c8c; border: 1px solid #d9d9d9; }
</style>
@endpush

@section('content')
    <div class="page-subheader">
        <div class="subheader-content">
            <nav class="breadcrumbs">
                <a href="{{ route('projects.index') }}">Projetos</a> / <span>{{ Str::limit($project->title, 30) }}</span>
            </nav>
            <div class="project-actions" style="margin-left: auto;"> {{-- Adicionado margin-left para alinhar à direita --}}
                @auth
                    @can('update', $project)
                        {{-- Botões para o dono do projeto --}}
                        {{-- <a href="#" class="btn btn-primary">Editar Projeto</a> --}}
                        <a href="{{ route('projects.manageMembers', $project) }}" class="btn btn-secondary">Gerir Membros</a>
                    @else
                        {{-- Botão para visitantes e outros utilizadores --}}
                        <livewire:request-to-join-project-button :project="$project" />
                    @endcan
                @else
                    {{-- Botão para utilizadores não logados --}}
                    <livewire:request-to-join-project-button :project="$project" />
                @endauth
            </div>
        </div>
    </div>

    <div class="project-detail-container">
        <div class="project-header">
            <h1>Projeto: {{ $project->title }}</h1>
            <p>{{ $project->description }}</p>
        </div>

        <div class="card project-section-card">
            <h2>Visão Geral do Projeto</h2>
        </div>

        <div class="card project-section-card">
            <div class="section-header">
                <h2>Membros da Equipe ({{ $project->members->count() }})</h2>
                <a href="{{ route('projects.members', $project) }}" class="view-all-link">Ver todos &rarr;</a>
            </div>
            <div class="members-list">
                @forelse ($project->members->take(10) as $member)
                    <a href="{{ route('profile.show', $member) }}" title="{{ $member->name }}">
                        <img src="{{ $member->profile_photo_url  ?? 'https://via.placeholder.com/48' }}" alt="Foto de {{ $member->name }}" class="member-avatar">
                    </a>
                @empty
                    <p style="color: var(--gray-text-color);">Nenhum membro vinculado a este projeto ainda.</p>
                @endforelse
            </div>
        </div>

        <div class="card project-section-card">
            <div class="section-header">
                <h2>Tarefas</h2>
                <a href="{{ route('projects.tasks', $project) }}" class="view-all-link">Ver todas as tarefas &rarr;</a>
            </div>
            <table class="tasks-table">
                <thead>
                    <tr>
                        <th>Tarefa</th>
                        <th>Status</th>
                        <th>Responsável</th>
                        <th>Prazo Final</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($project->tasks->take(5) as $task)
                    <tr>
                        <td>{{ $task->name }}</td>
                        <td><span class="status-badge status-{{ Str::slug($task->status) }}">{{ $task->status }}</span></td>
                        <td>{{ $task->user->name ?? 'Não atribuído' }}</td>
                        <td>{{ \Carbon\Carbon::parse($task->due_date)->format('d/m/Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align: center; color: var(--gray-text-color);">Nenhuma tarefa para este projeto ainda.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
