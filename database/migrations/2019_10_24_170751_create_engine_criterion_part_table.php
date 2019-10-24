<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEngineCriterionPartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('engine_criterion_part', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('engine_criterion_id')->unsigned();
            $table->bigInteger('part_id')->unsigned();
            $table->foreign('engine_criterion_id')->references('id')->on('engine_criteria')->onDelete('cascade');
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
        Schema::dropIfExists('engine_criterion_part');
    }
}
