<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModificacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modificacion', function (Blueprint $table) {
            $table->bigIncrements('id_mod');
            $table->string('tabla',50);
            $table->bigInteger('id');
            $table->string('anterior',255);
            $table->string('actual',255);
            $table->date('fecha');
            $table->unsignedBigInteger('usr_id');
            $table->foreign('usr_id')
                  ->references('id')
                  ->on('users');
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
        Schema::dropIfExists('modificacion');
    }
}
