<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtiquetaProducto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etiqueta_producto', function (Blueprint $table) {
            $table->bigInteger('producto_id')->unsigned();
            $table->bigInteger('etiqueta_id')->unsigned();
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
            $table->foreign('etiqueta_id')->references('id')->on('etiquetas')->onDelete('cascade');
            
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('etiqueta_producto');
    }
}
