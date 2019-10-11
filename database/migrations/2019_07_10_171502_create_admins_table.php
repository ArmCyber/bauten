<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->collation('utf8_general_ci')->unique()->nullable();
            $table->string('name')->nullable();
            $table->string('email')->collation('utf8_general_ci')->unique();
            $table->string('phone')->collation('utf8_general_ci')->unique()->nullable();
            $table->boolean('active')->default(1);
            $table->tinyInteger('role')->default(0);
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('admins');
    }
}
