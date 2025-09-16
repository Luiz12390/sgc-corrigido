<?php

namespace App\Livewire;

use App\Models\Challenge;
use Livewire\Component;
use Livewire\WithPagination;

class ChallengesIndex extends Component
{
    use WithPagination;

    #[Url]
    public $filter = '';
    public $search = '';
    public $category = 'all';
    public $status = 'all';

    public function render()
    {
        $query = Challenge::query();

        if ($this->filter === 'meus-desafios') {
            $query->where('user_id', auth()->id());
        }

        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
        }

        if ($this->status !== 'all') {
            $query->where('type', $this->status);
        }

        $featuredChallenge = Challenge::latest()->first();
        $challenges = $query->latest()->paginate(10);

        return view('livewire.challenges-index', [
            'challenges' => $challenges,
            'featuredChallenge' => $featuredChallenge,
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->filter = request()->query('filter');
    }
}
