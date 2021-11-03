<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RequisitoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('requisitos')->insert([
            ['nombre'=>'CERTIFICADO SEGURIDAD CIUDADANA','tipo'=>'A'],
            ['nombre'=>'FORMULARIO EMPADRONAMIENTO','tipo'=>'A'],
            ['nombre'=>'FOTOCOPIA DE IMPUESTOS INMUEBLE Y TASAS POR SERVICIO','tipo'=>'A'],
            ['nombre'=>'COPIA CEDULA DE IDENTIDAD','tipo'=>'A'],
            ['nombre'=>'FOTOC. LEGALIZADA DEL TESTIMONIO DE PROPIEDAD DEL INMUEBLE Y FOLIO REAL ACTUALIZADO','tipo'=>'A'],
            ['nombre'=>'FOTOC. LEGALIZADA DE ALQUILER O MINUTA','tipo'=>'A'],
            ['nombre'=>'FOTOC. PADRON VIGENTE DE LA ACTIVIDAD ECON.','tipo'=>'A'],
            ['nombre'=>'3 FOTOS 3X3 FONDO VERDE','tipo'=>'A'],
            ['nombre'=>'CERTIFICADO DE ANTECEDENTES FELCC Y FELCN DEL TITTULAR','tipo'=>'A'],
            ['nombre'=>'FOTOC. DEL NIT','tipo'=>'A'],
            ['nombre'=>'FOTOC. DEL ROE','tipo'=>'A'],
            ['nombre'=>'INFRAESTRUCTURA','tipo'=>'A'],
            ['nombre'=>'SEGURIDAD','tipo'=>'A'],
            ['nombre'=>'MEDIO AMBIENTE','tipo'=>'A'],
            ['nombre'=>'SALUBRIDAD','tipo'=>'A'],

            ['nombre'=>'FOTOC. LEGALIZADA REGISTRO DE COMERCIO FUNDEMPRESA','tipo'=>'B'],
            ['nombre'=>'FOTOC. LEGALIZADA DE LA CONSTITUCION DE LA SOCIEDAD','tipo'=>'B'],
            ['nombre'=>'FOTOC. LEGALIZADA DEL PODER DEL REPRESENTANTE','tipo'=>'B'],
            ['nombre'=>'FOTOCOPIA CI REPRESENTANTE LEGAL ','tipo'=>'B'],

            ['nombre'=>'FOTOC. LEGALIZADA DE AUTORIZACION SANITARIA','tipo'=>'C'],
            ['nombre'=>'FOTOC. LEGALIZADA DEL INFORME DE ENSAYOS DE LABORATORIOS','tipo'=>'C'],
            ['nombre'=>'FOTOC. LEGALIZADA DEL INFORME DE RESULTADOS DEL LABORATORIOS','tipo'=>'C'],
            ['nombre'=>'FICHA DE INSPECCION POR DEFENSA AL CONSUMIDOR','tipo'=>'C'],
            ['nombre'=>'REGISTRO AMBIENTAL DE DIRECCION DE SALUD AMBIENTAL','tipo'=>'C'],

        ]);
    }
}
