<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $term = $request->input('q');

        if (empty($term)) {
            return redirect()->route('home');
        }

        $projects = Project::search($term)->get();
        $organizations = Organization::search($term)->get();
        $users = User::search($term)->get();

        return view('search.index', [
            'term' => $term,
            'projects' => $projects,
            'organizations' => $organizations,
            'users' => $users,
        ]);
    }
}
