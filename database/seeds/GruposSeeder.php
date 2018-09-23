<?php

use App\Grupo;
use Illuminate\Database\Seeder;

class GruposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            new Grupo(['seccion' => "10", "horario" => "2019-03-09 10:10", 'bimestre' => "1", "asignatura_id" => "313", 'cerrado' => 0]),
            new Grupo(['seccion' => "10", "horario" => "2019-01-05 10:10", 'bimestre' => "1", "asignatura_id" => "312", 'cerrado' => 0]),
            new Grupo(['seccion' => "10", "horario" => "2019-01-05 12:00", 'bimestre' => "1", "asignatura_id" => "328", 'cerrado' => 0]),
            new Grupo(['seccion' => "30", "horario" => "2019-01-06 14:10", 'bimestre' => "1", "asignatura_id" => "315", 'cerrado' => 0]),
            new Grupo(['seccion' => "10", "horario" => "2019-01-05 16:00", 'bimestre' => "1", "asignatura_id" => "318", 'cerrado' => 0]),
            new Grupo(['seccion' => "GV70", "horario" => "2019-01-06 8:00", 'bimestre' => "1", "asignatura_id" => "331", 'cerrado' => 0]),
            new Grupo(['seccion' => "GV70", "horario" => "2019-01-05 12:00", 'bimestre' => "1", "asignatura_id" => "456", 'cerrado' => 0]),
            new Grupo(['seccion' => "GV70", "horario" => "2019-03-09 8:00", 'bimestre' => "2", "asignatura_id" => "18", 'cerrado' => 0]),
            new Grupo(['seccion' => "GV70", "horario" => "2019-03-10 10:10", 'bimestre' => "2", "asignatura_id" => "440", 'cerrado' => 0]),
            new Grupo(['seccion' => "GV70", "horario" => "2019-03-09 12:00", 'bimestre' => "2", "asignatura_id" => "445", 'cerrado' => 0]),
            new Grupo(['seccion' => "GV70", "horario" => "2019-03-09 14:10", 'bimestre' => "2", "asignatura_id" => "14", 'cerrado' => 0]),
            new Grupo(['seccion' => "GV70", "horario" => "2019-03-10 16:00", 'bimestre' => "2", "asignatura_id" => "55", 'cerrado' => 0]),
            new Grupo(['seccion' => "GV70", "horario" => "2019-03-09 8:00", 'bimestre' => "2", "asignatura_id" => "58", 'cerrado' => 0]),
            new Grupo(['seccion' => "10", "horario" => "2019-01-05 10:10", 'bimestre' => "2", "asignatura_id" => "330", 'cerrado' => 0]),
        ])->each->save();
    }
}
