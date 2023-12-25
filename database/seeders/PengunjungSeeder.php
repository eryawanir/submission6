<?php

namespace Database\Seeders;

use App\Models\Pengunjung;
use Illuminate\Database\Seeder;

class PengunjungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pengunjung::factory()->count(5)->create();
    }
}
