<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModificacionsTable extends Migration
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
            $table->string('tabla');
            $table->integer('id');
            $table->string('anterior');
            $table->string('actual');
            $table->date('fecha');
            $table->integer('use_id');
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
