<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerfilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfil', function (Blueprint $table) {
            $table->bigInteger('user_id')->primary()->unsigned();
            $table->string('foto')->nullable();
            $table->string('ruta')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('pais')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('CP')->nullable();
            $table->string('calle_numero')->nullable();
            $table->string('piso_puerta_bloque')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perfil');
    }
}
