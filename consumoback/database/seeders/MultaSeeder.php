<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MultaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('multas')->insert([
            ["titulo"=>'USO INDEBIDO DE LA LICENCIA DE FUNCIONAMIENTO'], //1
            ["titulo"=>'INCUMPLIMIENTO DEL HORARIO'], ///2
            ["titulo"=>'NEGACION DE COOPERACION O ACCESO AL CONTROL'], //3
            ["titulo"=>'EXPENDIO Y COMERCIALIZACION DE BEBIDAS ALCOHOLICAS A MENORES DE 18'], //4
            ["titulo"=>'PERMITIR EL INGRESO Y ATENCION DE PERSONAS EN ESTADO DE EMBRIAGUEZ A ESTABLECIMIENTOS DE EXPENDIO DE BEBIDAS ALCOHOLICAS'], //5
            ["titulo"=>'ADULTERACION DE BEBIDAS'],//6
            ["titulo"=>'NO EXHIBIR LA LICENCIA Y/O AUTORIZACION DE EXPENDIO, CONSUMO Y/O PRODUCCION DE BEBIDAS ALCOHOLICAS'],//7
            ["titulo"=>'NO EXHIBIR EL LETRERO DE HORARIO DE ATENCION'],//8
            ["titulo"=>'NO EXHIBIR LA FICHA DE INSPECCION E HIGIENE'],//9
            ["titulo"=>'FALTA DE ASEO E HIGUIENE EN EL RECINTO'],//10
            ["titulo"=>'FALTA DE CUMPLIMIENTO A LAS CONDICIONES TECNICAS DE INFRAESTRUCTURA'],//11
            ["titulo"=>'FALTA DE CUMPLIMIENTO A LAS CONDICIONES MEDIO AMBIENTE Y SEGURIDAD'],//12
            ["titulo"=>'CONSUMO EN ESTABLECIMIENTOS CONSIGNADOS EN CATEBORIA B'],//13
            ["titulo"=>'INSTALACION DE SISTEMA DE SONIDO EXTERNO'],//14
            ["titulo"=>'DESARROLLAR ACTIVIDADES A PUERTAS CERRADAS'],//15/
            ["titulo"=>'ROMPER Y/O CUBRIR PRECINTOS DE CLAUSURA'],//16
            ["titulo"=>'PRESTAR SERVICIOS EN ESTADO DE EBRIEDAD'],//17
            ["titulo"=>'AGRESION FISICA, VERBAL Y/O PSICOLOGICA A SERVIDORES PUBLICOS'],//18
            ["titulo"=>'SUPERAR LA CAPACIDAD FISICA DEL INMUEBLE'],//19
            ["titulo"=>'ALMACENAR MATERIALES QUE IMPLIQUEN RIESGOS PARA LA VIDA'],//20
            ["titulo"=>'PORTAR ARMAS BLANCAS Y/O DE FUEGO'],//21
            ["titulo"=>'CONTRATAR A MENORES DE EDAD'],//22
         ]);
    }
}
