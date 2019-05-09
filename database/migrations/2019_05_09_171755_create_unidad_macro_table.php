<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnidadMacroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidad_macro', function (Blueprint $table) {
            $table->bigIncrements('id_um');
            $table->unsignedBigInteger('id_uni');
            $table->foreign('id_uni')
                  ->references('id_uni')
                  ->on('unidad')
                  ->onDelete('cascade');
            $table->unsignedBigInteger('id_mac');
            $table->foreign('id_mac')
                  ->references('id_mac')
                  ->on('macro')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('unidad_macro');
    }
}
