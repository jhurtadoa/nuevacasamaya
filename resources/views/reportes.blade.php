@extends('layouts.master')
@section('contenido')


@include('buscador-reportes')
@for ($i=0; $i < count($inmuebles); $i++)
	<div class="table-responsive">
		<h2><a href="{{ url('inmuebles/reporte/'.$inmuebles[$i]->id)}}">{{$inmuebles[$i]->name}}</a></h2>
		<table class="table table-bordered table-condensed table-striped">

			<tr>
				<th>Fecha Inicio</th>
				<th>Total Ingresos</th>
				<th>Total Egresos</th>
				<th>Utilidad Total</th>
			</tr>
			
			<tr>
				<td>{{$inmuebles[$i]->start_date}}</td>
				<td>${{ number_format($inmuebles[$i]->transactions->totalI, 2) }}</td>
				<td>${{ number_format($inmuebles[$i]->transactions->totalE, 2) }}</td>
				<td>${{ number_format($inmuebles[$i]->transactions->totalI - $inmuebles[$i]->transactions->totalE, 2) }}</td>
			</tr>

		</table>
	</div>
@endfor

{!! $inmuebles->render() !!}

@endsection