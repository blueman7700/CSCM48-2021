<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
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
        $num_users = User::all()->count();

        return [
            //
            'commentable_id' => Post::all()->random()->id,
            'commentable_type' => Post::class,
            'content' => $this->faker->sentence(),
            'num_likes' => $this->faker->numberBetween(0, $num_users),
            'date_of_creation' => now()
        ];
    }
}

