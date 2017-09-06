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
            $table->char('id_vid',32)->unique();
            $table->string('title_vid',100);
            $table->string('url_vid',200);
            $table->string('thumbnail_vid',128)->nullable();
            $table->string('small_thumbnail_vid',128)->nullable();
            $table->string('tags_vid',200)->nullable();
            $table->string('duration_vid',10)->nullable();
            $table->tinyInteger('viewer_vid')->nullable();
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
        Schema::dropIfExists('videos');
    }
}
