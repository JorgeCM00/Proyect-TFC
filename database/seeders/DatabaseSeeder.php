<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            //llamamos a todos los seeders excepto a cesta porque cesta es el único q no lo veo necesario, pero funcionaria correctamente
            users_seeder::class,
            afiliados_seeder::class,
            clientes_seeder::class,
            etiqueta_producto_seeder::class,
            etiquetas_seeder::class,
            pedidos_seeder::class,
            perfil_seeder::class,
            producto_pedido_seeder::class,
            productos_seeder::class,
            redes_seeder::class,

        ]);
    }
}
