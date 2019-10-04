<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenerationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('model_id')->unsigned();
            $table->string('name')->nullable();
            $table->bigInteger('sort')->unsigned()->default(0);
            $table->boolean('active')->default(1);
            $table->foreign('model_id')->references('id')->on('models')->onDelete('cascade');
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
        Schema::dropIfExists('generations');
    }
}
