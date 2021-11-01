<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // $c = new Comment;
        // $c->reply_id = 1;
        // $c->content = "Lorem Ipsum";
        // $c->num_likes = 0;
        // $c->date_of_creation = date('Y-m-d H-i-s');
        // $c->save();

        $postComments = Comment::factory()->count(5)->create();

        //add 2 comments to each post comment
        foreach($postComments as $c) {
            Comment::factory()->count(2)->create([
                'commentable_id' => $c->id,
                'commentable_type' => Comment::class,
            ]);
        }
    }
}
