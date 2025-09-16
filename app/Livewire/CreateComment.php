<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CreateComment extends Component
{
    public Post $post;

    #[Rule('required|min:1|max:2000')]
    public string $content = '';

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function save()
    {
        $this->validate();

        $this->post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $this->content,
        ]);

        $this->reset('content');
        $this->dispatch('comment-created.'.$this->post->id);
    }

    public function render()
    {
        return view('livewire.create-comment');
    }
}
