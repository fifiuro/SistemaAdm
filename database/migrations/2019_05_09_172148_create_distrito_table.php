<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistritoTable extends Migration
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
            $table->unsignedBigInteger('id_mac');
            $table->foreign('id_mac')
                  ->references('id_mac')
                  ->on('macro')
                  ->onDelete('cascade');
            $table->string('nombre_dis',255);
            $table->string('numero_dis',255);
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
