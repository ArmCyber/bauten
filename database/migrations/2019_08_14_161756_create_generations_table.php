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
            $table->string('cid')->collation('utf8_general_ci')->unique()->nullable();
            $table->integer('model_id')->unsigned();
            $table->string('name')->nullable();
            $table->mediumInteger('engine')->unsigned()->nullable();
            $table->smallInteger('year')->unsigned()->nullable();
            $table->smallInteger('year_to')->unsigned()->nullable();
            $table->boolean('active')->default(1);
            $table->foreign('model_id')->references('id')->on('models')->onDelete('cascade');
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
