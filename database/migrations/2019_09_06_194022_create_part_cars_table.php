<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('part_cars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('part_id')->unsigned();
            $table->integer('mark_id')->unsigned();
            $table->integer('model_id')->unsigned()->nullable();
            $table->bigInteger('generation_id')->unsigned()->nullable();
            $table->foreign('part_id')->references('id')->on('parts')->onDelete('cascade');
            $table->foreign('mark_id')->references('id')->on('marks')->onDelete('cascade');
            $table->foreign('model_id')->references('id')->on('models')->onDelete('cascade');
            $table->foreign('generation_id')->references('id')->on('generations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('part_cars');
    }
}
