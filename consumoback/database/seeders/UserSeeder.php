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
           ]
        ]);
    }
}
