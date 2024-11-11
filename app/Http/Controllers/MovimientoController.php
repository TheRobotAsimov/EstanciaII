<?php

namespace App\Http\Controllers;

use App\Models\cSubTipo;
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
        $subtipos = cSubTipo::all();
        $empleados = Empleado::all();

        return view('sistema.listMovimientos', compact('movimientos', 'subtipos', 'empleados'));
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
