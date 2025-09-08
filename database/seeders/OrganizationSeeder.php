<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Organization;
use App\Models\User;

class OrganizationSeeder extends Seeder
{
    public function run(): void
    {
        $adminUser = User::where('email', 'admin@sgc.com')->firstOrFail();
        $testUser = User::where('email', 'teste@sgc.com')->firstOrFail();
        $uffsUser = User::where('email', 'amelia.silva@uffs.edu.br')->firstOrFail();

        $orgAdmin = Organization::firstOrCreate(
            ['name' => 'Organização Admin'],
            [
                'owner_id' => $adminUser->id,
                'description' => 'A organização principal para testes e desenvolvimento da plataforma.',
                'type' => 'Empresa de Tecnologia',
                'specialization_areas' => 'Desenvolvimento de Software, IA, Aprendizado de Máquina',
                'competencies' => 'Desenvolvimento Ágil, Gestão de Projetos, Análise de Dados',
                'available_resources' => 'Computação em Nuvem, Ferramentas de Desenvolvimento',
            ]
        );

        $orgSGC = Organization::firstOrCreate(
            ['name' => 'SGC Platform'],
            [
                'owner_id' => $adminUser->id,
                'description' => 'A organização principal da plataforma SGC-Chapecó.'
            ]
        );

        $orgUFFS = Organization::firstOrCreate(
            ['name' => 'Universidade Federal da Fronteira Sul (UFFS)'],
            [
                'description' => 'Instituição de ensino superior pública federal brasileira.',
            ]
        );
         $orgAdmin->members()->syncWithoutDetaching([
            $adminUser->id => ['role' => 'owner', 'status' => 'approved']
        ]);
        $orgSGC->members()->syncWithoutDetaching([
            $testUser->id => ['role' => 'member', 'status' => 'approved']
        ]);
        $orgUFFS->members()->syncWithoutDetaching([
            $uffsUser->id => ['role' => 'member', 'status' => 'approved']
        ]);

        Organization::factory(5)->create();
    }
}
