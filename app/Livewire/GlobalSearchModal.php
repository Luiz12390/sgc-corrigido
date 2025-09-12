<?php

namespace App\Livewire;

use App\Models\Organization;
use App\Models\Project;
use App\Models\User;
use Livewire\Component;

class GlobalSearchModal extends Component
{
    public string $term = '';
    public $results = [];

    public function updatedTerm()
    {
        if (strlen($this->term) < 2) {
            $this->results = [];
            return;
        }

        $projects = Project::search($this->term)->take(5)->get();
        $organizations = Organization::search($this->term)->take(5)->get();
        $users = User::search($this->term)->take(5)->get();

        $this->results = [
            'Projetos' => $projects,
            'Organizações' => $organizations,
            'Utilizadores' => $users,
        ];
    }

    public function render()
    {
        $results = [];

        if (strlen($this->term) >= 2) {
            $projects = Project::search($this->term)->take(5)->get();
            $organizations = Organization::search($this->term)->take(5)->get();
            $users = User::search($this->term)->take(5)->get();

            $results = [
                'Projetos' => $projects,
                'Organizações' => $organizations,
                'Utilizadores' => $users,
            ];
        }

        return view('livewire.global-search-modal', [
            'results' => $results
        ]);
    }
}
