<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistritosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distrito', function (Blueprint $table) {
            $table->bigIncrements('id_dist');
            $table->unsignedBigInteger('id_uni');
            $table->foreign('id_uni')
                  ->references('id_uni')
                  ->on('unidad')
                  ->onDelete('cascade');
            $table->string('nombre_dis');
            $table->string('numero_dis');
            $table->string('ubicacion');
            $table->boolean('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distrito');
    }
}
