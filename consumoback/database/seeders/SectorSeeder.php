<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('sectors')->insert([
            ["id"=>1,"detalle"=>"INDUSTRIA EN GENERAL"],                    
            ["id"=>2,"detalle"=>"INDUSTRIAS PRODUCTOS ESPECIFICOS"],
            ["id"=>3,"detalle"=>"SERVICIOS FINANCIEROS Y SIMILARES"],     
            ["id"=>4,"detalle"=>"EMPRESA DE SEGUROS Y REASEGUROS"],    
            ["id"=>5,"detalle"=>"SERVICIOS ESPECIFICOS"],      
            ["id"=>6,"detalle"=>"SERVICIOS DE TRANSPORTE"],                
            ["id"=>7,"detalle"=>"ACTIVIDAD HOTELERA"],              
            ["id"=>8,"detalle"=>"ACTIVIDAD INDUSTRIAL PROFESIONAL"],
            ["id"=>9,"detalle"=>"SERVICIOS EN GENERAL"],     
            ["id"=>10,"detalle"=>"COMERCIO EN GENERAL"],                  
            ["id"=>11,"detalle"=>"ACTIVIDAD MINERA"],                  
            ["id"=>12,"detalle"=>"ARTESANIAS EN GENERAL"]                   
        ]);
    
    }
}
