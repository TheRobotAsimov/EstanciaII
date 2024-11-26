<?php

namespace App\Http\Controllers;

use App\Models\cSubTipo;
use App\Models\cTipo;
use App\Models\Empleado;
use App\Models\Movimiento;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class MovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = Movimiento::query();

        // Filtrar por rango de fechas
        if ($request->has(['start', 'end'])) {
            $start = $request->get('start');
            $end = $request->get('end');
            $query->whereBetween('fecha', [$start, $end]);
        }

        $movimientos = $query->get();

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
            'fecha' => $request->fecha,
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
            'fecha' => $request->fecha,
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

    public function reporte(Request $request)
    {
        // Filtrar movimientos por tipo
        $ingresos = Movimiento::whereHas('subtipo.tipo', function ($query) {
            $query->where('nombre', 'Ingreso');
        })->get();

        $egresos = Movimiento::whereHas('subtipo.tipo', function ($query) {
            $query->where('nombre', 'Egreso');
        })->get();

        // Obtener todos los subtipos únicos para las columnas dinámicas
        $subtiposIngresos = cSubTipo::whereHas('tipo', function ($query) {
            $query->where('nombre', 'Ingreso');
        })->pluck('nombre', 'id');

        $subtiposEgresos = cSubTipo::whereHas('tipo', function ($query) {
            $query->where('nombre', 'Egreso');
        })->pluck('nombre', 'id');

        // Agrupar datos por mes
        $ingresosData = $ingresos->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->fecha)->translatedFormat('F');
        })->map(function ($group) use ($subtiposIngresos) {
            return [
                'monto_total' => $group->sum('monto'),
                'cantidad' => $group->count(),
                'subtipos' => $group->groupBy('id_c_sub_tipo')->mapWithKeys(function ($items, $id) use ($subtiposIngresos) {
                    return [$subtiposIngresos[$id] ?? 'Otro' => $items->count()];
                }),
            ];
        });

        $egresosData = $egresos->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->fecha)->translatedFormat('F');
        })->map(function ($group) use ($subtiposEgresos) {
            return [
                'monto_total' => $group->sum('monto'),
                'cantidad' => $group->count(),
                'subtipos' => $group->groupBy('id_c_sub_tipo')->mapWithKeys(function ($items, $id) use ($subtiposEgresos) {
                    return [$subtiposEgresos[$id] ?? 'Otro' => $items->count()];
                }),
            ];
        });

        // Calcular totales generales
        $totalesIngresos = [
            'monto_total' => $ingresosData->sum('monto_total'),
            'subtipos' => $subtiposIngresos->mapWithKeys(function ($nombre, $id) use ($ingresos) {
                return [$nombre => $ingresos->where('id_c_sub_tipo', $id)->count()];
            }),
        ];

        $totalesEgresos = [
            'monto_total' => $egresosData->sum('monto_total'),
            'subtipos' => $subtiposEgresos->mapWithKeys(function ($nombre, $id) use ($egresos) {
                return [$nombre => $egresos->where('id_c_sub_tipo', $id)->count()];
            }),
        ];

        $pdf = PDF::loadView('sistema.reporteMovimientos', compact('ingresosData', 'egresosData', 'subtiposIngresos', 'subtiposEgresos', 'totalesIngresos', 'totalesEgresos'));

        return $pdf->stream('reporte_movimientos.pdf');

        //return view('sistema.reporteMovimientos', compact('ingresosData', 'egresosData', 'subtiposIngresos', 'subtiposEgresos', 'totalesIngresos', 'totalesEgresos'));
    }
}
