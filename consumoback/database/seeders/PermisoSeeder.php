<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permisos')->insert([
            ["id"=>1,"nombre"=>"Usuarios"],
            ["id"=>2,"nombre"=>"Registro tramite"],
            ["id"=>3,"nombre"=>"Direccion tributaria"],
            ["id"=>4,"nombre"=>"Infraestructura"],
            ["id"=>5,"nombre"=>"Seguridad ciudadana"],
            ["id"=>6,"nombre"=>"Medio ambiente"],
            ["id"=>7,"nombre"=>"Salubridad"],
            ["id"=>8,"nombre"=>"Actividades economicas"],
            ["id"=>9,"nombre"=>"Consultar tramite"],
            ["id"=>10,"nombre"=>"Entrega tramite"],
        ]);
    }
}
