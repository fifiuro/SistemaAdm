<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteIdUniMacroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('macro', function (Blueprint $table) {
            $table->dropForeign('macro_id_uni_foreign');
            $table->dropColumn('id_uni');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('macro', function (Blueprint $table) {
            $table->unsignedBigInteger('id_uni');
            $table->foreign('id_uni')
                  ->references('id_uni')
                  ->on('unidad')
                  ->onDelete('cascade');
        });
    }
}
