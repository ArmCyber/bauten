<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddContentToPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('image', 64)->nullable()->after('static');
            $table->string('image_alt')->nullable()->after('image');
            $table->string('image_title')->nullable()->after('image_alt');
            $table->boolean('show_image')->default(1)->after('image_title');
            $table->text('content')->nullable()->after('show_image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            //
        });
    }
}
