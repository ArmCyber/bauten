<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_points', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->integer('region_id')->unsigned()->unique();
            $table->integer('price')->unsigned()->default(0);
            $table->integer('sort')->unsigned()->default(0);
            $table->boolean('active')->default(1);
            $table->timestamps();
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_points');
    }
}
