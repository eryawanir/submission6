<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AuthorsSeeder::class);
        $this->call(BooksSeeder::class);
        $this->call(PegawaiSeeder::class);
        $this->call(PengunjungSeeder::class);
        $this->call(PeminjamanTSeeder::class);
    }
}
