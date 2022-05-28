<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class etiqueta_producto_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
  
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('etiqueta_producto')->delete();
        for ($i = 0; $i < 10; $i++) {
            DB::table('etiqueta_producto')->insert([
                'producto_id'=>\rand(1, 300),
                'etiqueta_id'=>\rand(1, 300),
                
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
