<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIrcNicks extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('irc_nicks', function($table) {
            $table->integer('user_id')->unsigned();
            $table->string('nick', 64)->unique();
            $table->boolean('verified')->default(false);
            $table->string('verification', 32)->default('');

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('irc_nicks');
    }

}
