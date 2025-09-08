<?php

namespace App\Livewire;

use App\Models\Organization;
use Livewire\Component;
use Livewire\WithPagination;

class OrganizationsIndex extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $organizations = Organization::query()
            ->when($this->search, function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhere('description', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate(9);

        return view('livewire.organizations-index', [
            'organizations' => $organizations,
        ]);
    }
}
