<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeguimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seguimientos')->insert([
            [
                'nombre'=>"ENVIADO A DIRECCION TRIBUTARIA",
                'observacion'=>"INICIADO",
                'fecha'=>"2021-09-09",
                'hora'=>"10:00",
                "tramite_id"=>"1",
                "user_id"=>"1",
            ]
        ]);
    }
}
