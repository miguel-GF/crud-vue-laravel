<?php

namespace App\Http\Controllers;

use App\Repos\ClienteRepos;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PHPUnit\Exception;

class ClienteController extends Controller
{
    /**
     * @return array
     */
    public function index()
    {
       // return Cliente::all();
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            ClienteRepos::guardarCliente($request);
            return redirect('/home')->with('status', 'Información del Cliente Guardada Correctamente.');
        }
        catch (Exception $error) {
            $error -> getMessage();
            return $error;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
