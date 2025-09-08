<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => ucfirst($this->faker->words(3, true)),
            'status' => $this->faker->randomElement(['Não Iniciado', 'Pendente', 'Em Andamento', 'Concluído']),
            'due_date' => $this->faker->dateTimeBetween('+1 week', '+3 months'),
        ];
    }
}
