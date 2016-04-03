{!! Form::open(['route' => 'reportes', 'method' => 'GET', 'class' => 'navbar-form pull-right']) !!}
	<div class="input-group">
		{!! Form::text('buscar', null, ['class' => 'form-control, pull-right', 'placeholder' => 'Buscar por nombre..', 'aria_describedby' => 'search']) !!}
		<span class="input-group-addon" id="search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
	</div>
{!! Form::close() !!}