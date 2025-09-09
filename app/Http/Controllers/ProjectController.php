<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProjectController extends Controller
{
    use AuthorizesRequests;

    public function index($filter = null)
    {
        $query = Project::query();

        if ($filter === 'meus-projetos') {
            $query->whereHas('members', function($q) {
                $q->where('user_id', auth()->id());
            });
        }

        $projects = $query->latest()->paginate(10);
        return view('projects.index', ['projects' => $projects]);
    }

    public function show(Project $project)
    {
        $project->load('members', 'tasks.user');

        return view('projects.show', ['project' => $project]);
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'objectives' => 'required|string',
            'cover_image_path' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('cover_image_path')) {
            $path = $request->file('cover_image_path')->store('project-covers', 'public');
            $validatedData['cover_image_path'] = $path;
        }

        $project = Project::create($validatedData);

        if ($project) {
            $project->members()->attach(auth()->id());
        }

        return redirect()->route('projects.index')->with('status', 'Projeto criado com sucesso!');
    }

    public function edit(Project $project)
    {
        return view('projects.edit', ['project' => $project]);
    }

    public function update(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'objectives' => 'required|string',
            'cover_image_path' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('cover_image_path')) {
            if ($project->cover_image_path) {
                Storage::disk('public')->delete($project->cover_image_path);
            }
            $validatedData['cover_image_path'] = $request->file('cover_image_path')->store('project-covers', 'public');
        }

        $project->update($validatedData);

        return redirect()->route('projects.show', $project)->with('status', 'Projeto atualizado com sucesso!');
    }

    public function destroy(Project $project)
    {
        if ($project->cover_image_path) {
            Storage::disk('public')->delete($project->cover_image_path);
        }

        $project->delete();

        return redirect()->route('projects.index')->with('status', 'Projeto excluído com sucesso!');
    }

    public function members(Project $project)
    {
        return view('projects.members', [
            'project' => $project,
        ]);
    }

    public function tasks(Project $project)
    {
        $project->load('tasks.user', 'members');

        return view('projects.tasks', [
            'project' => $project
        ]);
    }

    public function manageMembers(Project $project)
    {
        $this->authorize('update', $project);

        return view('projects.manage-members', ['project' => $project]);
    }
}
