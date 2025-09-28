<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Organization;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Challenge>
 */
class ChallengeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => ucwords($this->faker->bs()),
            'type' => $this->faker->randomElement(['Artigo', 'Relatório', 'Estudo de Caso', 'Desafio Aberto']),
            'description' => $this->faker->paragraph(3),
            'cover_image_path' => 'https://picsum.photos/seed/' . $this->faker->unique()->word() . '/440/280',
            'user_id' => User::inRandomOrder()->first()->id,
            'organization_id' => Organization::inRandomOrder()->first()->id,
        ];
    }
}
