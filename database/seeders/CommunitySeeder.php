<?php

namespace Database\Seeders;

use App\Models\Community;
use Illuminate\Database\Seeder;
use App\Models\User;

class CommunitySeeder extends Seeder
{
    public function run(): void
    {
        $adminUser = User::where('email', 'admin@sgc.com')->first();

        if ($adminUser) {
            $community = Community::updateOrCreate(
                ['name' => 'Comunidade de Inovadores'],
                [
                    'description' => 'Um espaço para conectar e colaborar em novas ideias.',
                    'user_id' => $adminUser->id
                ]
            );

            $community->members()->syncWithoutDetaching($adminUser->id, ['role' => 'admin']);
        }

        Community::factory(5)->create();
    }
}
