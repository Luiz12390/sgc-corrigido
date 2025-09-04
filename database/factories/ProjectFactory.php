<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => 'Projeto de ' . $this->faker->bs(),
            'description' => $this->faker->paragraph(2),
            'status' => $this->faker->randomElement(['Em Andamento', 'Concluído', 'Planejamento']),
            'cover_image_path' => 'https://picsum.photos/seed/' . $this->faker->unique()->word() . '/440/280',
            'start_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'end_date' => $this->faker->dateTimeBetween('now', '+1 year'),
        ];
    }
}