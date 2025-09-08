<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $projectsWithMembers = Project::has('members')->get();

        foreach ($projectsWithMembers as $project) {
            $members = $project->members;

            Task::factory(rand(3, 5))->create([
                'project_id' => $project->id,
                'user_id' => $members->random()->id,
            ]);
        }
    }
}
