<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ResourceController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $resources = Resource::with('user')->latest()->paginate(12);
        return view('resources.index', ['resources' => $resources]);
    }

    public function create()
    {
        return view('resources.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'nullable|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,zip,ppt,pptx|max:20480',
        ]);

        $path = $request->file('file')->store('resource_files', 'public');

        Resource::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'type' => $validated['type'],
            'file_path' => $path,
        ]);

        return redirect()->route('recursos.index')->with('status', 'Recurso enviado com sucesso!');
    }

    public function show(Resource $recurso)
    {
        return view('resources.show', ['resource' => $recurso]);
    }

    public function edit(Resource $recurso)
    {
        $this->authorize('update', $recurso);
        return view('resources.edit', ['resource' => $recurso]);
    }

    public function update(Request $request, Resource $recurso)
    {
        $this->authorize('update', $recurso);
        return redirect()->route('resources.show', $recurso)->with('status', 'Recurso atualizado!');
    }

    public function destroy(Resource $recurso)
    {
        $this->authorize('delete', $recurso);

        if ($recurso->file_path) {
            Storage::disk('public')->delete($recurso->file_path);
        }
        $recurso->delete();

        return redirect()->route('resources.index')->with('status', 'Recurso excluído!');
    }
}
