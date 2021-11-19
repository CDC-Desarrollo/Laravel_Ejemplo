<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

//Clase para remplazar imágenes
use Illuminate\Support\Facades\Storage; 


class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos["empleados"] = Empleado::paginate(1);
        return view("empleado.index", $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("empleado.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Propiedad name:
        $campos = [
            "nombre"=>"required|max:100",
            "apellidoPaterno"=>"required|string|max:100",
            "apellidoMaterno"=>"required|string|max:100",
            "correo"=>"required|email",
            "foto"=>"required|max:10000|mimes:jpeg,png,jpg",

        ];

        $mensaje=[
            "required"=>"El :attribute es requerido",
            "Foto.required"=>"La foto es requerida"
        ];

        $this->validate($request, $campos, $mensaje);

        //$datosEmpleado = request()->all();
        $datosEmpleado = request()->except("_token");
            
        if($request->hasFile('foto'))
        {
            $datosEmpleado["foto"] = $request->file("foto")->store("uploads", "public");
        }

        Empleado::insert($datosEmpleado);
        
        //return response()->json($datosEmpleado);
        return redirect('empleados')->with("mensaje", "Empleado Agregado");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleado = Empleado::findOrFail($id);
        return view("empleado.edit", compact("empleado"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $campos = [
            "nombre"=>"required|max:100",
            "apellidoPaterno"=>"required|string|max:100",
            "apellidoMaterno"=>"required|string|max:100",
            "correo"=>"required|email"
        ];

        $mensaje=[
            "required"=>"El :attribute es requerido"
        ];

        if($request->hasFile('foto')){
            
            $campo = ["foto"=>"required|max:10000|mimes:jpeg,png,jpg"];

            $mensaje=["Foto.required"=>"La foto es requerida"];
        }

        
        $this->validate($request, $campos, $mensaje);

        $datosEmpleado = request()->except(["_token","_method"]);

        if($request->hasFile('foto'))
        {
            $empleado = Empleado::findOrFail($id);
            Storage::delete(['public/' . $empleado->Foto, 'otherFile']);
            $datosEmpleado["foto"] = $request->file("foto")->store("uploads", "public");
        }

        Empleado::where("id", "=", $id) -> update($datosEmpleado);

        //return redirect("empleados");
        return redirect("empleados")->with("mensaje", "Empleado Editado");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleado = Empleado::findOrFail($id);

        if(Storage::delete(['public/' . $empleado->Foto, 'otherFile']))
        {
            Empleado::destroy($id);
        }
        Empleado::destroy($id);
        return redirect("empleados")->with("mensaje", "Empleado Eliminado");
    }
}
