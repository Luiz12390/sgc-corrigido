<?php

namespace App\Livewire;

use App\Models\Challenge;
use Livewire\Component;
use Livewire\WithPagination;

class ChallengesIndex extends Component
{
    use WithPagination; // Habilita a paginação do Livewire

    // Propriedades para os filtros, conectadas ao frontend
    public $search = '';
    public $category = 'all';
    public $status = 'all';

    public function render()
    {
        // Começa a query para buscar os desafios
        $query = Challenge::query();

        // Aplica o filtro de busca se houver algo digitado
        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
        }

        // (Exemplo) Aplica o filtro de status se não for 'all'
        if ($this->status !== 'all') {
            $query->where('type', $this->status); // Supondo que 'type' seja o status
        }

        // (Exemplo) Lógica para o Desafio em Destaque (pega o mais recente)
        $featuredChallenge = Challenge::latest()->first();

        // Executa a query com paginação
        $challenges = $query->latest()->paginate(10);

        return view('livewire.challenges-index', [
            'challenges' => $challenges,
            'featuredChallenge' => $featuredChallenge,
        ]);
    }

    // Reseta a paginação sempre que um filtro é alterado
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }
}
