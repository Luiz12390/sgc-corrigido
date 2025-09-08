<?php

namespace App\Livewire;

use App\Models\JoinRequest;
use App\Models\Organization;
use Livewire\Component;

class ManageJoinRequests extends Component
{
    public Organization $organization;

    public function mount(Organization $organization)
    {
        $this->organization = $organization;
    }

    public function approveRequest($requestId)
    {
        $request = JoinRequest::find($requestId);

        if ($request && $request->status === 'pendente') {
            $request->update(['status' => 'aprovado']);
            $this->organization->members()->attach($request->user_id);
            $this->organization->refresh();
        }
    }

    public function rejectRequest($requestId)
    {
        $request = JoinRequest::find($requestId);

        if ($request && $request->status === 'pendente') {
            $request->update(['status' => 'recusado']);

            $this->organization->refresh();
        }
    }

    public function render()
    {
        $pendingRequests = $this->organization->joinRequests()->where('status', 'pendente')->with('user')->get();
        $currentMembers = $this->organization->members;

        return view('livewire.manage-join-requests', [
            'pendingRequests' => $pendingRequests,
            'currentMembers' => $currentMembers
        ]);
    }
}
