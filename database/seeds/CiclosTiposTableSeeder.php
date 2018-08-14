<?php

use App\CicloTipo;
use Illuminate\Database\Seeder;

class CiclosTiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            new CicloTipo(['descripcion' => 'Cuatrimestral']),
            new CicloTipo(['descripcion' => 'Trimestral']),
        ])->each->save();
    }
}
