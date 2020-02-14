<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;

class ImagenController extends Controller
{
    /**Manda a traer listarCategorias() para mostrar
     * las categorias en el componente
     * @return array
     */
    public function cambiarImagen()
    {
        Storage::disk('local')->put('file.txt', 'Contents');
    }
}
