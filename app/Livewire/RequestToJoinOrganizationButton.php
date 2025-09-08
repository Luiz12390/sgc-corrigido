<?php

namespace App\Livewire;

use App\Models\JoinRequest;
use App\Models\Organization;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RequestToJoinOrganizationButton extends Component
{
    public Organization $organization;
    public ?string $status = null;

    public function mount()
    {
        $this->checkRequestStatus();
    }

    public function checkRequestStatus()
    {
        if (Auth::check()) {
            $existingRequest = JoinRequest::where('user_id', Auth::id())
                ->where('organization_id', $this->organization->id)
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

        $isMember = $this->organization->members()->where('user_id', Auth::id())->exists();
        if ($isMember || $this->status) {
            return;
        }

        JoinRequest::create([
            'user_id' => Auth::id(),
            'organization_id' => $this->organization->id,
            'status' => 'pendente',
        ]);

        $this->status = 'pendente';
    }

    public function render()
    {
        return view('livewire.request-to-join-organization-button');
    }
}
