<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEngineCriteriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('engine_criteria', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('engine_filter_id')->unsigned();
            $table->string('title')->nullable();
            $table->integer('sort')->unsigned()->default(0);
            $table->timestamps();
            $table->foreign('engine_filter_id')->references('id')->on('engine_filters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('engine_criteria');
    }
}
