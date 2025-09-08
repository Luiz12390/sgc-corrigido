<?php

namespace App\Livewire;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class ProjectsIndex extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public $search = '';

    #[Url]
    public $status = 'all';

    #[Url]
    public $filter = '';

    public function render()
    {
        $query = Project::query();

        if ($this->filter === 'meus-projetos') {
            $query->whereHas('members', function ($q) {
                $q->where('user_id', Auth::id());
            });
        } elseif ($this->filter === 'minha-empresa') {
            $organization = Auth::user()->organizations()->first();
            if ($organization) {
                $memberIds = $organization->members()->pluck('users.id');
                $query->whereHas('members', function ($q) use ($memberIds) {
                    $q->whereIn('user_id', $memberIds);
                });
            } else {
                $query->whereRaw('1 = 0');
            }
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->status !== 'all') {
            $query->where('status', $this->status);
        }

        $featuredProject = Project::latest()->first();
        $projects = $query->latest()->paginate(10);

        return view('livewire.projects-index', [
            'projects' => $projects,
            'featuredProject' => $featuredProject,
        ]);
    }

    public function updating($key)
    {
        if (in_array($key, ['search', 'status', 'filter'])) {
            $this->resetPage();
        }
    }
}
