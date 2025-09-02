@extends('layouts.app')

@section('title', 'Tarefas do Projeto | SGC-Chapecó')

@push('styles')
<style>
    /* ESTILOS ESPECÍFICOS DA PÁGINA DE TAREFAS */
    .page-container { max-width: 1400px; margin: 0 auto; padding: 2.5rem; }
    .page-header { margin-bottom: 1.5rem; }
    .page-header h1 { font-size: 2rem; font-weight: 600; }
    .page-header p { font-size: 1rem; color: var(--gray-text-color); }

    .tasks-header { margin-bottom: 2rem; padding: 1.5rem; }
    .progress-info { display: flex; justify-content: space-between; margin-bottom: 0.5rem; font-size: 1rem; font-weight: 500; }
    .progress-bar-container { width: 100%; height: 10px; background-color: var(--border-color); border-radius: 5px; overflow: hidden; }
    .progress-bar-fill { height: 100%; background-color: var(--primary-color); border-radius: 5px; }

    .view-controls { margin-top: 2rem; display: flex; justify-content: flex-end; align-items: center; padding-top: 1.5rem; border-top: 1px solid var(--border-color); }
    .view-toggle { display: flex; background-color: var(--background-color); border: 1px solid var(--border-color); border-radius: 8px; overflow: hidden; }
    .view-toggle button { padding: 0.5rem 1rem; border: none; background: none; cursor: pointer; font-weight: 500; font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem; color: var(--gray-text-color); }
    .view-toggle button.active { background-color: var(--card-background-color); color: var(--primary-color); box-shadow: 0 2px 5px rgba(0,0,0,0.05); }

    /* Kanban */
    .kanban-board { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; }
    .kanban-column { background-color: var(--background-color); border-radius: 8px; padding: 1rem; min-height: 400px; }
    .kanban-column-title { font-weight: 600; padding: 0 0.5rem 1rem 0.5rem; border-bottom: 3px solid var(--border-color); margin-bottom: 1rem; }
    .task-card { background-color: var(--card-background-color); border-radius: 8px; padding: 1rem; border: 1px solid var(--border-color); box-shadow: var(--box-shadow); margin-bottom: 1rem; cursor: grab; }
    .task-card:active { cursor: grabbing; }
    .task-card h4 { font-size: 1rem; font-weight: 600; margin-bottom: 0.5rem; }
    .task-card p { font-size: 0.9rem; color: var(--gray-text-color); margin-bottom: 1rem; }
    .task-card-footer { display: flex; justify-content: space-between; align-items: center; }
    .task-card-assignee img { width: 32px; height: 32px; border-radius: 50%; }
    .task-card-due-date { font-size: 0.85rem; color: #c23b22; font-weight: 500; }

    /* Calendário */
    .calendar-view { display: grid; grid-template-columns: repeat(7, 1fr); border: 1px solid var(--border-color); background-color: var(--card-background-color); }
    .calendar-header, .calendar-day { padding: 0.75rem; border-right: 1px solid var(--border-color); border-bottom: 1px solid var(--border-color); }
    .calendar-header { text-align: center; font-weight: 600; background-color: var(--background-color); }
    .calendar-day { min-height: 120px; }
    .calendar-day:nth-child(7n) { border-right: none; }
    .calendar-day .day-number { font-weight: 500; margin-bottom: 0.5rem; }
    .calendar-day .other-month { color: #ccc; }
    .calendar-task { font-size: 0.8rem; background-color: #e6f7ff; border: 1px solid #91d5ff; color: #1890ff; padding: 0.25rem 0.5rem; border-radius: 4px; margin-bottom: 0.25rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; cursor: pointer; }

    /* Modal */
    .modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); z-index: 2000; display: flex; align-items: center; justify-content: center; opacity: 0; visibility: hidden; transition: all 0.3s ease; }
    .modal-overlay.active { opacity: 1; visibility: visible; }
    .modal-content { background-color: var(--card-background-color); padding: 2rem; border-radius: 12px; max-width: 600px; width: 90%; box-shadow: 0 10px 30px rgba(0,0,0,0.1); position: relative; }
    .modal-close { position: absolute; top: 1rem; right: 1rem; background: none; border: none; font-size: 1.5rem; cursor: pointer; }
    .modal-content h2 { font-size: 1.5rem; margin-bottom: 1.5rem; }
    /* Estilos para o formulário dentro do modal (reutilize se já tiver) */
    .modal-form .form-group { margin-bottom: 1rem; }
    .modal-form label { display: block; font-weight: 500; margin-bottom: 0.5rem; }
    .modal-form input, .modal-form select, .modal-form textarea { width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-family: 'Poppins', sans-serif; }
    .modal-form .btn-primary { background-color: var(--primary-color); color: var(--white-color); border: none; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; }

    .task-cards-container {
    min-height: 100px; /* Garante que haja uma área de drop mesmo se a coluna estiver vazia */
    flex-grow: 1;
    }
    .kanban-column {
        /* Adicionado para garantir que o conteúdo se estique verticalmente */
        display: flex;
        flex-direction: column;
    }
</style>
@endpush

@section('content')
<div class="page-container">
    <div class="page-header">
        <h1>Tarefas do Projeto: Soluções de Embalagens Sustentáveis</h1>
        <p>Organize, acompanhe e gerencie todas as atividades do projeto.</p>
    </div>

    <div class="card tasks-header">
        <div class="progress-info">
            <span>Progresso Geral</span>
            <span id="progress-percent">60%</span>
        </div>
        <div class="progress-bar-container">
            <div class="progress-bar-fill" id="progress-bar" style="width: 60%;"></div>
        </div>

        <div class="view-controls">
            <div class="view-toggle">
                <button id="view-kanban-btn" class="active">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2zM2 6h12v6H2z"/></svg>
                    <span>Cartões</span>
                </button>
                <button id="view-calendar-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/></svg>
                    <span>Calendário</span>
                </button>
            </div>
        </div>
    </div>

    <div id="kanban-view" class="kanban-board">
        <div class="kanban-column" data-status="Não Iniciado">
            <h3 class="kanban-column-title">Não Iniciado</h3>
            <div class="task-cards-container">
                <div class="task-card" data-task-id="4">
                    <h4>Programa Piloto</h4>
                    <p>Implementar e monitorar o programa piloto com empresas parceiras.</p>
                    <div class="task-card-footer">
                        <div class="task-card-assignee"><img src="https://i.pravatar.cc/150?u=isabela_costa" alt="Isabela Costa"></div>
                        <span class="task-card-due-date">2025-10-15</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="kanban-column" data-status="Pendente">
            <h3 class="kanban-column-title">Pendente</h3>
            <div class="task-cards-container">
                <div class="task-card" data-task-id="3">
                    <h4>Análise de Mercado</h4>
                    <p>Analisar a viabilidade de mercado para as novas soluções de embalagem.</p>
                    <div class="task-card-footer">
                        <div class="task-card-assignee"><img src="https://i.pravatar.cc/150?u=lucas_mendes" alt="Lucas Mendes"></div>
                        <span class="task-card-due-date">2025-07-30</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="kanban-column" data-status="Em Andamento">
            <h3 class="kanban-column-title">Em Andamento</h3>
            <div class="task-cards-container">
                <div class="task-card" data-task-id="1">
                    <h4>Pesquisa de Materiais</h4>
                    <p>Pesquisar e testar novos materiais sustentáveis para embalagens.</p>
                    <div class="task-card-footer">
                        <div class="task-card-assignee"><img src="https://i.pravatar.cc/150?u=carlos_silva" alt="Dr. Carlos Silva"></div>
                        <span class="task-card-due-date">2025-03-15</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="kanban-column" data-status="Concluído">
            <h3 class="kanban-column-title">Concluído</h3>
            <div class="task-cards-container">
                <div class="task-card" data-task-id="2">
                    <h4>Design de Protótipo</h4>
                    <p>Criar o design inicial e os primeiros protótipos das embalagens.</p>
                    <div class="task-card-footer">
                        <div class="task-card-assignee"><img src="https://i.pravatar.cc/150?u=ana_souza" alt="Ana Souza"></div>
                        <span class="task-card-due-date">2025-05-20</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="calendar-view" style="display: none;">
        <div class="card" style="width: 100%; text-align: center; margin-bottom: 1rem;">
            <h3 style="margin-bottom: 0.5rem;">Agosto 2025</h3>
        </div>
        <div class="calendar-view">
            <div class="calendar-header">Dom</div>
            <div class="calendar-header">Seg</div>
            <div class="calendar-header">Ter</div>
            <div class="calendar-header">Qua</div>
            <div class="calendar-header">Qui</div>
            <div class="calendar-header">Sex</div>
            <div class="calendar-header">Sáb</div>

            <div class="calendar-day"><span class="day-number other-month">27</span></div>
            <div class="calendar-day"><span class="day-number other-month">28</span></div>
            <div class="calendar-day"><span class="day-number other-month">29</span></div>
            <div class="calendar-day"><span class="day-number other-month">30</span></div>
            <div class="calendar-day"><span class="day-number other-month">31</span></div>
            <div class="calendar-day"><span class="day-number">1</span></div>
            <div class="calendar-day"><span class="day-number">2</span></div>

            <div class="calendar-day"><span class="day-number">3</span></div>
            <div class="calendar-day"><span class="day-number">4</span></div>
            <div class="calendar-day"><span class="day-number">5</span></div>
            <div class="calendar-day"><span class="day-number">6</span></div>
            <div class="calendar-day"><span class="day-number">7</span></div>
            <div class="calendar-day"><span class="day-number">8</span></div>
            <div class="calendar-day"><span class="day-number">9</span></div>

            <div class="calendar-day"><span class="day-number">10</span></div>
            <div class="calendar-day"><span class="day-number">11</span></div>
            <div class="calendar-day"><span class="day-number">12</span></div>
            <div class="calendar-day"><span class="day-number">13</span></div>
            <div class="calendar-day"><span class="day-number">14</span></div>
            <div class="calendar-day"><span class="day-number">15</span></div>
            <div class="calendar-day"><span class="day-number">16</span></div>

            <div class="calendar-day"><span class="day-number">17</span></div>
            <div class="calendar-day"><span class="day-number">18</span></div>
            <div class="calendar-day"><span class="day-number">19</span></div>
            <div class="calendar-day"><span class="day-number">20</span></div>
            <div class="calendar-day"><span class="day-number">21</span></div>
            <div class="calendar-day"><span class="day-number">22</span><div class="calendar-task" data-task-id="3">Análise Mercado</div></div>
            <div class="calendar-day"><span class="day-number">23</span></div>

            <div class="calendar-day"><span class="day-number">24</span></div>
            <div class="calendar-day"><span class="day-number">25</span></div>
            <div class="calendar-day"><span class="day-number">26</span></div>
            <div class="calendar-day"><span class="day-number">27</span></div>
            <div class="calendar-day"><span class="day-number">28</span></div>
            <div class="calendar-day"><span class="day-number">29</span></div>
            <div class="calendar-day"><span class="day-number">30</span></div>

            <div class="calendar-day"><span class="day-number">31</span></div>
            <div class="calendar-day"><span class="day-number other-month">1</span></div>
            <div class="calendar-day"><span class="day-number other-month">2</span></div>
            <div class="calendar-day"><span class="day-number other-month">3</span></div>
            <div class="calendar-day"><span class="day-number other-month">4</span></div>
            <div class="calendar-day"><span class="day-number other-month">5</span></div>
            <div class="calendar-day"><span class="day-number other-month">6</span></div>
        </div>
    </div>
</div>

<div class="modal-overlay" id="task-modal">
    <div class="modal-content">
        <button class="modal-close" id="modal-close-btn">&times;</button>
        <h2 id="modal-title">Editar Tarefa</h2>
        <form id="modal-form" class="modal-form">
            <input type="hidden" id="modal-task-id" name="task_id">
            <div class="form-group">
                <label for="modal-task-name">Nome da Tarefa</label>
                <input type="text" id="modal-task-name" name="task_name">
            </div>
            <div class="form-group">
                <label for="modal-task-description">Descrição</label>
                <textarea id="modal-task-description" name="task_description"></textarea>
            </div>
             <div class="form-group">
                <label for="modal-task-status">Status</label>
                <select id="modal-task-status" name="task_status">
                    <option value="Não Iniciado">Não Iniciado</option>
                    <option value="Pendente">Pendente</option>
                    <option value="Em Andamento">Em Andamento</option>
                    <option value="Concluído">Concluído</option>
                </select>
            </div>
            <div class="form-group">
                <label for="modal-task-due-date">Prazo Final</label>
                <input type="date" id="modal-task-due-date" name="task_due_date">
            </div>
            <button type="submit" class="btn-primary">Salvar Alterações</button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // --- Dados de Exemplo (no futuro, virão do backend) ---
    const tasks = {
        '1': { name: 'Pesquisa de Materiais', description: 'Pesquisar e testar...', status: 'Em Andamento', dueDate: '2025-03-15', assignee: 'Dr. Carlos Silva' },
        '2': { name: 'Design de Protótipo', description: 'Criar o design inicial...', status: 'Concluído', dueDate: '2025-05-20', assignee: 'Ana Souza' },
        '3': { name: 'Análise de Mercado', description: 'Analisar a viabilidade...', status: 'Pendente', dueDate: '2025-07-30', assignee: 'Lucas Mendes' },
        '4': { name: 'Programa Piloto', description: 'Implementar e monitorar...', status: 'Não Iniciado', dueDate: '2025-10-15', assignee: 'Isabela Costa' },
        '5': { name: 'Programa Piloto', description: 'Implementar e monitorar...', status: 'Não Iniciado', dueDate: '2025-10-15', assignee: 'Isabela Costa' },
        '6': { name: 'Programa Piloto', description: 'Implementar e monitorar...', status: 'Não Iniciado', dueDate: '2025-10-15', assignee: 'Isabela Costa' }

    };

    // --- Lógica para Alternar Visualizações ---
    const kanbanView = document.getElementById('kanban-view');
    const calendarView = document.getElementById('calendar-view');
    const viewKanbanBtn = document.getElementById('view-kanban-btn');
    const viewCalendarBtn = document.getElementById('view-calendar-btn');

    viewKanbanBtn.addEventListener('click', () => {
        kanbanView.style.display = 'grid';
        calendarView.style.display = 'none';
        viewKanbanBtn.classList.add('active');
        viewCalendarBtn.classList.remove('active');
    });

    viewCalendarBtn.addEventListener('click', () => {
        kanbanView.style.display = 'none';
        calendarView.style.display = 'block'; // 'block' para o container do calendário
        viewKanbanBtn.classList.remove('active');
        viewCalendarBtn.classList.add('active');
    });

    // --- Lógica do Kanban com SortableJS ---
    const columns = document.querySelectorAll('.task-cards-container'); // Aponta para o novo container
    columns.forEach(column => {
        new Sortable(column, {
            group: 'shared', // Permite mover cartões entre colunas
            animation: 150,
            ghostClass: 'blue-background-class'
        });
    });

    // --- Lógica do Modal ---
    const modal = document.getElementById('task-modal');
    const closeModalBtn = document.getElementById('modal-close-btn');
    const taskCards = document.querySelectorAll('.task-card, .calendar-task');

    function openModal(taskId) {
        const task = tasks[taskId];
        if (task) {
            document.getElementById('modal-title').innerText = 'Editar Tarefa: ' + task.name;
            document.getElementById('modal-task-id').value = taskId;
            document.getElementById('modal-task-name').value = task.name;
            document.getElementById('modal-task-description').value = task.description;
            document.getElementById('modal-task-status').value = task.status;
            document.getElementById('modal-task-due-date').value = task.dueDate;
            modal.classList.add('active');
        }
    }

    function closeModal() {
        modal.classList.remove('active');
    }

    taskCards.forEach(card => {
        card.addEventListener('click', () => {
            const taskId = card.getAttribute('data-task-id');
            openModal(taskId);
        });
    });

    closeModalBtn.addEventListener('click', closeModal);
    modal.addEventListener('click', (event) => {
        if (event.target === modal) {
            closeModal();
        }
    });

    document.getElementById('modal-form').addEventListener('submit', (event) => {
        event.preventDefault();
        alert('Dados salvos! (simulação)');
        closeModal();
    });
});
</script>
@endsection
