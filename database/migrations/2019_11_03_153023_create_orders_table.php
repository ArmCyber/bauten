<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('delivery')->default(0);
            $table->string('address')->nullable();
            $table->integer('region_id')->unsigned()->nullable();
            $table->string('region_name')->nullable();
            $table->integer('city_id')->unsigned()->nullable();
            $table->string('city_name')->nullable();
            $table->float('sum')->unsigned()->default(0);
            $table->float('delivery_price')->unsigned()->default(0);
            $table->float('total')->unsigned()->default(0);
            $table->enum('payment_method', ['cash', 'bank', 'online'])->default('cash');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('sale')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
