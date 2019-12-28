<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('region')->nullable();
            $table->string('city')->nullable();
            $table->bigInteger('part_id')->unsigned();
            $table->string('part_name')->nullable();
            $table->string('part_code')->nullable();
            $table->integer('count')->unsigned();
            $table->float('price', 18, 2)->unsigned();
            $table->integer('real_price')->unsigned()->nullable();
            $table->float('sum', 18, 2)->unsigned();
            $table->float('real_sum', 18, 2)->unsigned()->nullable();
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
        Schema::dropIfExists('applications');
    }
}
