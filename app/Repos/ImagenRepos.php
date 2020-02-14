<?php

namespace App;
namespace App\Repos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class ImagenRepos
{
    /**
     * Guarda el nombre de la Imagen en la BD
     * @param String $imagen
     * @return bool|\Exception|Exception
     */
    public static function guardarImagen(String $imagen)
    {
        try {

            $query = DB::table('nombre_imagen')
                ->where('id_imagen', '=', 1)
                ->update([
                    'nombre' => $imagen
                ]);

            return true;
        }

        catch (Exception $error) {
            $error -> getMessage();

            return $error;
        }
    }

    /**
     * Busca el nombre de la imagen en la base de datos
     * para mostrarla en el sistema.
     * @return \Exception|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|Exception|null
     */
    public static function mostrarImagen()
    {
        try{
            $query = DB::table('nombre_imagen')
                ->select('nombre')->first();
            return $query;
        }
        catch (Exception $error) {
            $error -> getMessage();

            return $error;
        }
    }
}
