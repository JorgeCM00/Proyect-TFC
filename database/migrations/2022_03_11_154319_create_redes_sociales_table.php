<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRedesSocialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redes_sociales', function (Blueprint $table) {
            $table->bigInteger('afiliado_user_id')->primary()->unsigned();
            $table->string('bio')->nullable();
            $table->string('twitter')->nullable()->unique();
            $table->string('insta')->nullable()->unique();
            $table->timestamps();
            $table->foreign('afiliado_user_id')->references('user_id')->on('afiliados')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('redes_sociales');
    }
}
