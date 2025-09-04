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
        ]);

        $imagePath = null;
        if ($request->hasFile('cover_image_path')) {
            $imagePath = $request->file('cover_image_path')->store('challenge-covers', 'public');
        }

        Challenge::create([
            'title' => $validatedData['title'],
            'type' => $validatedData['type'],
            'description' => $validatedData['description'],
            'cover_image_path' => $imagePath ? 'storage/' . $imagePath : null,
        ]);

        return redirect()->route('challenges.index')->with('status', 'Desafio criado com sucesso!');
    }
}
