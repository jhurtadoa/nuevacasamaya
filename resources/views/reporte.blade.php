@extends('layouts.master')
@section('contenido')



	<div class="table-responsive">
		<table class="table table-bordered table-condensed table-striped tablesorter">
			<thead>
				<tr>
					<th>Fecha Inicio</th>
					<th>Fecha Finalizado</th>
					<th>Cliente</th>
					<th>Valor Mensualidad</th>
					<th>Igresos</th>
					<th>Egresos</th>
				</tr>
			</thead>
			<tbody>
			
	@foreach  ($reporInmueble->rents as $arriendo)
				<tr>
					<td>{{ $arriendo->start_date }}</td>
					<td>{{ $arriendo->end_date }}</td>
					<td>{{ $arriendo->client->name . ' ' . $arriendo->client->last_name }}</td>
					<td>${{ number_format($arriendo->rent_cost, 2) }}</td>
					
				</tr>
	@endforeach
			</tbody>
		</table>
	</div>

	
@endsection