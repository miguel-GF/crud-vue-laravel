<?php

namespace App\Http\Controllers;

use App\Repos\CategoriaRepos;
use http\Env\Response;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**Manda a traer listarCategorias() para mostrar
     * las categorias en el componente
     * @return array
     */
    public function index()
    {
        $categorias = CategoriaRepos::listarCategorias();
        $array = collect($categorias)->toArray();
        return  $array;
    }
}
