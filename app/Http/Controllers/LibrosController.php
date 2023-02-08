<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;
use Carbon\Carbon;

class LibrosController extends Controller{


    public function index(){ //me muestra todos los datos
        $allData = Libro::all();
        return response()->json($allData);
    }
    public  function search($tipo){
        
        $filterType = Libro::searchByType($tipo); //me muestra los datos filtrados por tipo de libro
        return response()->json($filterType);
    }
    
    public function store(Request $request){
        $datosLibros = new Libro;

        if($request->hasFile('imagen')){
            $nombreArchivoOriginal=$request->file('imagen')->getClientOriginalName();
            $nuevoNombre = Carbon::now()->timestamp."_".$nombreArchivoOriginal;
        }

        $request->file('imagen');

        //campo de la tabla = informacion recibida por postman
        $datosLibros->titulo=$request->titulo;
        $datosLibros->imagen=$request->imagen;
        $datosLibros->tipo=$request->tipo;
        $datosLibros->save(); // salva los datos enviados a la db
        return response()->json($nuevoNombre); //respondo con los datos enviados por el cliente

    
    }



}