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
            $table->integer('model_id')->unsigned()->default(0);
            $table->bigInteger('generation_id')->unsigned()->default(0);
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
