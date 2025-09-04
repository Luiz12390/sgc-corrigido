<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Exibe uma lista dos projetos.
     */
    public function index()
    {
        $projects = Project::latest()->paginate(10); // Paginação de 10 por página

        return view('projetos.index', [
            'projects' => $projects,
        ]);
    }
}