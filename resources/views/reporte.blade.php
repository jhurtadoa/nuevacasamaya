@extends('layouts.master')
@section('contenido')


<h1>Reporte: {{ $inmueble->name }}</h1>

@include('buscador-transacciones', ['id_inmueble' => $inmueble->id])

<h2>Transacciones</h2>

	<div class="table-responsive">
		<table class="table table-bordered table-condensed table-striped tablesorter">
			<thead>
				<tr>
					<th>Fecha Pago</th>
					<th>Cliente</th>
					<th>Tipo</th>
					<th>Valor Pagado</th>
					<th>Detalles</th>
				</tr>
			</thead>
			<tbody>
			
	@foreach  ($arriendos as $arriendo)

		@if(sizeOf($arriendo->transacciones) != 0)
			@foreach ($arriendo->transacciones as $transaccion)
				<tr>
					<td>{{ $transaccion->date }}</td>
					<td>{{ $arriendo->client->name . ' ' . $arriendo->client->last_name }}</td>
					<td>{{ $transaccion->type }}</td>
					<td>{{ $transaccion->amount }}</td>
					<td>{{ $transaccion->detail }}</td>
				</tr>
			@endforeach
		@endif
	@endforeach
			</tbody>
		</table>
	</div>

	
@endsection