<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUpVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('up_votes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("user_id");
            $table->integer("target_id");
            $table->integer("target_type"); //1: Post, 2: Comment
            $table->integer("vote_type")->default(1); //1: Upvote, 10: Holy GOLD
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
        Schema::dropIfExists('up_votes');
    }
}
