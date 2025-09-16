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
        if (!Auth::check() && in_array($this->filter, ['meus-projetos', 'minha-empresa'])) {
            return redirect()->route('login');
        }

        $query = Project::query()->with('user', 'organization');

        if ($this->filter === 'meus-projetos') {
            $query->where(function ($q) {
                $q->where('user_id', Auth::id())
                  ->orWhereHas('members', function ($subQ) {
                      $subQ->where('users.id', Auth::id());
                  });
            });

        } elseif ($this->filter === 'minha-empresa') {
            $organizationIds = Auth::user()->organizations()->pluck('organizations.id');
            if ($organizationIds->isNotEmpty()) {
                $query->whereIn('organization_id', $organizationIds);
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

        $featuredProject = ($this->filter || $this->search || $this->status !== 'all')
            ? null
            : Project::latest()->first();

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
