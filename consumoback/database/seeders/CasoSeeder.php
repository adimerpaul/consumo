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
            ["clasificacion"=>'DISCOTECA','caso'=>'DE MARTES A SABADO','inicio'=>"20:00",'fin'=>'03:00','tipo'=>'A'],
            ["clasificacion"=>'DISCOTECA','caso'=>'DOMINGO Y FERIADOS','inicio'=>"20:00",'fin'=>'02:00','tipo'=>'A'],
            ["clasificacion"=>'KARAOKE','caso'=>'DE MARTES A SABADO','inicio'=>"20:00",'fin'=>'03:00','tipo'=>'A'],
            ["clasificacion"=>'KARAOKE','caso'=>'DOMINGO Y FERIADOS','inicio'=>"20:00",'fin'=>'03:00','tipo'=>'A'],
            ["clasificacion"=>'CLUB NOCTURNO','caso'=>'DE MARTES A SABADO','inicio'=>"20:00",'fin'=>'03:00','tipo'=>'A'],
            ["clasificacion"=>'CLUB NOCTURNO','caso'=>'DOMINGO Y FERIADOS','inicio'=>"20:00",'fin'=>'03:00','tipo'=>'A'],
            ["clasificacion"=>'VIDEO BAR','caso'=>'DE MARTES A SABADO','inicio'=>"20:00",'fin'=>'03:00','tipo'=>'A'],
            ["clasificacion"=>'VIDEO BAR','caso'=>'DOMINGO Y FERIADOS','inicio'=>"20:00",'fin'=>'03:00','tipo'=>'A'],
            
            ["clasificacion"=>'CAFE PUB','caso'=>'DE MARTES A SABADO','inicio'=>"20:00",'fin'=>'03:00','tipo'=>'A'],
            ["clasificacion"=>'CAFE PUB','caso'=>'DOMINGO Y FERIADOS','inicio'=>"20:00",'fin'=>'03:00','tipo'=>'A'],
            
            ["clasificacion"=>'QUINTA','caso'=>'DE MARTES A DOMINGO Y FERIADOS','inicio'=>"10:00",'fin'=>'22:00','tipo'=>'A'],
            ["clasificacion"=>'CHICHERIA','caso'=>'DE MARTES A DOMINGO Y FERIADOS','inicio'=>"10:00",'fin'=>'21:00','tipo'=>'A'],
            
            ["clasificacion"=>'SALON DE EVENTOS SOCIALES DE BAILE Y ESPECTACULOS PUBLICOS','caso'=>'HORARIO ESPECIAL','inicio'=>"15:00",'fin'=>'21:00','tipo'=>'A'],
            ["clasificacion"=>'CLUB SOCIAL','caso'=>'DE ACUERDO A SU ACTIVIDAD','inicio'=>"15:00",'fin'=>'21:00','tipo'=>'A'],
            
            ["clasificacion"=>'ESTABLECIMIENTO DE COMERCIALIZACION DE BEBIDAS ALCOHOLICAS','caso'=>'TODOS LOS DIAS','inicio'=>"09:00",'fin'=>'22:00','tipo'=>'B'],
            ["clasificacion"=>'PLANTA DE ELABORACION Y/O PRODUCCION DE BEBIDAS ALCOHOLICAS','caso'=>'DE ACUERDO A HORARIO LABORAL','inicio'=>"08:00",'fin'=>'18:00','tipo'=>'B'],
            ["clasificacion"=>'SUPERMERCADO, MICROMERCADO','caso'=>'TODOS LOS DIAS','inicio'=>"09:00",'fin'=>'22:00','tipo'=>'B'],
            ["clasificacion"=>'LICORERIA','caso'=>'TODOS LOS DIAS','inicio'=>"20:00",'fin'=>'03:00','tipo'=>'B'],
            ["clasificacion"=>'AGENCIA DE COMERCIALIZACION DE BEBIDAS ALCOHOLICAS','caso'=>'TODOS LOS DIAS','inicio'=>"09:00",'fin'=>'22:00','tipo'=>'B'],

        ]);
    }
}
