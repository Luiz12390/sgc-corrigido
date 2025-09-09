<?php

namespace App\Livewire;

use App\Models\Project;
use App\Models\ProjectJoinRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RequestToJoinProjectButton extends Component
{
    public Project $project;
    public ?string $status = null;

    public function mount()
    {
        if (Auth::check()) {
            $existingRequest = ProjectJoinRequest::where('user_id', Auth::id())
                ->where('project_id', $this->project->id)
                ->first();

            if ($existingRequest) {
                $this->status = $existingRequest->status;
            }
        }
    }

    public function sendRequest()
    {
        if (!Auth::check()) {
            return $this->redirect(route('login'), navigate: true);
        }

        $isMember = $this->project->members()->where('user_id', Auth::id())->exists();
        if ($isMember || $this->status) {
            return;
        }

        ProjectJoinRequest::create([
            'user_id' => Auth::id(),
            'project_id' => $this->project->id,
        ]);

        $this->status = 'pendente';
    }

    public function render()
    {
        return view('livewire.request-to-join-project-button');
    }
}