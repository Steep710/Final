<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->increments('id');
            $table->string("nombreSupervisor");
            $table->integer("cedula");
            $table->integer("cantidadAlumno");
            $table->integer("idCarrera")->unsigned();
            $table->string("asunto");
            $table->time("horaInicio");
            $table->time("horaFinal");
            $table->foreign('idCarrera')->references('id')->on('carreras');
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
        Schema::drop('grupos');
    }
}
