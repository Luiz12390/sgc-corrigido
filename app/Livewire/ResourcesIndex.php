<?php
namespace App\Livewire;
use App\Models\Resource;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class ResourcesIndex extends Component
{
    use WithPagination;
    #[Url]
    public $filter = '';

    public function render()
    {
        $query = Resource::query()->with('user');
        if ($this->filter === 'meus-recursos') {
            $query->where('user_id', auth()->id());
        }
        return view('livewire.resources-index', [
            'resources' => $query->latest()->paginate(12)
        ]);
    }
}
