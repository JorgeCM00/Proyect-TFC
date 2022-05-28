<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cestas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('producto_id')->unsigned();
            $table->bigInteger('cliente_id')->unsigned();
            $table->integer('cantidad');
            $table->timestamps();
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
            $table->foreign('cliente_id')->references('user_id')->on('clientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cestas');
    }
}
