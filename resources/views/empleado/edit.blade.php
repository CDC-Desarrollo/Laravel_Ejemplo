@extends('layouts.app')

@section('content')
<div class="container">

    <h2> Formulario de Edición de Datos de Empleado </h2>

    <form action="{{ url('/empleados/' . $empleado->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        {{ method_field("PATCH") }}

        @include("empleado.form", ["modo"=>"Editar"]);
    </form>


</div>
@endsection
