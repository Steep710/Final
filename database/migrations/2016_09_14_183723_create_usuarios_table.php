<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('tipoUsuario')->unsigned();
            $table->foreign('tipoUsuario')->references('id')->on('tipo_usuarios');

            $table->integer('primerCarrera')->unsigned();
            $table->foreign('primerCarrera')->references('id')->on('carreras');

            $table->integer('segundaCarrera')->unsigned();
            $table->foreign('segundaCarrera')->references('id')->on('carreras');


            $table->string('cedula');
            $table->string('nombre');

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
        Schema::drop('usuarios');
    }
}
