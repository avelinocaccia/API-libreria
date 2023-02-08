<?php   
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model{
    protected $table = "libros";

    protected $fillable = [
        'titulo',
        'imagen',
        'tipo'
    
    ];


   

    public static function searchByType($tipo){
        $libros = self::where('tipo', $tipo)->get();
        return $libros;
    }


    public static function getItems(){
       return self::where('tipo','aventura')->get();    
    }

}