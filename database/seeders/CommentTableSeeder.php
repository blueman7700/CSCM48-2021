<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\User;
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
        $postComments = Comment::factory()->count(10)->create();

        //add 2 comments to each post comment
        foreach($postComments as $c) {
            Comment::factory()->create([
                'commentable_id' => $c->id,
                'commentable_type' => Comment::class,
            ]);
        }

        $allComments = Comment::all();
        foreach($allComments as $comment) {
            $u = User::all()->random();
            $comment->likedUsers()->attach($u->id);
        }
    }
}

