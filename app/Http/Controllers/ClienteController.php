<?php

namespace App\Http\Controllers;

use App\Repos\ClienteRepos;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PHPUnit\Exception;

class ClienteController extends Controller
{
    /** Lista todos los clientes que deben mostrarse
     * en el Home, en la Tabla
     * @return array|\Exception|Exception
     */
    public function index()
    {
       // $busqueda = '';
        try {
            $clientes = ClienteRepos::listarClientes();
            $array = collect($clientes)->toArray();
            return $array;
        }
        catch (Exception $error) {
            $error -> getMessage();
            return $error;
        }

    }

    /**
     * Llama la funcion guardarCliente para guardar al cliente
     * y retornar un mensaje
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if (ClienteRepos::guardarCliente($request)==true)
                return (string) true;
            else
                return (string) false;
        }
        catch (Exception $error) {
            $error -> getMessage();
            return $error;
        }

    }

    /**
     * @param Request $request
     * @return \Exception|Exception
     */
    public static function busquedaClientes(Request $request) {
        try {
            $busqueda = $request->get('busqueda') ?: '';
            //$busqueda = $request->get('busqueda');
            $query = ClienteRepos::buscaClientes($busqueda);
            $resultado = collect($query)->toArray();
            return $resultado;

        }
        catch (Exception $error) {
            $error -> getMessage();
            return $error;
        }
    }

    /**
     * Llama la funcion editaCliente para actualizar al cliente
     * y retornar un mensaje
     * @param Request $request
     * @return \Exception|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|Exception
     */
    public function update(Request $request)
    {
        try {
            ClienteRepos::editaCliente($request);
            return 'Información del Cliente Actualizada Correctamente.';
        }
        catch (Exception $error) {
            $error -> getMessage();
            return $error;
        }
    }

    /**
     * Llama a la funcion borraCliente para
     * actualizar su status
     * a 300
     * @param Request $request
     * @return \Exception|Exception|string
     */
    public function destroy(Request $request)
    {
        try {
            ClienteRepos::borraCliente($request);
            return 'Cliente Eliminado';
        }
        catch (Exception $error) {
            $error -> getMessage();
            return $error;
        }
    }
}
