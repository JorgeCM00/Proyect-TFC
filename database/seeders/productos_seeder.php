<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class productos_seeder extends Seeder
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
        DB::table('productos')->delete();
        for ($i = 0; $i < 10; $i++) {
            DB::table('productos')->insert([
                'afiliado_id' => \rand(1, 300),
                'nombre' => Str::random(10),
                'descripcion' => Str::random(50),
                'imagen' => "Producto.jpeg",
                'ruta' => "",
                'stock' => 20,
                'IVA' => 21,
                'precio' => \rand(1, 100),
                'created_at' => $date->toDateTimeString(),
                'updated_at' => $date->toDateTimeString(),
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
