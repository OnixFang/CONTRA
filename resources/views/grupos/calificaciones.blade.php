{!! Form::open(array('route' => 'calificacion.store','class'=> 'form')) !!}
<div class="modal-header">
	<h3 class="modal-title" id="exampleModalLongTitle">Calificar Asignatura</h3>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
<div class="modal-body">	
	{{ Form::hidden('id_grupo',$grupo->id) }}
	{{ Form::hidden('id_asignatura',$grupo->asignatura->id) }}
	<div class="row">
		<div class="form-group col-md-12">
			<h3>{{ Form::label('asignatura',$grupo->asignatura->descripcion) }}</h3>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-4">
			<h5>Facilitador : {{ Form::label('facilitador',$grupo->facilitadores->nombre)}}</h5>
		</div>

		<div class="form-group col-md-4">
			<h5>Bimestre : {{Form::label('bimestre',$grupo->bimestre)}}</h5>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 form-group">
				<lavel class="col-md-6 border-success">Calificación : </lavel>    
				{{ Form::number('calificacion',null,['class'=>'form-control col-md-4','placeholder'=>'escriba calificacion']) }}    
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-danger" role="alert">
				Debe estar seguro de la calificación que va a publicar a esta asignatura. Tenga en cuenta que una vez que publique esta calificación no podrá modificarla.
			</div>
		</div>
	</div>
</div><!--./body-->
<div class="modal-footer">
	<button type="submit" class="btn btn-primary">Guardar Calificacion</button>
	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
</div>

{!! Form::close() !!}
