@extends('layouts.master')
@section('contenido')




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
			
	@foreach  ($transacArriendo as $transacciones)
		@if(sizeOf($transacciones) != 0)
			@foreach ($transacciones as $transaccion)
				<tr>
					<td>{{ $transaccion->date }}</td>
					<td>{{ $transacciones->client }}</td>
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