<?php

namespace App;
namespace App\Repos;
use Illuminate\Support\Facades\DB;

class CategoriaRepos
{
    /** Toma todos los valores de la tabla cat_clientes_categorias
     *
     * @return Exception|\Exception
     */
     public static function listarCategorias()
     {
        try{
            $query = DB::table('cat_clientes_categorias')
                ->select('*')->get();
            return $query;
        }
        catch (Exception $error) {
            $error -> getMessage();

            return $error;
        }
     }
}
