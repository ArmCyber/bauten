<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEngineMarkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('engine_mark', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('engine_id')->unsigned();
            $table->integer('mark_id')->unsigned();
            $table->foreign('engine_id')->references('id')->on('engines')->onDelete('cascade');
            $table->foreign('mark_id')->references('id')->on('marks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('engine_mark');
    }
}
