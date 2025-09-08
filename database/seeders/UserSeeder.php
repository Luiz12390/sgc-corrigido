<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@sgc.com'],
            [
                'name' => 'Admin SGC',
                'password' => Hash::make('admin@sgc.com'),
                'title' => 'Dono da Organização',
            ]
        );

        User::firstOrCreate(
            ['email' => 'teste@sgc.com'],
            [
                'name' => 'Utilizador de Teste',
                'password' => Hash::make('password'),
                'title' => 'Desenvolvedor na SGC',
            ]
        );

        User::firstOrCreate(
            ['email' => 'amelia.silva@uffs.edu.br'],
            [
                'name' => 'Dr. Amelia Silva',
                'password' => Hash::make('password'),
                'title' => 'Pesquisadora na UFFS',
            ]
        );

        User::factory(10)->create();
    }
}
