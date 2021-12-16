<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::factory()->count(10)->create();

        foreach($posts as $post) {
            //get a random number of users
            $users = User::all()->random(random_int(0, User::all()->count()));
            foreach($users as $user) {
                $post->userViews()->attach($user->id);
                //50-50 chance that a user will like the post
                $willLike = (random_int(0,100) % 2) == 0;
                if($willLike) {
                    $post->likedUsers()->attach($user->id);
                }
            }
        }
    }
}

