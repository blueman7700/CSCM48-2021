<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

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
            'user_id' => User::all()->random()->id,
            'title' => $this->faker->word(),
            'content' => $this->faker->sentence(),
            'image' => null,
            'num_likes' => $this->faker->numberBetween(0, $num_users),
            'num_unique_views' => $this->faker->numberBetween(0, $num_users),
            'date_of_creation' => now()
        ];
    }
}

