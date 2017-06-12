<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event', 0, 1)->nullable();
            $table->integer('file', 0, 1)->nullable();
            $table->integer('thumb', 0, 1)->nullable();
            $table->timestamps();

            $table->foreign('event')->references('id')->on('events');
            $table->foreign('file')->references('id')->on('files');
            $table->foreign('thumb')->references('id')->on('files');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
