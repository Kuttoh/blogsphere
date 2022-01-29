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
        $paragraphsCount = $this->faker->numberBetween(5, 10);

        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraphs($paragraphsCount, true),
            'publication_date' => $this->faker->dateTimeThisDecade(),
            'author_id' => $this->faker->numberBetween(2,11) //reserve admin blogs for feed
        ];
    }
}
