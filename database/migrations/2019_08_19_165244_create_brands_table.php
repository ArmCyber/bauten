<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->collation('utf8_general_ci')->unique();
            $table->string('name')->nullable();
            $table->text('short')->nullable();
            $table->text('description')->nullable();
            $table->string('image', 64)->nullable();
            $table->string('image_alt')->nullable();
            $table->string('image_title')->nullable();
            $table->string('url');
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->boolean('in_home')->default(0);
            $table->bigInteger('sort')->unsigned()->default(0);
            $table->boolean('active')->default(1);
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
        Schema::dropIfExists('brands');
    }
}
