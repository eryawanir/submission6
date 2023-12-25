<?php

namespace Database\Seeders;

use App\Models\PeminjamanT;
use Illuminate\Database\Seeder;

class PeminjamanTSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PeminjamanT::factory()->count(5)->create();
    }
}
