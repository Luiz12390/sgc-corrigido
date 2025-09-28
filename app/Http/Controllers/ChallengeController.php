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
        $challenges = Challenge::latest()->paginate(10);

        return view('challenges.index', [
            'challenges' => $challenges,
        ]);
    }

    public function show(Challenge $challenge)
    {
        return view('challenges.show', [
            'challenge' => $challenge,
        ]);
    }

     public function create()
    {
        return view('challenges.create');
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'type' => 'required|string',
        'description' => 'required|string',
        'cover_image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'organization_id' => 'required|exists:organizations,id',
    ]);

    $validatedData['user_id'] = auth()->id();

    if ($request->hasFile('cover_image_path')) {
        $validatedData['cover_image_path'] = $request->file('cover_image_path')->store('challenge-covers', 'public');
    }

    Challenge::create($validatedData);

    return redirect()->route('challenges.index')->with('status', 'Desafio criado com sucesso!');
}
}
