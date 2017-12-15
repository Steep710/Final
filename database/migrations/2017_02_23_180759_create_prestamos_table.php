<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrestamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idDispositivo')->unsigned();
            $table->integer('idUsuario')->unsigned();
            $table->date('fecha_devolucion');
            $table->time('hora_devolucion');
            $table->string('estado');
            $table->string('telefono');
            $table->string('entregadoPor');
            $table->foreign('idDispositivo')->references('id')->on('dispositivos');
            $table->foreign('idUsuario')->references('id')->on('usuarios');
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
        Schema::drop('prestamos');
    }
}
