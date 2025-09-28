<?php
namespace App\Livewire;
use App\Models\Community;
use Livewire\Component;
use Livewire\WithPagination;

class CommunitiesIndex extends Component
{
    use WithPagination;
    public string $search = '';

    public function render()
    {
        $communities = Community::query()
            ->when($this->search, fn($q) => $q->where('name', 'like', '%'.$this->search.'%'))
            ->latest()
            ->paginate(9);

        return view('livewire.communities-index', ['communities' => $communities]);
    }
}
