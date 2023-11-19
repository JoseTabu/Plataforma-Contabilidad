<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGestoriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gestoria', function (Blueprint $table) {

            $table->increments('id');
            $table->string('dni');
            $table->string('clave');
            $table->string('nombre');
            $table->string('clave_clientes');
            $table->boolean('logo');
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
        Schema::drop('gestoria');
    }
}
