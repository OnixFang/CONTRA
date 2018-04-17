<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyColumIdPemsumToNullableTableCiclo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ciclo', function (Blueprint $table) {
            $table->unsignedInteger('id_pensum')->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ciclo', function (Blueprint $table) {
            $table->unsignedInteger('id_pensum')->change();
        });
    }
}
