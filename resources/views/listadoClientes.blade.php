@extends('layouts.master')
@section('contenido')

@include('buscador-cliente')

		<div class="table-responsive">
			<table class="table table-bordered table-condensed table-striped tablesorter">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Apellido</th>
						<th>Correo</th>
						<th>Telefono</th>
						<th>Cedula</th>
						<th colspan="2">Gestionar</th>
					</tr>
				</thead>
				<tbody>
				@if ($clientes->count() == 0)
					<tr>
						<td colspan="7"><span>No se encontraron clientes registrados relacionados con esta busqueda</span>
						</td>
					</tr>
				@else
				  @foreach  ($clientes as $cliente)
					<tr>
						<td>{{ $cliente->name }}</td>
						<td>{{ $cliente->last_name }}</td>
						<td>{{ $cliente->email }}</td>
						<td>{{ $cliente->phone }}</td>
						<td>{{ $cliente->document }}</td>
						<td><a href="{{ url('clientes/'. $cliente->id ) }}" title="Editar"><span class="glyphicon glyphicon-edit"></span></a></td>
						<td><a href="{{ url('clientes/eliminar/'. $cliente->id ) }}" title="Eliminar"><span class="glyphicon glyphicon-trash"></span></a></td>
					</tr>
				  @endforeach
				@endif
				</tbody>
			</table>
		</div>


@endsection