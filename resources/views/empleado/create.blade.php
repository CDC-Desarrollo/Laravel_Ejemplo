@extends('layouts.app')

@section('content')
<div class="container">

    <h2> Formulario de Creación de Empleado </h2>

    <form action="{{ url('/empleados') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include("empleado.form", ["modo"=>"Crear"]);
    </form>

</div>
@endsection