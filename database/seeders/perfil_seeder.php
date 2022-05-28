<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class perfil_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('perfil')->delete();
        for($i=0;$i<10;$i++){
            DB::table('perfil')->insert([
        'user_id'=> \rand(1,300),
        'foto' =>"images.png",
        'ruta' =>Str::random(20),
        'descripcion'=> Str::random(20),	
        'pais'=>Str::random(20),
        'ciudad'=> Str::random(20),
        'CP'=>\rand(10000,99999),
        'calle_numero'=> Str::random(20),	
        'piso_puerta_bloque'=> 	Str::random(20),
        'created_at'=>$date->toDateTimeString(),
        'updated_at'=>$date->toDateTimeString(),
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
