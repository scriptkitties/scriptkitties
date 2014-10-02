<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPermissions extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_permissions', function($table) {
            $table->integer('user_id')->unsigned();
            $table->boolean('bbs')->default(false);
            $table->boolean('bot')->default(false);
            $table->boolean('pages')->default(false);
            $table->boolean('user')->default(false);
            $table->boolean('wiki')->default(false);

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
        Schema::drop('user_permissions');
    }

}
