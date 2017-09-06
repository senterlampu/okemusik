<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDownloadAudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('download_audios', function (Blueprint $table) {
            $table->increments('id');
            $table->char('id_vid_down',32);
            // $table->string('type',32)->nullable();
            // $table->string('quality',32)->nullable();
            $table->string('size',32)->nullable();
            $table->string('url',200)->nullable();
            $table->string('ext',32)->nullable();
            // $table->string('res',32)->nullable();
            $table->string('abr',32)->nullable();
            $table->timestamps();

            $table->foreign('id_vid_down')->references('id_vid')->on('videos')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('download_audios');
    }
}
