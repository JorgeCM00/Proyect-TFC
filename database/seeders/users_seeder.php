<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class users_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<10;$i++){
        DB::table('users')->insert([
            'nombre'=>Str::random(10),
            'apellidos'=>Str::random(20),
            'username'=>Str::random(10),
            'email'=>Str::random(10).'@gmail.com',
            'password'=>Str::random(10)
        ]);
    }
    }
}
