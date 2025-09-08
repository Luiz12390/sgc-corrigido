<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommunityFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => 'Comunidade de ' . $this->faker->bs(),
            'description' => $this->faker->paragraph(2),
            'cover_image_path' => 'https://picsum.photos/seed/' . $this->faker->unique()->word() . '/400/240',
        ];
    }
}
