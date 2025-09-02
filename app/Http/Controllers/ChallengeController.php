<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
    /**
     * Exibe uma lista dos desafios.
     */
    public function index()
    {
        // Garanta que você está usando ->paginate() e não ->get() ou ->all()
        $challenges = Challenge::latest()->paginate(10);

        return view('challenges.index', [
            'challenges' => $challenges,
        ]);
    }
}
