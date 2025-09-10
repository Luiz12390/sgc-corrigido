<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use App\Models\Organization;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('id', '>', 2)->get();
        $adminUser = User::where('email', 'admin@sgc.com')->first();
        $orgAdmin = Organization::where('name', 'Organização Admin')->first();

        if ($users->isEmpty()) {
            Project::factory(12)->create();
            return;
        }

        if ($adminUser && $orgAdmin) {
             $project = Project::updateOrCreate(
                ['title' => 'Iniciativa Cidade Inteligente'],
                [
                    'description' => 'Desenvolvendo soluções para desafios urbanos.',
                    'organization_id' => $orgAdmin->id,
                    'user_id' => $adminUser->id,
                    'status' => 'Em Andamento',
                ]
            );

            $project->members()->syncWithoutDetaching($adminUser->id);
        }

        Project::factory(12)->create()->each(function ($project) use ($users) {
            $membersToAttach = $users->random(min(rand(2, 5), $users->count()));
            $project->members()->attach($membersToAttach);
        });
    }
}
