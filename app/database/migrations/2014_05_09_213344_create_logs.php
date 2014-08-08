<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogs extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function($table) {
            $table->increments('id');
            $table->integer('executor')->unsigned();
            $table->integer('executed')->unsigned()->nullable();
            $table->string('trans');
            $table->string('old')->nullable();
            $table->string('new')->nullable();
            $table->dateTime('created_at');

            $table->foreign('executor')->references('id')->on('users');
            $table->foreign('executed')->references('id')->on('users');
        });

        Schema::table('preferences', function($table) {
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
        Schema::table('preferences', function($table) {
            $table->dropForeign('preferences_user_id_foreign');
        });

        Schema::drop('logs');
    }

}
