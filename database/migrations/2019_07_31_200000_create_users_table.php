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
            $table->increments('id');
            $table->string('name');
            $table->string('usuariox');
            $table->string('aspect')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('superiors_id')->unsigned()->nullable();
            $table->foreign('superiors_id')->references('id')->on('superiors');
            $table->integer('cargos_id')->unsigned()->nullable();
            $table->foreign('cargos_id')->references('id')->on('cargos');
            $table->integer('ilha_id')->unsigned()->nullable();
            $table->foreign('ilha_id')->references('id')->on('ilhas');
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
