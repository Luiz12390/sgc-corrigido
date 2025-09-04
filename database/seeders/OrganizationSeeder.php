<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Organization;

class OrganizationSeeder extends Seeder
{
    public function run(): void
    {
        Organization::create([
            'name' => 'SGC Platform',
            'description' => 'A organização principal da plataforma SGC-Chapecó.',
        ]);

        Organization::create([
            'name' => 'Universidade Federal da Fronteira Sul (UFFS)',
            'description' => 'Instituição de ensino superior pública federal brasileira.',
        ]);

        Organization::factory(5)->create();
    }
}