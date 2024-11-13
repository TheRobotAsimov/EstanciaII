<?php

namespace App\Http\Controllers;

use App\Models\cSubTipo;
use App\Models\cTipo;
use App\Models\Empleado;
use App\Models\Movimiento;
use Illuminate\Http\Request;

class MovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $movimientos = Movimiento::all();
        $tipos = cTipo::all();
        $subtipos = cSubTipo::all();
        $empleados = Empleado::all();

        return view('sistema.listMovimientos', compact('movimientos', 'tipos', 'subtipos', 'empleados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function getSubtipos($tipoId)
    {
        // Obtén los subtipos que corresponden al tipo seleccionado
        $subtipos = cSubtipo::where('id_tipo', $tipoId)->get(['id', 'nombre']);
        
        // Devuelve los subtipos como JSON
        return response()->json($subtipos);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $movimiento = Movimiento::create([
            'id_empleado' => $request->empleado,
            'id_c_sub_tipo' => $request->subtipo,
            'monto' => $request->monto,
            'notas' => $request->notas,
        ]);

        return back()->with('success', 'Movimiento registrado correctamente');
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
        $movimiento = Movimiento::find($id);
        $tipos = cTipo::all();
        $subtiposs = cSubTipo::all();
        $empleados = Empleado::all();

        return view('sistema.editMovimiento', compact('movimiento', 'tipos', 'subtiposs', 'empleados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $movimiento = Movimiento::find($id);

        $movimiento->update([
            'id_empleado' => $request->id_empleado,
            'id_c_sub_tipo' => $request->id_subtipo,
            'monto' => $request->monto,
            'notas' => $request->notas,
        ]);

        $movimiento->save();

        $movimientos = Movimiento::all();

        return redirect()->route('movimientos.index', compact('movimientos'))->with('success', 'Movimiento actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $movimiento = Movimiento::find($id);

        $movimiento->delete();

        return back()->with('success', 'Movimiento eliminado correctamente');
    }
}
