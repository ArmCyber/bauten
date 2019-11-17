<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartCatalogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('part_catalogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->collation('utf8_general_ci')->unique();
            $table->string('url');
            $table->string('image', 64)->nullable();
            $table->string('image_alt')->nullable();
            $table->string('image_title')->nullable();
            $table->string('in_home')->nullable();
            $table->bigInteger('sort')->unsigned()->default(0);
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
        Schema::dropIfExists('part_catalogs');
    }
}
