<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer("user_id");
            $table->integer("master_post_id");
            $table->integer("upper_post_id");
            $table->integer('upvote')->default(0);
            $table->integer('gold')->default(0);
            $table->integer("level")->nullable();
            $table->string('title');
            $table->text('content')->nullable();
            $table->string('image')->nullable();
            $table->string('more_image')->nullable();
            $table->timestamps();
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
