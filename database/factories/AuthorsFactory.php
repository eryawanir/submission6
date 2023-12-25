<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'author_id' => $this->faker->unique()->uuid(),
            'author_name' => $this->faker->unique()->name(),
        ];
    }
}
