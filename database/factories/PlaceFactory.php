<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PlaceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'        => $this->faker->words(2, true) . ' место',
            'description' => $this->faker->sentence(8),
            'repair'      => $this->faker->boolean(15),
            'work'        => $this->faker->boolean(90),
        ];
    }
}   