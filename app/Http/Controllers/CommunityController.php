<?php

namespace App\Http\Controllers;

use App\Models\Community;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CommunityController extends Controller
{
    use AuthorizesRequests;

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

    public function show(Community $community)
    {
        $community->load(['user', 'members']);

        return view('communities.show', [
            'community' => $community
        ]);
    }

    public function manageMembers(Community $community)
    {
        $this->authorize('update', $community);

        return view('communities.manage-members', ['community' => $community]);
    }

    public function create()
    {
        return view('communities.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $validatedData['user_id'] = auth()->id();
        $community = Community::create($validatedData);
        $community->members()->attach(auth()->id(), ['role' => 'admin']);

        return redirect()->route('communities.show', $community)->with('status', 'Comunidade criada com sucesso!');
    }
}
