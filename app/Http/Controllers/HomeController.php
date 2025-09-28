<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\Event;
use App\Models\Project;
use App\Models\Resource;
use App\Models\User;
use App\Models\Activity;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredChallenges = Challenge::latest()->take(2)->get();
        $ongoingProjects = Project::latest()->take(2)->get();
        $upcomingEvents = Event::where('start_date', '>=', now())->orderBy('start_date', 'asc')->take(2)->get();
        $recommendedResources = Resource::latest()->take(2)->get();
        $recentActivities = Activity::with(['user', 'subject'])->latest()->take(5)->get();
        $suggestedUsers = User::query()
            ->when(auth()->check(), fn ($query) => $query->where('id', '!=', auth()->id()))
            ->inRandomOrder()
            ->take(2)
            ->get();

        return view('home', [
            'featuredChallenges' => $featuredChallenges,
            'ongoingProjects' => $ongoingProjects,
            'upcomingEvents' => $upcomingEvents,
            'recommendedResources' => $recommendedResources,
            'suggestedUsers' => $suggestedUsers,
            'recentActivities' => $recentActivities,
        ]);
    }
}
