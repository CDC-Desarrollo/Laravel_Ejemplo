@extends('layouts.app')

@section('content')
<div class="container">

<h2> Muestra la lista de Empleados </h2>


    @if(Session::has("mensaje"))
    <div class="alert alert-success alert-dismissible" role="alert">

        {{Session::get("mensaje")}}

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"> &times; </span>
        </button>
    </div>

    @endif

    




<a href=" {{url('empleados/create')}} " class="btn btn-success"> Registrar Nuevo Empleado</a>
<br> <br>
<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th> Foto </th>
            <th> Nombre </th>
            <th> Apellido Paterno </th>
            <th> Apellido Materno </th>
            <th> Correo </th>
            <th> Acciones </th>
        </tr>
    </thead>
    <tbody> 
        @foreach($empleados as $empleado)
        <tr>
            <td> {{ $empleado->id }} </td>

            <td> 
                <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'. $empleado->Foto }} " alt="" srcset="" width="100" height="200">

            </td>

            <td> {{ $empleado->Nombre }} </td>
            <td> {{ $empleado->ApellidoPaterno }} </td>
            <td> {{ $empleado->ApellidoMaterno }} </td>
            <td> {{ $empleado->Correo }} </td>

            <td> 
                <a href="{{ url('/empleados/' .  $empleado->id . '/edit') }}" class="btn btn-warning">
                    Editar
                </a>    
             
                <form action="{{ url('/empleados/'. $empleado->id) }}" class="d-inline" method="post">
                    @csrf
                    {{ method_field('DELETE') }}
                    <input class="btn btn-danger" type="submit" onclick="return confirm('Quieres eliminar el empleado?')" value="Eliminar">
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $empleados->links() }}

</div>
@endsection