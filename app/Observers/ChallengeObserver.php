<?php

namespace App\Observers;

use App\Models\Challenge;

class ChallengeObserver
{
    public function created(Challenge $challenge): void
    {
        $challenge->recordActivity('created_challenge');
    }
}
