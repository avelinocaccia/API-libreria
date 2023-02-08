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
            $nombreArchivoOriginal=$request->file('imagen')->getClientOriginalName(); //obtiene el nombre original del archivo qeu nos estan enviando
            $nuevoNombre = Carbon::now()->timestamp."_".$nombreArchivoOriginal; // le asigno un nuevo nombre con un identificador unico qeu es el metodo now.
            $carpetaDestino='./upload/'; //indico la carpeta de destino donde se va a subir el archivo
            $request->file('imagen')->move($carpetaDestino, $nuevoNombre); //muevo el archivo a la carpeta de destino con el nuevo nombre
           
            //campo de la tabla = informacion recibida por postman
            $datosLibros->imagen=ltrim($carpetaDestino,'.').$nuevoNombre;
            $datosLibros->titulo=$request->titulo;
            $datosLibros->tipo=$request->tipo;

            $datosLibros->save(); // salva los datos enviados a la db

        }

        return response()->json($nuevoNombre); //respondo con los datos enviados por el cliente

    
    }

    public function show($id){
        $datosLibro = new Libro;
        $datosEncontrados = $datosLibro->find($id);
        return response()->json($datosEncontrados);
    }

    public function delete($id){
        $datosLibro = Libro::find($id);//busco el archivo

        if($datosLibro){//si el archivo esxiste
            $rutaArchivo = base_path('public').$datosLibro->imagen; //guardo la ruta del archivo en una variable
            if(file_exists($rutaArchivo)){// si el archivo existe
                unlink($rutaArchivo); //entonces borra el archivo
            }

            $datosLibro->delete(); //borro el registro de la base de datos
        }

        return response()->json("Registro Borrado");

    }



}