<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('place')->nullable();
            $table->string('title',100);
            $table->string('desc',200)->nullable();
            $table->string('slug',120);
            $table->string('id_playlist',70)->nullable();
            $table->timestamps();
        });

        DB::table('pages')->insert([
            ['place'=>'chartprambors','title'=>'40 Top Chart Prambors - OkeMusik.com','desc'=>'','slug'=>'40-top-chart-prambors-radio','id_playlist'=>'PL6IUAQO_M1ocSuO66RvBo1ZmdZxVrZx_q'],
            ['place'=>'chartindonesia','title'=>'40 Top Chart Indonesia - OkeMusik.com','desc'=>'','slug'=>'40-top-chart-musik-indonesia','id_playlist'=>'PLZxoHTd-fyrgT-u_JelQ2qsrqvR8yIRF7']
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
