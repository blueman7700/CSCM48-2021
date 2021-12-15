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
            $u = User::all()->random();
            $post->likedUsers()->attach($u->id);
        }
    }
}

