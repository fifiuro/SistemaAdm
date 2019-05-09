<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstimadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimado', function (Blueprint $table) {
            $table->bigIncrements('id_est');
            $table->unsignedBigInteger('id_pro');
            $table->foreign('id_pro')
                  ->references('id_pro')
                  ->on('proyecto')
                  ->onDelete('cascade');
            $table->date('fecha');
            $table->double('volumen',20,4);
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
        Schema::dropIfExists('estimado');
    }
}
