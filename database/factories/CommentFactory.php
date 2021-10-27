<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'reply_id' => $this->faker->numberBetween(1, 10),
            'content' => $this->faker->word(),
            'num_likes' => $this->faker->numberBetween(0, 1000),
            'date_of_creation' => now()
        ];
    }
}
