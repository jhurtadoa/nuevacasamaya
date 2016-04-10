{!! Form::open(['route' => {'reporte', 1}, 'method' => 'GET', 'class' => 'navbar-form pull-right']) !!}
	<div class="input-group">
		{!! Form::text('date1', null, ['class' => 'form-control, pull-right', 'placeholder' => 'Buscar por cedula, nombre, apellido ..', 'aria_describedby' => 'search']) !!}
		{!! Form::text('date2', null, ['class' => 'form-control, pull-right', 'placeholder' => 'Buscar por cedula, nombre, apellido ..', 'aria_describedby' => 'search']) !!}
		<span class="input-group-addon" id="search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
	</div>
{!! Form::close() !!}