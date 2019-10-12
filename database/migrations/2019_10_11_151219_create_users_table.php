<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('type')->unsigned()->default(1);
            $table->integer('manager_id')->unsigned()->nullable();
            $table->string('name')->nullable();
            $table->string('last_name')->nullable();
            $table->integer('region_id')->unsigned()->nullable();
            $table->string('country_name')->nullable();
            $table->string('region_name')->nullable();
            $table->string('city')->nullable();
            $table->string('phone')->nullable();
            $table->string('company')->nullable();
            $table->string('bin')->nullable();
            $table->string('email')->collation('utf8_general_ci')->unique();
            $table->string('password');
            $table->string('verification', 64)->nullable();
            $table->boolean('active')->default(1);
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
        Schema::dropIfExists('users');
    }
}
