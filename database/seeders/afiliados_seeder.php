<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class afiliados_seeder extends Seeder
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
        DB::table('afiliados')->delete();
        for($i=0;$i<10;$i++){
            DB::table('afiliados')->insert([
                'user_id'=>\rand(1,300),
                'CIF'=>\rand(10000000,99999999),
                'nombreEmpresa'=>Str::random(20),
                'formaJuridica'=>"EmpIndividual",
                'tlf'=>\rand(600000000,699999999),
                'created_at'=>$date->toDateTimeString(),
                'updated_at'=>$date->toDateTimeString(),
            ]);
    }
    DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
}
}