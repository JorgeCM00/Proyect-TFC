<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('afiliado_id')->unsigned();
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('imagen');
            $table->string('ruta');
            $table->bigInteger('stock')->unsigned();
            $table->smallInteger('IVA')->unsigned();
            $table->float('precio')->unsigned();
            $table->timestamps();
            $table->foreign('afiliado_id')->references('user_id')->on('afiliados')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
