<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(2),
            'start_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'cover_image_path' => 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=800' // Imagem de exemplo
        ];
    }
}
