<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BlogPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $blogLength = $this->faker->numberBetween(200, 300);

        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->text($blogLength),
            'publication_date' => $this->faker->dateTime(),
            'author_id' => $this->faker->numberBetween(2,10) //reserve admin blogs for feed
        ];
    }
}
