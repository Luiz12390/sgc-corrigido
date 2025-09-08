<?php

namespace App\Livewire;

use App\Models\Project;
use App\Models\Task;
use Livewire\Component;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Carbon\Carbon; // 👈 Adicionar Carbon

class ProjectTasks extends Component
{
    public Project $project;
    public $viewMode = 'kanban';
    public $showModal = false;
    public ?Task $editingTask = null;
    public $editingTaskState = [];

    // Propriedades para o calendário
    public $currentDate; // 👈 Adicionar para controlar o mês do calendário

    public function mount(Project $project)
    {
        $this->project = $project->load('members', 'tasks.user');
        $this->editingTask = new Task();
        $this->currentDate = Carbon::now(); // 👈 Inicializa o calendário com a data atual
    }

    // 👇 Métodos para navegação do calendário
    public function goToNextMonth()
    {
        $this->currentDate->addMonth();
    }

    public function goToPreviousMonth()
    {
        $this->currentDate->subMonth();
    }

    public function render()
    {
        $tasks = $this->project->tasks;
        $totalTasks = $tasks->count();
        $completedTasks = $tasks->where('status', 'Concluído')->count();
        $progressPercentage = ($totalTasks > 0) ? round(($completedTasks / $totalTasks) * 100) : 0;

        // Mantém a lógica do Kanban
        $groupedTasks = $tasks->groupBy('status');

        // 👇 Prepara os dados para o calendário
        $firstDayOfMonth = $this->currentDate->copy()->firstOfMonth();
        $lastDayOfMonth = $this->currentDate->copy()->lastOfMonth();

        // Otimização: Filtra tarefas do mês e agrupa por dia
        $tasksForCalendar = $tasks->whereBetween('due_date', [$firstDayOfMonth, $lastDayOfMonth])
            ->groupBy(function ($task) {
                return Carbon::parse($task->due_date)->format('j'); // Agrupa pelo número do dia
            });

        return view('livewire.project-tasks', [
            // Dados para Kanban e progresso
            'tasks' => $tasks,
            'groupedTasks' => $groupedTasks,
            'progressPercentage' => $progressPercentage,

            // Dados para o Calendário
            'monthName'      => ucfirst($this->currentDate->translatedFormat('F Y')),
            'daysInMonth'    => $this->currentDate->daysInMonth,
            'startDayOfWeek' => $firstDayOfMonth->dayOfWeek,
            'tasksByDay'     => $tasksForCalendar,
        ]);
    }

    public function changeView($mode)
    {
        $this->viewMode = $mode;
    }

    #[On('task-updated')]
    public function updateTaskStatus($taskId, $newStatus)
    {
        $task = Task::find($taskId);
        if ($task) {
            $task->update(['status' => $newStatus]);
            $this->project->load('tasks.user'); // Recarrega as tarefas
        }
    }

    public function editTask($taskId)
    {
        $this->editingTask = Task::find($taskId);
        if ($this->editingTask) {
            $this->editingTaskState = [
                'name' => $this->editingTask->name,
                'status' => $this->editingTask->status,
                'due_date' => $this->editingTask->due_date ? Carbon::parse($this->editingTask->due_date)->format('Y-m-d') : '',
                'user_id' => $this->editingTask->user_id,
            ];
            $this->showModal = true;
        }
    }

    public function saveTask()
    {
        if ($this->editingTask) {
            $this->editingTask->update([
                'name' => $this->editingTaskState['name'],
                'status' => $this->editingTaskState['status'],
                'due_date' => $this->editingTaskState['due_date'],
                'user_id' => $this->editingTaskState['user_id'] ?: null,
            ]);

            $this->project->load('tasks.user');
            session()->flash('status', 'Tarefa atualizada com sucesso!');
        }
        $this->showModal = false;
    }
}
