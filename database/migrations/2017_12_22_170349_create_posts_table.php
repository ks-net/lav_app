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
            $table->string('title', 255);
            $table->mediumtext('sortdesc')->nullable();
            $table->text('postbody')->nullable();
            $table->string('metatitle', 255)->nullable();
            $table->string('metakeywords', 255)->nullable();
            $table->string('metadesc', 255)->nullable();
            $table->string('seotitle',191)->unique();
            $table->integer('order')->default(0);
            $table->string('main_img',191)->unique()->nullable();
            $table->string('medium_img',191)->unique()->nullable();
            $table->string('thumb_img',191)->unique()->nullable();
            $table->boolean('active')->default(true);
            $table->integer('user_id')->unsigned();
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
