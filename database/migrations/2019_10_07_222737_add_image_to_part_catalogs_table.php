<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageToPartCatalogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('part_catalogs', function (Blueprint $table) {
            $table->string('image', 64)->nullable()->after('url');
            $table->string('image_alt')->nullable()->after('image');
            $table->string('image_title')->nullable()->after('image_alt');
            $table->string('in_home')->nullable()->after('image_alt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('part_catalogs', function (Blueprint $table) {
            $table->dropColumn('image', 'image_alt', 'image_title');
        });
    }
}
