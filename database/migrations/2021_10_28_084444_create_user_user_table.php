<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_user', function (Blueprint $table) {
            $table->primary(['user_id', 'follower_id']);
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('follower_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->
                on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('follower_id')->references('id')->
                on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_user');
    }
}

