<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsignaturasRequisitosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignaturas_requisitos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('asignatura_id');
            $table->foreign('asignatura_id')->references('id')->on('asignaturas');

            $table->unsignedInteger('requisito_id');
            $table->foreign('requisito_id')->references('id')->on('asignaturas');
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
        Schema::dropIfExists('asignaturas_requisitos');
    }
}
