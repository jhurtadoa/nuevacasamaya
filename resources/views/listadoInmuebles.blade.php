@extends('layouts.master')
@section('contenido')


@include('buscador-inmuebles')
		<div class="table-responsive">
			<table  id="myTable" class="table table-bordered table-condensed table-striped tablesorter">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Baños</th>
						<th>Habitaciones</th>
						<th>Costo de arriendo</th>
						<th>Detalles</th>
						<th>Estado</th>
						<th colspan="4">Gestionar</th>
					</tr>
				</thead>
				<tbody>
				@if ($inmuebles->count() == 0)
					<tr>
						<td colspan="7"><span>No se encontraron inmuebles registrados relacionados con esta busqueda</span>
						</td>
					</tr>
				@else
				  @foreach  ($inmuebles as $inmueble)
					<tr>
						<td>{{ $inmueble->name }}</td>
						<td>{{ $inmueble->bath }}</td>
						<td>{{ $inmueble->beth }}</td>
						<td>{{ number_format($inmueble->rent_cost, 2) }}</td>
						<td>{{ $inmueble->details }}</td>
						<td>{{ $inmueble->state }}</td>

						<td><a href="{{ url('inmuebles/'.$inmueble->id)}}" title="Editar"><span class="glyphicon glyphicon-edit"></span></a></td>
						<td><a href="{{ url('inmuebles/administrar/'.$inmueble->id)}}" title="Administrar"><span class="glyphicon glyphicon-inbox"></span></a></td>
						<td><a href="{{ route('reporte', ['id' => $inmueble->id]) }}" title="Reporte"><span class="glyphicon glyphicon-list-alt"></span></a></td>
						<td><a href="{{ url('inmuebles/eliminar/'.$inmueble->id)}}" title="Eliminar"><span class="glyphicon glyphicon-trash"></span></a></td>
					</tr>
				  @endforeach
				@endif
				</tbody>
			</table>
		</div>
			
{!! $inmuebles->render() !!}

@endsection