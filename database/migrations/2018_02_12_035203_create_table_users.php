<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('register_time');
            $table->string('pin', 4);
            $table->string('image', 100);
            $table->string('username', 100)->unique();
            $table->string('name', 100);
            $table->string('email', 100);
            $table->string('password');
            $table->string('phone', 100)->unique();
            $table->string('secretcode')->unique();
            $table->integer('status');
            $table->string('roles', 100);
            $table->string('remember_token');
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
