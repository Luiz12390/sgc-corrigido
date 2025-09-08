<div>
    <style>
        /* ESTILOS ESPECÍFICOS DA PÁGINA DE TAREFAS */
        .page-container { max-width: 1400px; margin: 0 auto; padding: 2.5rem; }
        .page-header { margin-bottom: 1.5rem; }
        .page-header h1 { font-size: 2rem; font-weight: 600; }
        .page-header p { font-size: 1rem; color: var(--gray-text-color); }
        .tasks-header { margin-bottom: 2rem; padding: 1.5rem; }
        .progress-info { display: flex; justify-content: space-between; margin-bottom: 0.5rem; font-size: 1rem; font-weight: 500; }
        .progress-bar-container { width: 100%; height: 10px; background-color: var(--border-color); border-radius: 5px; overflow: hidden; }
        .progress-bar-fill { height: 100%; background-color: var(--primary-color); border-radius: 5px; transition: width 0.5s ease; }
        .view-controls { margin-top: 2rem; display: flex; justify-content: flex-end; align-items: center; padding-top: 1.5rem; border-top: 1px solid var(--border-color); }
        .view-toggle { display: flex; background-color: var(--background-color); border: 1px solid var(--border-color); border-radius: 8px; overflow: hidden; }
        .view-toggle button { padding: 0.5rem 1rem; border: none; background: none; cursor: pointer; font-weight: 500; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem; color: var(--gray-text-color); }
        .view-toggle button.active { background-color: var(--card-background-color); color: var(--primary-color); box-shadow: 0 2px 5px rgba(0,0,0,0.05); }

        /* Kanban */
        .kanban-board { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; align-items: start; }
        .kanban-column { background-color: var(--background-color); border-radius: 8px; padding: 1rem; display: flex; flex-direction: column; }
        .kanban-column-title { font-weight: 600; padding: 0 0.5rem 1rem 0.5rem; border-bottom: 3px solid var(--border-color); margin-bottom: 1rem; }
        .task-cards-container { min-height: 200px; flex-grow: 1; }
        .task-card { background-color: var(--card-background-color); border-radius: 8px; padding: 1rem; border: 1px solid var(--border-color); box-shadow: var(--box-shadow); margin-bottom: 1rem; cursor: pointer; }
        .task-card:active { cursor: grabbing; }
        .task-card h4 { font-size: 1rem; font-weight: 600; margin-bottom: 0.5rem; }
        .task-card-footer { display: flex; justify-content: space-between; align-items: center; margin-top: 1rem; }
        .task-card-assignee img { width: 32px; height: 32px; border-radius: 50%; }
        .task-card-due-date { font-size: 0.85rem; color: #c23b22; font-weight: 500; }

        /* Calendário */
        .calendar-view { display: grid; grid-template-columns: repeat(7, 1fr); border: 1px solid var(--border-color); background-color: var(--card-background-color); }
        .calendar-header, .calendar-day { padding: 0.75rem; border-right: 1px solid var(--border-color); border-bottom: 1px solid var(--border-color); }
        .calendar-header { text-align: center; font-weight: 600; background-color: var(--background-color); }
        .calendar-day { min-height: 120px; }
        .calendar-day:nth-child(7n) { border-right: none; }
        .calendar-day .day-number { font-weight: 500; margin-bottom: 0.5rem; text-align: left; }
        .calendar-day .other-month { color: #ccc; }
        .calendar-task { font-size: 0.8rem; background-color: #e6f7ff; border: 1px solid #91d5ff; color: #1890ff; padding: 0.25rem 0.5rem; border-radius: 4px; margin-bottom: 0.25rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; cursor: pointer; text-align: left; }

        /* Modal */
        .modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); z-index: 2000; display: flex; align-items: center; justify-content: center; opacity: 0; visibility: hidden; transition: all 0.3s ease; }
        .modal-overlay.active { opacity: 1; visibility: visible; }
        .modal-content { background-color: var(--card-background-color); padding: 2rem; border-radius: 12px; max-width: 600px; width: 90%; box-shadow: 0 10px 30px rgba(0,0,0,0.1); position: relative; }
        .modal-close { position: absolute; top: 1rem; right: 1rem; background: none; border: none; font-size: 1.5rem; cursor: pointer; }
        .modal-form .form-group { margin-bottom: 1rem; }
        .modal-form label { display: block; font-weight: 500; margin-bottom: 0.5rem; }
        .modal-form input, .modal-form select, .modal-form textarea { width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-family: 'Poppins', sans-serif; }
    </style>

    <div class="page-container">
        <div class="page-header">
            <h1>Tarefas do Projeto: {{ $project->title }}</h1>
            <p>Organize, acompanhe e gerencie todas as atividades do projeto.</p>
        </div>

        <div class="card tasks-header">
            <div class="progress-info">
                <span>Progresso Geral</span>
                <span>{{ $progressPercentage }}%</span>
            </div>
            <div class="progress-bar-container">
                <div class="progress-bar-fill" style="width: {{ $progressPercentage }}%;"></div>
            </div>
            <div class="view-controls">
                <div class="view-toggle">
                    <button wire:click="changeView('kanban')" class="{{ $viewMode === 'kanban' ? 'active' : '' }}"><span>Cartões</span></button>
                    <button wire:click="changeView('calendar')" class="{{ $viewMode === 'calendar' ? 'active' : '' }}"><span>Calendário</span></button>
                </div>
            </div>
        </div>

        @if (session('status'))
            <div style="background-color: #d1e7dd; color: #0f5132; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">{{ session('status') }}</div>
        @endif

        <div class="kanban-board" @if($viewMode !== 'kanban') style="display: none;" @endif wire:key="kanban">
            @php $statuses = ['Não Iniciado', 'Pendente', 'Em Andamento', 'Concluído']; @endphp
            @foreach ($statuses as $status)
                <div class="kanban-column">
                    <h3 class="kanban-column-title">{{ $status }}</h3>
                    <div class="task-cards-container" data-status="{{ $status }}">
                        @foreach ($groupedTasks[$status] ?? [] as $task)
                            <div class="task-card" wire:click="editTask({{ $task->id }})" data-id="{{ $task->id }}" wire:key="task-{{ $task->id }}">
                                <h4>{{ $task->name }}</h4>
                                <div class="task-card-footer">
                                    <div class="task-card-assignee"><img src="{{ $task->user->profile_photo_url  ?? 'https://via.placeholder.com/32' }}" title="{{ $task->user->name ?? '' }}" alt="{{ $task->user->name ?? '' }}"></div>
                                    @if ($task->due_date)
                                        <span class="task-card-due-date">{{ \Carbon\Carbon::parse($task->due_date)->format('d/m/Y') }}</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <div class="page-container">
            <div class="kanban-board" @if($viewMode !== 'kanban') style="display: none;" @endif wire:key="kanban">
                </div>

            <div class="calendar-view-container" @if($viewMode !== 'calendar') style="display: none;" @endif>
                <div class="card">
                    <div class="month-header" style="display: flex; justify-content: space-between; align-items: center; padding: 1rem;">
                        <button wire:click="goToPreviousMonth" class="btn btn-secondary">&lt;</button>
                        <span style="font-size: 1.2rem; font-weight: bold;">{{ $monthName }}</span>
                        <button wire:click="goToNextMonth" class="btn btn-secondary">&gt;</button>
                    </div>

                    <div class="calendar-view">
                        <div class="calendar-header">D</div>
                        <div class="calendar-header">S</div>
                        <div class="calendar-header">T</div>
                        <div class="calendar-header">Q</div>
                        <div class="calendar-header">Q</div>
                        <div class="calendar-header">S</div>
                        <div class="calendar-header">S</div>

                        @for ($i = 0; $i < $startDayOfWeek; $i++)
                            <div class="calendar-day other-month"></div>
                        @endfor

                        @for ($day = 1; $day <= $daysInMonth; $day++)
                            <div class="calendar-day">
                                <span class="day-number">{{ $day }}</span>

                                @if (isset($tasksByDay[$day]))
                                    @foreach ($tasksByDay[$day] as $task)
                                        <div class="calendar-task" wire:click="editTask({{ $task->id }})">
                                            {{ $task->name }}
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        @endfor
                    </div>
                </div>
            </div>

            @if($showModal)
                @endif

            @push('scripts')
                @endpush
        </div>
    </div>

    @if($showModal)
    <div class="modal-overlay active">
        <div class="modal-content" @click.away="$wire.set('showModal', false)">
            <button wire:click="$set('showModal', false)" class="modal-close">&times;</button>
            <h2>Editar Tarefa: {{ $editingTask->name }}</h2>
            <form wire:submit.prevent="saveTask" class="modal-form">
                <div class="form-group"><label for="name">Nome da Tarefa</label><input type="text" wire:model="editingTaskState.name" id="name"></div>
                <div class="form-group"><label for="status">Status</label><select wire:model="editingTaskState.status" id="status"><option>Não Iniciado</option><option>Pendente</option><option>Em Andamento</option><option>Concluído</option></select></div>
                <div class="form-group"><label for="due_date">Prazo Final</label><input type="date" wire:model="editingTaskState.due_date" id="due_date"></div>
                <div class="form-group"><label for="user_id">Responsável</label><select wire:model="editingTaskState.user_id" id="user_id"><option value="">Ninguém</option>@foreach($project->members as $member)<option value="{{ $member->id }}">{{ $member->name }}</option>@endforeach</select></div>
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            </form>
        </div>
    </div>
    @endif

    @push('scripts')
    <script>
        function initializeSortable() {
            document.querySelectorAll('.task-cards-container').forEach(container => {
                if (container.sortableInstance) {
                    container.sortableInstance.destroy();
                }

                container.sortableInstance = new Sortable(container, {
                    group: 'shared-tasks',
                    animation: 150,
                    onEnd: function (evt) {
                        let taskId = evt.item.getAttribute('data-id');
                        let newStatus = evt.to.getAttribute('data-status');

                        Livewire.dispatch('task-updated', { taskId: taskId, newStatus: newStatus });
                    }
                });
            });
        }

        document.addEventListener('livewire:init', () => {
            initializeSortable();
            Livewire.hook('morph.updated', (el, component) => {
                initializeSortable();
            });
        });
    </script>
    @endpush
</div>
