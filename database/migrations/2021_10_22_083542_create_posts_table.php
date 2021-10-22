<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->string("title");
            $table->text("content");
            $table->binary("image")->nullabe();
            $table->integer("num_likes");
            $table->integer("num_comments");
            $table->integer("num_unique_views");
            $table->dateTime("date_of_creation");
            $table->timestamps();

            $table->foreign("user_id")->references("id")->on("users")
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
