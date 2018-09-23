<?php  

namespace App\Services;
use App\Asignatura;

class AsignaturaService
{


	public function asignaturas_pensum($id)
	{
		return Asignatura::all()->where('id_pensum',$id)->sortBy('cuatrimestre')->groupBy('cuatrimestre');
	}


}