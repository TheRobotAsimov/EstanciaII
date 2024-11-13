<?php

namespace App\Http\Controllers;

use App\Models\cCategoria;
use App\Models\Cliente;
use App\Models\Expediente;
use Illuminate\Http\Request;

class ExpedienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $expedientes = Expediente::all();
        $clientes = Cliente::all();
        $categorias = cCategoria::all();

        return view('sistema.listExpediente', compact('expedientes', 'clientes', 'categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $expediente = Expediente::create([
            'id_cliente' => $request->cliente,
            'id_c_categoria' => $request->categoria,
            'valor' => $request->valor,
            'notas' => $request->notas,
        ]);

        return back()->with('success', 'Expediente registrado correctamente');
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
        $expediente = Expediente::find($id);
        $clientes = Cliente::all();
        $categorias = cCategoria::all();

        return view('sistema.editExpediente', compact('expediente', 'clientes', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $expediente = Expediente::find($id);

        $expediente->update([
            'id_cliente' => $request->id_cliente,
            'id_c_categoria' => $request->id_c_categoria,
            'valor' => $request->valor,
            'notas' => $request->notas,
        ]);

        $expediente->save();

        return redirect()->route('expedientes.index')->with('success', 'Expediente actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $expediente = Expediente::find($id);

        $expediente->delete();

        return back()->with('success', 'Movimiento eliminado correctamente');
    }
}
