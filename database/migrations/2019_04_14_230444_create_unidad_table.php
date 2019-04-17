<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnidadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidad', function (Blueprint $table) {
            $table->bigIncrements('id_uni');
            $table->unsignedBigInteger('id_ges');
            $table->foreign('id_ges')
                  ->references('id_ges')
                  ->on('gestion')
                  ->onDelete('cascade');
            $table->string('unidad_ejecutora');
            $table->date('fecha_reg');
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
        Schema::dropIfExists('unidad');
    }
}
