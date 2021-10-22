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
            $table->bigInteger('user_id')->unsigned();
            $table->string('title')->default("Empty Title");
            $table->text('content');
            $table->binary('image')->nullable();
            $table->integer('num_likes')->default(0);
            $table->integer('num_comments')->default(0)->unsigned();
            $table->integer('num_unique_views')->default(0)->unsigned();
            $table->dateTime('date_of_creation');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
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
