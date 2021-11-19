<!--Para las validaciones se usa la propiedad name del formulario-->

@if(count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach($errors->all() as $error)
                <li> {{ $error }} </li>
            @endforeach
        </ul>
    </div>
   
@endif

<div class="form-group">
    <label for="nombre"> Nombre:</label>
    <input type="text" class="form-control" name="nombre" value=" {{ isset($empleado->Nombre)?$empleado->Nombre: old('nombre') }} " id="nombre">
</div>

<div class="form-group">
    <label for="apellidoPaterno"> Apellido Paterno:</label>
    <input type="text" class="form-control" name="apellidoPaterno" value=" {{ isset($empleado->ApellidoPaterno)?$empleado->ApellidoPaterno: old('apellidoPaterno') }} " id="apellidoPaterno">
</div>

<div class="form-group">
    <label for="apellidoMaterno"> Apellido Materno:</label>
    <input type="text" class="form-control" name="apellidoMaterno" value=" {{ isset($empleado->ApellidoMaterno)?$empleado->ApellidoMaterno: old('apellidoMaterno') }} " id="apellidoMaterno">
</div>

<div class="form-group">
    <label for="correo"> Correo:</label>
    <input type="text" class="form-control" name="correo" value=" {{ isset($empleado->Correo)?$empleado->Correo: old('correo') }} " id="correo">
</div>

<div class="form-group">
    <label for="foto"> </label>

    @if(isset($empleado->Foto))
        <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'. $empleado->Foto }} " alt="" srcset="" width="200" height="200">
    @endif

    <input type="file" class="form-control" name="foto" value="" id="foto">

</div>



<input type="submit" class="btn btn-success" value="{{$modo}} Datos"> 

<a class="btn btn-primary" href=" {{url('empleados/')}} "> Volver </a>