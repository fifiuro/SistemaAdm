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
            $table->foreign('id_dist')->references('id_dist')->on('distrito')->onDelete('cascade');
            $table->string('nombre_pro');
            $table->integer('ema');
            $table->double('presupuesto','15','4');
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
        Schema::dropIfExists('proyecto');
    }
}
