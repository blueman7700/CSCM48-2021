<?php

namespace Database\Seeders;

use App\Models\Post;
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
        //
        // $p = new Post;
        // $p->user_id = 1;
        // $p->title = "title";
        // $p->content = "Lorem Ipsum";
        // $p->image = null;
        // $p->num_likes = 0;
        // $p->num_unique_views = 0;
        // $p->date_of_creation = date('Y-m-d H-i-s');
        // $p->save();

        Post::factory()->count(10)->create();
    }
}
