<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscripcionCicloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscripcion_ciclo', function (Blueprint $table) {
            $table->increments('id');

            $table->string('clave')->index();

            $table->unsignedInteger('inscripcion_id');
            $table->foreign('inscripcion_id')->references('id')->on('inscripciones');

            $table->unsignedInteger('grupo_id');
            $table->foreign('grupo_id')->references('id')->on('grupos');

            $table->unsignedInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('users');

            $table->string('literal')->nullable();
            $table->boolean('aprobado');
            
            $table->integer('nota')->nullable();

            $table->string('estado')->default('n');

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
        Schema::dropIfExists('inscripcion_ciclo');
    }
}
