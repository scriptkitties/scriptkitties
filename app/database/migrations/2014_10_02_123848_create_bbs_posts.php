<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBbsPosts extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bbs_posts', function($table) {
            $table->increments('id');
            $table->integer('board_id')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable()->default(null);
            $table->integer('user_id')->unsigned();
            $table->string('file', 64)->nullable()->default(null);
            $table->string('extension', 8)->nullable()->default(null);
            $table->text('message')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bbs_posts');
    }

}
