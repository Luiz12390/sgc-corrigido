<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'title' => ucwords($this->faker->bs()), // Gera um título de "buzzword" capitalizado
            'type' => $this->faker->randomElement(['Artigo', 'Relatório', 'Estudo de Caso', 'Desafio Aberto']),
            'description' => $this->faker->paragraph(3), // Gera um parágrafo de 3 sentenças
            'cover_image_path' => 'https://picsum.photos/seed/' . $this->faker->unique()->word() . '/440/280', // Imagem aleatória
        ];
    }
}
