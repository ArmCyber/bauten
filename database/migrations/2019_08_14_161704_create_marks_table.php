<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cid')->unique()->nullable();
            $table->string('name')->nullable();
            $table->string('image', 64)->nullable();
            $table->string('image_alt')->nullable();
            $table->string('image_title')->nullable();
            $table->boolean('show_image')->default(1);
            $table->string('url')->nullable();
            $table->boolean('in_home')->default(0);
            $table->boolean('active')->default(1);
            $table->integer('sort')->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marks');
    }
}
