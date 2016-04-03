@extends('layouts.master')
@section('contenido')

{!!Form::open(array('method' => 'POST', 'url' => url('clientes/nuevo/'.$id_inmueble)))!!}
{!!Form::label('nombre', 'Nombre '. $variable.'' )!!}
{!!Form::text('name', null, ['class' => 'form-control'])!!}

{!!Form::label('last_name', 'Apellido '. $variable.'' )!!}
{!!Form::text('last_name', null, ['class' => 'form-control'])!!}

{!!Form::label('email', 'Correo '. $variable.'' )!!}
{!!Form::email('email', null, ['class' => 'form-control'])!!}

{!!Form::label('document', 'Cedula '. $variable.'' )!!}
{!!Form::text('document', null, ['class' => 'form-control'])!!}

{!!Form::label('phone', 'Telefono '. $variable.'' )!!}
{!!Form::text('phone', null, ['class' => 'form-control'])!!}


{!!Form::submit('Registrar '. $variable.'', ['class' => 'btn btn-default'])!!}

{!!Form::close()!!}
@endsection