<?php
namespace App\Livewire;

use App\Models\Community;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePost extends Component
{
    use WithFileUploads;

    public Community $community;

    #[Rule('required_without:files|min:3|max:5000')]
    public string $content = '';

    #[Rule(['files.*' => 'file|max:20480'])]
    public $files = [];

    public function mount(Community $community)
    {
        $this->community = $community;
    }

    public function save()
    {
        $this->validate();

        $post = $this->community->posts()->create([
            'user_id' => auth()->id(),
            'content' => $this->content,
            'post_type' => !empty($this->files) ? 'file' : 'text',
        ]);

        if (!empty($this->files)) {
            foreach ($this->files as $file) {
                $path = $file->store('post-attachments', 'public');
                if ($post && !$post->file_path) {
                    $post->update(['file_path' => $path]);
                }
            }
        }

        $this->reset(['content', 'files']);
        $this->dispatch('post-created');
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
