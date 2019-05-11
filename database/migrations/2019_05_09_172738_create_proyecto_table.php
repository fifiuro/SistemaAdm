<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyectoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyecto', function (Blueprint $table) {
            $table->bigIncrements('id_pro');
            $table->unsignedBigInteger('id_dist');
            $table->foreign('id_dist')
                  ->references('id_dist')
                  ->on('distrito')
                  ->onDelete('cascade');
            $table->unsignedBigInteger('id_ges');
            $table->foreign('id_ges')
                  ->references('id_ges')
                  ->on('gestion')
                  ->onDelete('cascade');
            $table->unsignedBigInteger('id_uni');
            $table->foreign('id_uni')
                  ->references('id_uni')
                  ->on('unidad')
                  ->onDelete('cascade');
            $table->string('nombre_pro',255);
            $table->string('ubicacion',255);
            $table->integer('ema');
            $table->date('fecha_reg');
            $table->double('presupuesto',20,4);
            $table->double('programado',20,4);
            $table->string('adjudicacion',255);
            $table->date('fecha_adjudicacion');
            $table->string('numero_adjudicacion',50);
            $table->boolean('estado');
            $table->string('observaciones')->nullable();
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
        Schema::dropIfExists('proyecto');
    }
}
