<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThingFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'        => $this->faker->words(3, true),
            'description' => $this->faker->paragraph(2),
            'wrnt'        => $this->faker->dateTimeBetween('now', '+3 years')->format('Y-m-d'),
            'user_id'     => User::factory()
        ];
    }
}