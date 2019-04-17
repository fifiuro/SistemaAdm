<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMontoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monto', function (Blueprint $table) {
            $table->bigIncrements('id_mon');
            $table->unsignedBigInteger('id_pro');
            $table->foreign('id_pro')
                  ->references('id_pro')
                  ->on('proyecto')
                  ->onDelete('cascade');
            $table->date('fecha');
            $table->float('monto');
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
        Schema::dropIfExists('monto');
    }
}
