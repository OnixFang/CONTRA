<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrupoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion');
            $table->string('clave');
            $table->datetime('horario');
            $table->integer('bimestre');
            $table->unsignedInteger('id_ciclo');
            $table->unsignedInteger('id_asignatura');
            $table->unsignedInteger('id_facilitador');
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
        Schema::dropIfExists('grupo');
    }
}
