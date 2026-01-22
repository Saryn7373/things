<?php

namespace Database\Factories;

use App\Models\Place;
use App\Models\Thing;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'thing_id' => Thing::factory(),
            'place_id' => Place::factory(),
            'user_id'  => User::factory(),
            'amount'   => $this->faker->numberBetween(1, 5),
        ];
    }
}