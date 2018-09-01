<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion');
            $table->string('clave');
            $table->datetime('horario')->nullable();
            $table->integer('bimestre')->nullable();

            $table->unsignedInteger('ciclo_id');
            $table->foreign('ciclo_id')->references('id')->on('ciclos');

            $table->unsignedInteger('asignatura_id');
            $table->foreign('asignatura_id')->references('id')->on('asignaturas');

            $table->unsignedInteger('facilitador_id');
            $table->foreign('facilitador_id')->references('id')->on('facilitadores');

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
        Schema::dropIfExists('grupos');
    }
}
