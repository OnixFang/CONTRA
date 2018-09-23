<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrematriculasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prematriculas', function (Blueprint $table) {
            $table->increments('id');

            $table->string('clave')->index();

            $table->unsignedInteger('inscripcion_id');
            $table->foreign('inscripcion_id')->references('id')->on('inscripciones');

            $table->unsignedInteger('grupo_id');
            $table->foreign('grupo_id')->references('id')->on('grupos');

            $table->unsignedInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('users');

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
        Schema::dropIfExists('prematriculas');
    }
}
