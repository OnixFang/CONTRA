<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnCerradoToGrupoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('grupos', function (Blueprint $table) {
            $table->boolean('cerrado')->default(true)->after('asignatura_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('grupos', function (Blueprint $table) {
            $table->dropColumn('cerrado');
        });
    }
}
