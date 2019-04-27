<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteIdGesUnidadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('unidad', function (Blueprint $table) {
            $table->dropForeign('unidad_id_ges_foreign');
            $table->dropColumn('id_ges');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('unidad', function (Blueprint $table) {
            $table->unsignedBigInteger('id_ges');
            $table->foreign('id_ges')
                  ->references('id_ges')
                  ->on('gestion')
                  ->onDelete('cascade');
        });
    }
}
