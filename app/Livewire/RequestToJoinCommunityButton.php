<?php

namespace App\Livewire;

use App\Models\Community;
use App\Models\CommunityJoinRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RequestToJoinCommunityButton extends Component
{
    public Community $community;
    public ?string $status = null;

    public function mount()
    {
        $this->checkRequestStatus();
    }

    public function checkRequestStatus()
    {
        if (Auth::check()) {
            $existingRequest = CommunityJoinRequest::where('user_id', Auth::id())
                ->where('community_id', $this->community->id)
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

        $isMember = $this->community->members()->where('user_id', Auth::id())->exists();

        if ($isMember || $this->status) {
            return;
        }

        CommunityJoinRequest::create([
            'user_id' => Auth::id(),
            'community_id' => $this->community->id,
            'status' => 'pendente',
        ]);

        $this->status = 'pendente';
    }

    public function render()
    {
        return view('livewire.request-to-join-community-button');
    }
}
