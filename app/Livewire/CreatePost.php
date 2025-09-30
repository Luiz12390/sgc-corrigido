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
        $this->validate([
            'content' => 'required|string|min:3',
            'files.*' => 'nullable|file|max:10240',
        ]);

        $post = $this->community->posts()->create([
            'user_id' => auth()->id(),
            'content' => $this->content,
            'post_type' => !empty($this->files) ? 'file' : 'text',
        ]);

        if (!empty($this->files)) {
            foreach ($this->files as $file) {
                $path = $file->store('attachments', 'public');
                $originalName = $file->getClientOriginalName();
                $post->attachments()->create([
                    'file_path' => $path,
                    'file_name' => $originalName,
                ]);
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
