<?php
namespace App\Livewire;

use App\Models\Community;
use Livewire\Component;

class CommunityProfile extends Component
{
    public Community $community;
    public string $tab = 'feed';

    public function mount(Community $community)
    {
        $this->community = $community;
        $this->community->load(['user', 'members', 'posts.user', 'posts.comments']);
    }

    public function setTab(string $tabName)
    {
        $this->tab = $tabName;
    }

    public function render()
    {
        return view('livewire.community-profile');
    }
}
