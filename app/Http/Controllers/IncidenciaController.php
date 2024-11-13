<?php

namespace App\Http\Controllers;

use App\Models\Envio;
use App\Models\Incidencia;
use Illuminate\Http\Request;

use function Pest\Laravel\delete;

class IncidenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $incidencias = Incidencia::all();
        $envios = Envio::all();

        return view('sistema.listIncidencia', compact('incidencias', 'envios'));
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
        $incidencia = Incidencia::create([
            'guia' => $request->guia,
            'tipo' => $request->tipo,
            'monto' => $request->monto,
            'estado' => $request->estado,
            'fechaIncidencia' => $request->fechaIncidencia,
            'fechaPago' => $request->fechaPago,
            'notas' => $request->notas,
        ]);

        return back()->with('success', 'Incidencia registrada correctamente');
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
        $incidencia = Incidencia::find($id);
        $envios = Envio::all();

        return view('sistema.editIncidencia', compact('incidencia', 'envios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $incidencia = Incidencia::find($id);

        $incidencia->update([
            'guia' => $request->guia,
            'tipo' => $request->tipo,
            'monto' => $request->monto,
            'estado' => $request->estado,
            'fechaIncidencia' => $request->fechaIncidencia,
            'fechaPago' => $request->fechaPago,
            'notas' => $request->notas,
        ]);

        return redirect()->route('incidencias.index')->with('success', 'Incidencia actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $incidencia = Incidencia::find($id);

        $incidencia->delete();

        return back()->with('success', 'Movimiento eliminado correctamente');

    }
}
