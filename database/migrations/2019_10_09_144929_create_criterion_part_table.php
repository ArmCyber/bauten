<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCriterionPartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('criterion_part', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('criterion_id')->unsigned();
            $table->bigInteger('part_id')->unsigned();
            $table->foreign('criterion_id')->references('id')->on('criteria')->onDelete('cascade');
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
        Schema::dropIfExists('criterion_part');
    }
}
