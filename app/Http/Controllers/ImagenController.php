<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use PHPUnit\Exception;
use App\Repos\ImagenRepos;

class ImagenController extends Controller
{

    /**
     * LLama a la funcion guardar Imagen para guardar el nombre en la
     * BD y la imagen se guarda localmente en
     * @param Request $request
     * @return \Exception|Exception|string
     */
    public function cambiarImagen(Request $request)
    {
        try {
            if ($request->hasFile('imagenNueva')) {
                //Storage::put('', $request);
                $image = $request->file('imagenNueva');
                //$nombre = $image->getClientOriginalName();
                $extension = $image->getClientOriginalExtension();
                $nombre = "logotipo.".$extension;
                ImagenRepos::guardarImagen($nombre);
                Storage::disk('public')->put($nombre, \File::get($image));
                return $nombre;
            }

        }
        catch (Exception $error) {
            $error -> getMessage();
            return $error;
        }

    }

    /**
     * LLama ala funcion  para obtener el nombre de la imagen
     *
     * @return \Exception|Exception|string
     */
    public function mostrarImagen() {
        try {
            $imagen = ImagenRepos::mostrarImagen();

            return  (string) $imagen->nombre;
        }
        catch (Exception $error) {
            $error -> getMessage();
            return $error;
        }
    }
}
