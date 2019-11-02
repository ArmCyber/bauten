<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_cities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('region_id')->unsigned();
            $table->integer('price')->unsigned()->default(0);
            $table->foreign('region_id')->references('id')->on('delivery_regions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_cities');
    }
}
