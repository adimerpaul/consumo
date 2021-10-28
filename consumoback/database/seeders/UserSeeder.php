<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
           [
               "email"=>'admin@test.com',
               'celular'=>"69603027",
                'carnet'=>"7336199",
               "password"=>Hash::make('admin'),
               "name"=>"Administrador"
           ],
            [
                "email"=>'sandobal@test.com',
                'celular'=>"1111",
                'carnet'=>"1111",
                "password"=>Hash::make('123456'),
                "name"=>"EDDY SANDOBAL"
            ],
            [
                "email"=>'wilson@test.com',
                'celular'=>"2222",
                'carnet'=>"2222",
                "password"=>Hash::make('123456'),
                "name"=>"WILSON OLMOS LEAÑO"
            ],
            [
                "email"=>'cardenas@test.com',
                'celular'=>"3333",
                'carnet'=>"3333",
                "password"=>Hash::make('123456'),
                "name"=>"WILLIAM CARDENAS GUILLEN "
            ],
            [
                "email"=>'frojas@test.com',
                'celular'=>"4444",
                'carnet'=>"4444",
                "password"=>Hash::make('123456'),
                "name"=>"FATIMA ROJAS"
            ],
        ]);
    }
}
