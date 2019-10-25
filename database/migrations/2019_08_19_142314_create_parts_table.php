<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->collation('utf8_general_ci')->unique();
            $table->string('name')->nullable();
            $table->integer('price')->unsigned();
            $table->integer('available')->unsigned()->nullable();
            $table->integer('min_count')->unsigned()->default(1);
            $table->integer('multiplication')->unsigned()->default(1);
            $table->string('image', 64)->nullable();
            $table->boolean('show_image')->default(1);
            $table->string('oem')->nullable();
            $table->text('description')->nullable();
            $table->string('url')->nullable();
            $table->bigInteger('part_catalog_id')->unsigned();
            $table->bigInteger('brand_id')->unsigned();
            $table->boolean('active')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parts');
    }
}
