<?php

namespace App\Livewire;

use App\Models\Community;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CreatePost extends Component
{
    public Community $community;

    #[Rule('required|min:5|max:5000')]
    public string $content = '';

    public function mount(Community $community)
    {
        $this->community = $community;
    }

    public function save()
    {
        $this->validate();

        $this->community->posts()->create([
            'user_id' => auth()->id(),
            'content' => $this->content,
        ]);

        $this->reset('content');
        $this->dispatch('post-created');
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
