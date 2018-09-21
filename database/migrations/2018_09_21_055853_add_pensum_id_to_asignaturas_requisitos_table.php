<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPensumIdToAsignaturasRequisitosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asignaturas_requisitos', function (Blueprint $table) {
            $table->unsignedInteger('pensum_id');
            $table->foreign('pensum_id')->references('id')->on('pensums');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asignaturas_requisitos', function (Blueprint $table) {
            //
        });
    }
}
