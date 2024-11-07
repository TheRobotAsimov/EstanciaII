<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $clientes = Client::all();

        return view('sistema.listClients', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('sistema.addClient');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validacion = $request->validate([
            'nombre' => 'required|string|max:50',
            'apellido' => 'required|string|max:50',
            'email' => 'required|email|max:75|unique:clients,email',
            'telefono' => 'required|string|min:10|max:10',
            'genero' => 'required|string|max:10',
            'fecnac' => 'required|date',
            'saldo' => 'required|numeric',
            'estado' => 'required|string|max:50'
        ]);

        $cliente = new Client();
        $cliente->nombre = $request->input('nombre');
        $cliente->apellido = $request->input('apellido');
        $cliente->email = $request->input('email');
        $cliente->telefono = $request->input('telefono');
        $cliente->genero = $request->input('genero');
        $cliente->fecnac = $request->input('fecnac');
        $cliente->saldo = $request->input('saldo');
        $cliente->estado = $request->input('estado');
        $cliente->curp = "X";

        $cliente->save();

        return back()->with('mensaje', 'Cliente agregado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $cliente = Client::find($id);

        return view('sistema.editClient', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $cliente = Client::find($id);

        $cliente->nombre = $request->input('nombre');
        $cliente->apellido = $request->input('apellido');
        $cliente->email = $request->input('email');
        $cliente->telefono = $request->input('telefono');
        $cliente->genero = $request->input('genero');
        $cliente->fecnac = $request->input('fecnac');
        $cliente->saldo = $request->input('saldo');
        $cliente->estado = $request->input('estado');

        $cliente->save();

        return view('sistema.editClient', compact('cliente'))->with('mensaje', 'Cliente actualizado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $cliente = Client::find($id);
        $cliente->delete();

        return back()->with('mensaje', 'Cliente eliminado correctamente');
    }
}
