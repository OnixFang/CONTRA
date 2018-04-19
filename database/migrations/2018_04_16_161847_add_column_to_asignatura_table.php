<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToAsignaturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asignatura', function (Blueprint $table) {
            $table->integer('pre_requisito1')->nullable();
            $table->integer('pre_requisito2')->nullable();
            $table->boolean('aprovado')->default('0');
            $table->boolean('propedeutico')->default('0');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asignatura', function (Blueprint $table) {
             $table->dropColumn('pre_requisito1');
            $table->dropColumn('pre_requisito2');
            $table->dropColumn('aprovado');
            $table->dropColumn('propedeutico');
        });
    }
}
