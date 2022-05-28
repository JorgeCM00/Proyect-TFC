<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class redes_seeder extends Seeder
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
        DB::table('redes_sociales')->delete();
        for ($i = 0; $i < 10; $i++) {
            DB::table('redes_sociales')->insert([
                'afiliado_user_id' => \rand(1, 300),
                'bio' => Str::random(50),
                'twitter' => Str::random(10),
                'insta' => Str::random(10),
                'created_at' => $date->toDateTimeString(),
                'updated_at' => $date->toDateTimeString(),
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
