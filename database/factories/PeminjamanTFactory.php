<?php

namespace Database\Factories;

use App\Models\Books;
use App\Models\Pegawai;
use App\Models\Pengunjung;
use Illuminate\Database\Eloquent\Factories\Factory;

class PeminjamanTFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $books_id = Books::pluck('id');
        $pengunjung_id = Pengunjung::pluck('id');
        $pegawai_id = Pegawai::pluck('id');

        return [
            'no_peminjaman' => $this->faker->regexify('[A-Z]{5}[0-9]{5}'),
            'books_id' => $this->faker->randomElement($books_id),
            'pengunjung_id' => $this->faker->randomElement($pengunjung_id),
            'pegawai_id' => $this->faker->randomElement($pegawai_id),
            'status' => 0,


        ];
    }
}
