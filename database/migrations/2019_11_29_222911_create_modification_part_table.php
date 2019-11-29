<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModificationPartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modification_part', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('modification_id')->unsigned();
            $table->bigInteger('part_id')->unsigned();
            $table->foreign('modification_id')->references('id')->on('modifications')->onDelete('cascade');
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
        Schema::dropIfExists('modification_part');
    }
}
