<?php

namespace App\Http\Controllers;

use App\Models\Community;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    /**
     * Exibe a página principal de eventos e a lista de comunidades.
     */
    public function index()
    {
        $communities = Community::latest()->get();

        return view('communities.index', [
            'communities' => $communities,
        ]);
    }
}
