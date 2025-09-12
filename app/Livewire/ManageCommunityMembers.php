<?php

namespace App\Livewire;

use App\Models\Community;
use App\Models\CommunityJoinRequest;
use Livewire\Component;

class ManageCommunityMembers extends Component
{
    public Community $community;

    public function mount(Community $community)
    {
        $this->community = $community;
    }

    public function approveRequest($requestId)
    {
        $request = CommunityJoinRequest::find($requestId);

        if ($request && $request->status === 'pendente') {
            $request->update(['status' => 'aprovado']);
            $this->community->members()->attach($request->user_id);
            $this->community->refresh();
        }
    }

    public function rejectRequest($requestId)
    {
        $request = CommunityJoinRequest::find($requestId);

        if ($request && $request->status === 'pendente') {
            $request->update(['status' => 'recusado']);
            $this->community->refresh();
        }
    }

    public function render()
    {
        $pendingRequests = $this->community->joinRequests()->where('status', 'pendente')->with('user')->get();
        $currentMembers = $this->community->members;

        return view('livewire.manage-community-members', [
            'pendingRequests' => $pendingRequests,
            'currentMembers' => $currentMembers
        ]);
    }
}
