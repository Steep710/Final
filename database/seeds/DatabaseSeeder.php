<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
        'name'      => 'Administrador',
        'email'     => 'admin@gmail.com',
        'password'  => bcrypt('qwerty'),
      ]);
      DB::table('tipo_usuarios')->insert([
        ['nombre'      => 'Visitante', 'estado' => 'Habilitado'],
        ['nombre'      => 'Estudiante', 'estado' => 'Habilitado'],
        ['nombre'      => 'Profesor', 'estado' => 'Habilitado']
      ]);

      DB::table('servicios')->insert([
        ['nombre'      => 'Sala', 'estado' => 'Habilitado'],
        ['nombre'      => 'Prestamo Audiovisuales', 'estado' => 'Habilitado'],
        ['nombre'      => 'Prestamo de Libros', 'estado' => 'Habilitado'],
        ['nombre'      => 'Oficinas Administrativas', 'estado' => 'Habilitado'],
        ['nombre'      => 'Sala de Ex-Decanos', 'estado' => 'Habilitado'],
        ['nombre'      => 'Otros', 'estado' => 'Habilitado']
      ]);

      DB::table('carreras')->insert([
        ['nombre'      => 'Ninguna', 'estado' => 'Habilitada'],
        ['nombre'      => 'Ingeniería Mecatrónica', 'estado' => 'Habilitada'],
        ['nombre'      => 'Ingenieria TICE', 'estado' => 'Habilitada'],
        ['nombre'      => 'Ingeniería Industrial', 'estado' => 'Habilitada'],
        ['nombre'      => 'DOMSER', 'estado' => 'Habilitada'],
        ['nombre'      => 'Técnico TICE', 'estado' => 'Habilitada'],
        ['nombre'      => 'Negocios', 'estado' => 'Habilitada'],
        ['nombre'      => 'Inglés', 'estado' => 'Habilitada'],
        ['nombre'      => 'Técnico Mecatrónica', 'estado' => 'Habilitada']
      ]);
    }
}
