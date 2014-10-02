<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPreferences extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_preferences', function($table) {
            $table->integer('user_id')->unsigned();
            $table->boolean('bbs_anonymize')->default(false);
            $table->string('language', 2)->default('en');
            $table->string('theme')->default('default');
            $table->boolean('trap')->default(false);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_preferences');
    }

}
