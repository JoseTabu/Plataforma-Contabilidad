<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchivosclienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivoscliente', function (Blueprint $table) {

            $table->increments('id');
            $table->string('name')->unique();
            $table->string('ruta');
            $table->string('type');
            $table->string('size');
            $table->integer('procesado');
            $table->integer('clientes_id')->unsigned();
            $table->integer('usuario_id')->unsigned();
            $table->integer('grupo_id')->unsigned();
            $table->foreign('clientes_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('grupo_id')->references('id')->on('grupos_archivos')->onDelete('cascade');
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
        Schema::drop('archivoscliente');
    }
}
