<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PegawaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_pegawai' => $this->faker->name(),
            'no_telp' => $this->faker->numerify('08#-###-####'),
            'email' => $this->faker->email(),

        ];
    }
}
