<?php

namespace App\Livewire;

use App\Models\Project;
use App\Models\ProjectJoinRequest;
use Livewire\Component;

class ManageProjectMembers extends Component
{
    public Project $project;

    public function mount(Project $project)
    {
        $this->project = $project;
    }

    public function approveRequest($requestId)
    {
        $request = ProjectJoinRequest::find($requestId);

        if ($request && $request->status === 'pendente') {
            $request->update(['status' => 'aprovado']);
            $this->project->members()->attach($request->user_id);
            $this->project->refresh();
        }
    }

    public function rejectRequest($requestId)
    {
        $request = ProjectJoinRequest::find($requestId);

        if ($request && $request->status === 'pendente') {
            $request->update(['status' => 'recusado']);
            $this->project->refresh();
        }
    }

    public function render()
    {
        $pendingRequests = $this->project->joinRequests()->where('status', 'pendente')->with('user')->get();
        $currentMembers = $this->project->members;

        return view('livewire.manage-project-members', [
            'pendingRequests' => $pendingRequests,
            'currentMembers' => $currentMembers
        ]);
    }
}