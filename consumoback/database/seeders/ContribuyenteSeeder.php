<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContribuyenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("contribuyentes")->insert([
            [
                "padron"=>"1-1-1-1",
                "representante"=>"ALEJANDRO LOPEZ",
                "razon"=>"ALE",
                "cedula"=>"1010",
                "expedido"=>"OR",
                "telefono"=>"1010",
                "direccion"=>"calle x",
                "direccionrazon"=>" calle x",
                "cargo"=>"FEJE",
                "tipo"=>"N",
                "mts2"=>"20",
                "gest"=>"2020",
                "ruc"=>"1010",
                "descripcion"=>"TIENDA DE BARRIO",
            ]
        ]);
    }
}
