<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Component;

class PostComments extends Component
{
    public Post $post;

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    #[On('comment-created.{post.id}')]
    public function refreshComments()
    {
    }

    public function render()
    {
        $comments = $this->post->comments()->with('user')->get();

        return view('livewire.post-comments', ['comments' => $comments]);
    }

    public function deleteComment($commentId)
    {
        $comment = \App\Models\Comment::findOrFail($commentId);

        if (auth()->user()->can('delete', $comment)) {
            $comment->delete();
        }
    }
}
