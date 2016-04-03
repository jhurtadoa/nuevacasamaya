@extends('layouts.master')
@section('contenido')
<form method="POST" class="form-horizontal" action="{{ url('inmuebles/'.$inmueble->id)}}">
	<div id="form-group">
		<label for="name">Nombre {{ $variable }}</label>
		<input type="text" class="form-control" id="name" name="name" value="{{ $inmueble->name}}"/>
	</div>

	<div id="form-group">
		<label for="bath">Baños {{ $variable }}</label>
		<input type="text" class="form-control" id="bath" name="bath" value="{{ $inmueble->bath}}"/>		
	</div>
	
	<div id="form-group">
		<label for="beth">Habitaciones {{ $variable }}</label>
		<input type="text" class="form-control" id="beth" name="beth" value="{{ $inmueble->beth}}"/>
	</div>
	
	<div id="form-group">
		<label for="rentcost">Costo Arriendo {{ $variable }}</label>
		<input type="text" class="form-control" id="rentcost" name="rent_cost" value="{{ $inmueble->rent_cost}}"/>
	</div>

	<div id="form-group">
		<label for="details">Detalles {{ $variable }}</label>
		<input type="text" class="form-control" id="details" name="details" value="{{ $inmueble->details}}"/>
	</div>

	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	
	<input type="submit" class="btn btn-default" value="Actualizar {{ $variable }}">
</form>
@endsection