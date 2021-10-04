<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetallemultaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('detallemultas')->insert([
            ['multa_id'=>1,'titulo'=>'Primera Vez','monto'=>'2000','dia'=>'10'],
            ['multa_id'=>1,'titulo'=>'Reincidencia','monto'=>'3000','dia'=>'INDEFINIDO'],
            ['multa_id'=>2,'titulo'=>'Primera Vez','monto'=>'3000','dia'=>'10'],
            ['multa_id'=>2,'titulo'=>'Reincidencia','monto'=>'0','dia'=>'INDEFINIDO'],
            ['multa_id'=>3,'titulo'=>'Primera Vez','monto'=>'2000','dia'=>'0'],
            ['multa_id'=>3,'titulo'=>'Reincidencia','monto'=>'0','dia'=>'INDEFINIDO'],
            ['multa_id'=>4,'titulo'=>'Primera Vez','monto'=>'10000','dia'=>'10'],
            ['multa_id'=>4,'titulo'=>'Reincidencia','monto'=>'0','dia'=>'INDEFINIDO'],
            ['multa_id'=>5,'titulo'=>'Primera Vez','monto'=>'5000','dia'=>'10'],
            ['multa_id'=>5,'titulo'=>'Reincidencia','monto'=>'0','dia'=>'INDEFINIDO'],
            ['multa_id'=>6,'titulo'=>'Primera Vez','monto'=>'10000','dia'=>'0'],
            ['multa_id'=>6,'titulo'=>'Reincidencia','monto'=>'15000','dia'=>'INDEFINIDO'],
            ['multa_id'=>7,'titulo'=>'Primera Vez','monto'=>'500','dia'=>'0'],
            ['multa_id'=>7,'titulo'=>'Segunda Vez','monto'=>'1000','dia'=>'10'],
            ['multa_id'=>7,'titulo'=>'Tercera Vez','monto'=>'','dia'=>'INDEFINIDO'],
            ['multa_id'=>8,'titulo'=>'Primera Vez','monto'=>'800','dia'=>'0'],
            ['multa_id'=>8,'titulo'=>'Segunda Vez','monto'=>'1000','dia'=>'10'],
            ['multa_id'=>8,'titulo'=>'Tercera Vez','monto'=>'','dia'=>'INDEFINIDO'],
            ['multa_id'=>9,'titulo'=>'Primera Vez','monto'=>'1000','dia'=>'0'],
            ['multa_id'=>9,'titulo'=>'Segunda Vez','monto'=>'2000','dia'=>'10'],
            ['multa_id'=>9,'titulo'=>'Tercera Vez','monto'=>'','dia'=>'INDEFINIDO'],
            ['multa_id'=>10,'titulo'=>'Primera Vez','monto'=>'1000','dia'=>'0'],
            ['multa_id'=>10,'titulo'=>'Segunda Vez','monto'=>'2000','dia'=>'10'],
            ['multa_id'=>10,'titulo'=>'Tercera Vez','monto'=>'','dia'=>'INDEFINIDO'],
            ['multa_id'=>11,'titulo'=>'Primera Vez','monto'=>'500','dia'=>'0'],
            ['multa_id'=>11,'titulo'=>'Segunda Vez','monto'=>'1000','dia'=>'10'],
            ['multa_id'=>11,'titulo'=>'Tercera Vez','monto'=>'','dia'=>'INDEFINIDO'],
            ['multa_id'=>12,'titulo'=>'Primera Vez','monto'=>'1000','dia'=>'0'],
            ['multa_id'=>12,'titulo'=>'Segunda Vez','monto'=>'2000','dia'=>'10'],
            ['multa_id'=>12,'titulo'=>'Tercera Vez','monto'=>'','dia'=>'INDEFINIDO'],
            ['multa_id'=>13,'titulo'=>'Primera Vez','monto'=>'1000','dia'=>'0'],
            ['multa_id'=>13,'titulo'=>'Segunda Vez','monto'=>'2000','dia'=>'10'],
            ['multa_id'=>13,'titulo'=>'Tercera Vez','monto'=>'','dia'=>'INDEFINIDO'],
            ['multa_id'=>14,'titulo'=>'Primera Vez','monto'=>'1000','dia'=>'0'],
            ['multa_id'=>14,'titulo'=>'Segunda Vez','monto'=>'2000','dia'=>'10'],
            ['multa_id'=>14,'titulo'=>'Tercera Vez','monto'=>'','dia'=>'INDEFINIDO'],
            ['multa_id'=>15,'titulo'=>'Primera Vez','monto'=>'3000','dia'=>'10'],
            ['multa_id'=>15,'titulo'=>'Reincidencia','monto'=>'','dia'=>'INDEFINIDO'],
            ['multa_id'=>16,'titulo'=>'Primera Vez','monto'=>'1000','dia'=>'0'],
            ['multa_id'=>16,'titulo'=>'Segunda Vez','monto'=>'2000','dia'=>'0'],
            ['multa_id'=>17,'titulo'=>'Primera Vez','monto'=>'1000','dia'=>'0'],
            ['multa_id'=>17,'titulo'=>'Segunda Vez','monto'=>'2000','dia'=>'10'],
            ['multa_id'=>17,'titulo'=>'Tercera Vez','monto'=>'','dia'=>'INDEFINIDO'],
            ['multa_id'=>18,'titulo'=>'Primera Vez','monto'=>'3000','dia'=>'15'],
            ['multa_id'=>18,'titulo'=>'Reincidencia','monto'=>'','dia'=>'INDEFINIDO'],
            ['multa_id'=>19,'titulo'=>'Primera Vez','monto'=>'1000','dia'=>'0'],
            ['multa_id'=>19,'titulo'=>'Segunda Vez','monto'=>'2000','dia'=>'10'],
            ['multa_id'=>19,'titulo'=>'Tercera Vez','monto'=>'','dia'=>'INDEFINIDO'],
            ['multa_id'=>20,'titulo'=>'Primera Vez','monto'=>'500','dia'=>'0'],
            ['multa_id'=>20,'titulo'=>'Segunda Vez','monto'=>'1000','dia'=>'10'],
            ['multa_id'=>20,'titulo'=>'Tercera Vez','monto'=>'','dia'=>'INDEFINIDO'],
            ['multa_id'=>21,'titulo'=>'Primera Vez','monto'=>'1000','dia'=>'0'],
            ['multa_id'=>21,'titulo'=>'Segunda Vez','monto'=>'2000','dia'=>'10'],
            ['multa_id'=>21,'titulo'=>'Tercera Vez','monto'=>'','dia'=>'INDEFINIDO'],
            ['multa_id'=>22,'titulo'=>'Primera Vez','monto'=>'10000','dia'=>'10'],
            ['multa_id'=>22,'titulo'=>'Reincidencia','monto'=>'','dia'=>'INDEFINIDO']
        ]);
    }
}
