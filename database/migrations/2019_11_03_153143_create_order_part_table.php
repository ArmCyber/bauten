<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderPartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_part', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_id')->unsigned();
            $table->bigInteger('part_id')->unsigned();
            $table->integer('count')->unsigned();
            $table->float('price', 18, 2)->unsigned();
            $table->integer('real_price')->unsigned()->nullable();
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->float('sum', 18, 2)->unsigned();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_part');
    }
}
