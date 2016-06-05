
{!! Form::open(['route' => ['reporte', $id_inmueble ], 'method' => 'GET', 'class' => 'navbar-form pull-right']) !!}
<h3>Filtrar transacciones</h3>
	
	<div class="input-group">
		

		{!! Form::select('tipo', ['Mensualidad' => 'Mensualidad', 'Luz' => 'Luz', 'Agua' => 'Agua', 'Gas' => 'Gas', 'GastoExtra' => 'GastoExtra'], null, [ 'class' => 'form-control','placeholder' => 'Tipo transacciones ..']) !!}


	</div>

	<div class="input-group">
		{!! Form::date('fechafin', null, ['class' => 'form-control pull-right', 'placeholder' => 'Buscar por cedula, nombre, apellido ..', 'aria_describedby' => 'search']) !!}
		{!! Form::date('fechainicio', null, ['class' => 'form-control pull-right', 'placeholder' => 'Buscar por cedula, nombre, apellido ..', 'aria_describedby' => 'search']) !!}
		<span class="input-group-addon" id="search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
	</div>

	<input type="submit" class="form-control" value="Filtrar">

{!! Form::close() !!}