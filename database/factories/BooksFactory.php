<?php

namespace Database\Factories;

use App\Models\Authors;
use Illuminate\Database\Eloquent\Factories\Factory;

class BooksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title_words = ['Aqidah', 'Fikih', 'Inggris', 'Indonesia'];
        $author_id = Authors::pluck('id');
        return [
            'book_name' => $this->faker->randomElement($title_words) . " JIlid " .
                $this->faker->numberBetween(1, 10),
            'author_id' => $this->faker->randomElement($author_id),
            'published_at' => $this->faker->date(),

        ];
    }
}
