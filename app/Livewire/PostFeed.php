<?php

namespace App\Livewire;

use App\Models\Community;
use Livewire\Attributes\On;
use Livewire\Component;

class PostFeed extends Component
{
    public Community $community;

    public function mount(Community $community)
    {
        $this->community = $community;
    }

    #[On('post-created')]
    public function refreshFeed()
    {
    }

    public function render()
    {
        $posts = $this->community->posts()->with('user')->get();

        return view('livewire.post-feed', ['posts' => $posts]);
    }

    public function deletePost($postId)
    {
        $post = \App\Models\Post::findOrFail($postId);

        if (auth()->user()->can('delete', $post)) {
            $post->delete();
        }
    }
}
