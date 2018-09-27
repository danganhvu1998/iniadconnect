<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->integer('point')->default('0');
            $table->integer('gold')->default('0');
            $table->integer('language')->default('0');//Japanese
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('image')->default('cover_default.png');
            $table->string('card_image')->nullable();
            $table->integer('type')->default('0');//Unconfirmed User
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
