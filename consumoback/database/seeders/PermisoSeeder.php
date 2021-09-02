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
            ["id"=>3,"nombre"=>"Formulario 19"],
            ["id"=>4,"nombre"=>"Firma regulacion tecnica"],
            ["id"=>5,"nombre"=>"Verificar documentacion"],
        ]);
    }
}
