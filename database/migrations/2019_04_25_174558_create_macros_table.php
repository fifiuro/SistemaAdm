<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMacrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('macro', function (Blueprint $table) {
            $table->bigIncrements('id_mac');
            $table->unsignedBigInteger('id_uni');
            $table->foreign('id_uni')
                  ->references('id_uni')
                  ->on('unidad')
                  ->onDelete('cascade');
            $table->string('nombre_mac');
            $table->string('numero_mac');
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
        Schema::dropIfExists('macro');
    }
}
