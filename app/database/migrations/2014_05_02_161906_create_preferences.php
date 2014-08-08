<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreferences extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preferences', function($table) {
            $table->integer('user_id')->unsigned()->unique();
            $table->string('language', 2)->default('en');
            $table->boolean('anonymize')->default(false);
            $table->string('theme', 32)->nullable();
            $table->string('desktop')->default();
            $table->string('irc_join')->default();
            $table->string('irc_part')->default();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('preferences');
    }

}
