<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            "title" => $this->faker->word(),
            "description" => $this->faker->paragraph(),
            "photo"=> $this->faker->imageUrl(),
            "publication_date"=> now(),
            "published" => true,
            "author_id" => Arr::random([1,2,3,4]),
        ];
    }
}