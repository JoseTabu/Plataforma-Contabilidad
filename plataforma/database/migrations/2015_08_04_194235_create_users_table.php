<?php

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
            $table->string('dni')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password',60);
            $table->integer('renueva')->default(0);
            $table->timestamps('fechapass')->nullable();
            $table->integer('gestoria_id')->unsigned();
            $table->integer('rol_id')->unsigned();
            $table->foreign('gestoria_id')->references('id')->on('gestoria')->onDelete('cascade');
            $table->foreign('dni')->references('dni')->on('clientes')->onDelete('cascade');
            $table->foreign('rol_id')->references('id')->on('roles')->onDelete('cascade');
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
        Schema::drop('users');
    }
}
