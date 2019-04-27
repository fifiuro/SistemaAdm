<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdMacDistritoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('distrito', function (Blueprint $table) {
            $table->unsignedBigInteger('id_mac');
            $table->foreign('id_mac')
                  ->references('id_mac')
                  ->on('macro')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('distrito', function (Blueprint $table) {
            $table->dropForeign('distrito_id_mac_foreign');
            $table->dropColumn('id_mac');
        });
    }
}
