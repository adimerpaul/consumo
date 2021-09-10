<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TramiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tramites')->insert([
            [
//                "nrotramite"=>"001/2021",
//                "fecha"=>"2020-09-09",
//                "hora"=>"10:00",
//                "tipo"=>"A",
//                "padron"=>"1-1-1-1",
//                "nro"=>"45465498",
//                "tramitador"=>"JOSE CANCECO",
//                "user_id"=>1,
//                "estado"=>"DIRECCION TRIBITARIA"

            "nrotramite"=>"0001/21",
            "fecha"=>"2021-09-08",
            "fechalimite"=>"2021-09-30",
            "hora"=>"10:00",
            "tipo"=>"A",
            "padron"=>"1-1-1-1",
            "estado"=>"DIRECCION TRIBUTARIA",
            "estado2"=>"ENPROCESO",
            "nro"=>"454545",
            "tramitador"=>"JOSE JOSE",
            'user_id'=>"1",
            'caso_id'=>"1",
                'contribuyente_id'=>"1",
            ]
        ]);

    }
}
