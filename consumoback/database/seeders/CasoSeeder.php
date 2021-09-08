<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CasoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('casos')->insert([
           ["clasificacion"=>'DISCOTECA','caso'=>'DE MARTES  A SABADO','inicio'=>"20:00",'fin'=>'03:00','tipo'=>'A'],
            ["clasificacion"=>'KARAOKE','caso'=>'DE MARTES  A SABADO','inicio'=>"20:00",'fin'=>'03:00','tipo'=>'A'],
            ["clasificacion"=>'ESTABLECIMIENTO DE COMERCIALIZACION DE BEBIDAS ALCOHOLICAS','caso'=>'TODOS LOS DIAS','inicio'=>"09:00",'fin'=>'10:00','tipo'=>'B'],
            ["clasificacion"=>'PLANTA DE ELABORACION Y/O PRODUCCION DE BEBIDAS ALCOHOLICAS','caso'=>'DE ACUERDO A HORARIO LABORAL','inicio'=>"08:00",'fin'=>'18:00','tipo'=>'B'],
        ]);
    }
}
