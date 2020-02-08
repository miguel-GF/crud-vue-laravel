<?php

namespace App;
namespace App\Repos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class ClienteRepos
{
    /**Busca los datos necesarios para tomar el LISTADO
     * DE CLIENTES con estatus ACTIVO
     * @return Exception|\Exception
     */

    public static function listarClientes()
    {
        try{
            $query = DB::table('cat_clientes')
                    ->where('cat_clientes.status', '=', 200)
                    ->join('cat_clientes_categorias', 'cat_clientes.cliente_categoria_id', '=', 'cat_clientes_categorias.cliente_categoria_id')
                    ->join('users','cat_clientes.registro_autor_id', '=', 'users.id')
                    ->select(
                        'cat_clientes.nombre as nombre_cliente',
                                'cat_clientes.edad',
                                'cat_clientes.email',
                                'cat_clientes.cliente_id as id',
                                'cat_clientes.descripcion',
                                'cat_clientes.cliente_categoria_id as id_categoria',
                                'cat_clientes_categorias.nombre as categoria'
                            )
                    ->orderBy('cat_clientes.cliente_id', 'desc')
                    ->get();

            return $query;
        }
        catch (Exception $error) {
            $error -> getMessage();

            return $error;
        }
    }

    /**
     * RECIBE LOS DATOS NECESARIOS Y GUARDA UN CLIENTE NUEVO
     * @param Request $request
     * @return bool|\Exception|Exception
     */

    public static function guardarCliente(Request $request)
    {
        try {
            $request -> validate([
                'nombre' => 'required|alpha|',
                'edad' => 'required|numeric',
                'email' => 'required|email',
                'categoria' => 'required',
                'descripcion' => 'nullable'
            ]);

            $query = DB::table('cat_clientes')->insert (
                [
                    'nombre' => $request->get('nombre'),
                    'edad' => $request->get('edad'),
                    'email' => $request->get('email'),
                    'cliente_categoria_id' => $request->get('categoria'),
                    'descripcion' => $request->get('descripcion'),
                    'registro_autor_id' => 1,
                    'status' => 200
                ]
            );

            return true;
        }

        catch (Exception $error) {
            $error -> getMessage();

            return $error;
        }
    }

    /**
     * RECIBE LOS DATOS NECESARIOS Y EDITA UN CLIENTE EXISTENTE
     * @param Request $request
     */

    public static function editaCliente(Request $request)
    {
        try {
            $query = DB::table('cat_clientes')
                ->where('cliente_id',"=", $request->get('idCliente'))
                ->update([
                    'nombre' => $request->get('nombre'),
                    'edad' => $request->get('edad'),
                    'email' => $request->get('email'),
                    'cliente_categoria_id' => $request->get('categoria'),
                    'descripcion' => $request->get('descripcion')
                ]);

             return true;
        }
        catch (Exception $error) {
            $error -> getMessage();
            return $error;
        }
    }

    public static function borraCliente(Request $request) {
        try {
            $query = DB::table('cat_clientes')
                ->where('cliente_id',"=", $request->get('id'))
                ->update([
                    'status' => 300
                ]);
            return true;
        }
        catch (Exception $error) {
            $error -> getMessage();
            return $error;
        }
    }

}
