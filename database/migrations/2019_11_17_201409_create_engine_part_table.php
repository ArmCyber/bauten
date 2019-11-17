<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnginePartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('engine_part', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('engine_id')->unsigned();
            $table->bigInteger('part_id')->unsigned();
            $table->foreign('engine_id')->references('id')->on('engines')->onDelete('cascade');
            $table->foreign('part_id')->references('id')->on('parts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('engine_part');
    }
}
