<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Pega as organizações que acabaram de ser criadas
        $org1 = Organization::find(1);
        $org2 = Organization::find(2);
        $otherOrgs = Organization::where('id', '>', 2)->get();

        // 1. Cria o usuário principal e o VINCULA à organização 1
        $user1 = User::factory()->create([
            'name' => 'Usuário de Teste',
            'email' => 'teste@sgc.com',
            'title' => 'Desenvolvedor na SGC',
        ]);
        // Usa o método attach() para criar o vínculo na tabela pivot
        $user1->organizations()->attach($org1->id, ['role' => 'owner', 'status' => 'approved']);

        // 2. Cria a "Dr. Amelia Silva" e a VINCULA à organização 2
        $user2 = User::factory()->create([
            'name' => 'Dr. Amelia Silva',
            'email' => 'amelia.silva@uffs.edu.br',
            'title' => 'Pesquisadora na UFFS',
        ]);
        $user2->organizations()->attach($org2->id, ['role' => 'member', 'status' => 'approved']);

        // 3. Cria 10 usuários aleatórios e os vincula a outras organizações
        User::factory(10)->create()->each(function ($user) use ($otherOrgs) {
            if ($otherOrgs->isNotEmpty()) {
                // Vincula o usuário a uma organização aleatória como 'membro'
                $user->organizations()->attach($otherOrgs->random()->id, ['role' => 'member', 'status' => 'approved']);
            }
        });
    }
}