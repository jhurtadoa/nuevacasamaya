@extends('layouts.master')
@section('contenido')
{!!Form::open(array('method' => 'POST', 'url' => url('clientes/'.$cliente->id)))!!}
{!!Form::label('name', 'Nombre '. $variable.'' )!!}
{!!Form::text('name', $cliente->name, ['class' => 'form-control'])!!}

{!!Form::label('last_name', 'Apellido '. $variable.'' )!!}
{!!Form::text('last_name', $cliente->last_name, ['class' => 'form-control'])!!}

{!!Form::label('email', 'Correo '. $variable.'' )!!}
{!!Form::email('email', $cliente->email, ['class' => 'form-control'])!!}

{!!Form::label('phone', 'Telefono '. $variable.'' )!!}
{!!Form::text('phone', $cliente->phone, ['class' => 'form-control'])!!}

{!!Form::label('document', 'Cedula '. $variable.'' )!!}
{!!Form::text('document', $cliente->document, ['class' => 'form-control'])!!}

{!!Form::submit('Modificar '. $variable.'', ['class' => 'btn btn-default'])!!}



{!!Form::close()!!}
@endsection