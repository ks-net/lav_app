<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('slug')->unique();
            $table->string('image', 255)->default('placeholder.png');
            $table->string('image_medium', 255)->default('placeholder.png');
            $table->string('image_thumb', 255)->default('placeholder.png');
            $table->string('image_original', 255)->nullable();
            $table->mediumtext('desc')->nullable();
            $table->tinyInteger('order')->default(0);
            $table->boolean('active')->default(true);
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
        Schema::dropIfExists('media');
    }
}