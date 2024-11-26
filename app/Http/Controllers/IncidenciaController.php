<?php

namespace App\Http\Controllers;

use App\Models\Envio;
use App\Models\Incidencia;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

use function Pest\Laravel\delete;

class IncidenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Incidencia::query();

        // Filtrar por rango de fechas
        if ($request->has(['start', 'end'])) {
            $start = $request->get('start');
            $end = $request->get('end');
            $query->whereBetween('fechaIncidencia', [$start, $end]);
        }

        $incidencias = $query->get();
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

    public function reporte(Request $request)
    {
        // Filtrar los datos según el rango de fechas (si existen)
        $query = Incidencia::query();

        if ($request->has('start') && $request->has('end')) {
            $query->whereBetween('fechaIncidencia', [$request->start, $request->end]);
        }

        $incidencias = $query->get();

        \Carbon\Carbon::setLocale('es');

        // Generar los datos para la gráfica
        $data = $incidencias->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->fechaIncidencia)->translatedFormat('F'); // Mes traducido
        })->map(function ($group) {
            return $group->sum('monto');
        });

        $chartData = [
            'labels' => $data->keys()->toArray(),
            'values' => $data->values()->toArray(),
        ];

        $values = collect($chartData['values']);
        $labels = collect($chartData['labels']);

        // Verificar que ambos arrays tengan el mismo tamaño
        if ($values->count() !== $labels->count()) {
            throw new \Exception('El número de valores y etiquetas no coincide.');
        }

        // Calcular el total de los valores
        $total = $values->sum();

        // Encontrar el índice del valor máximo
        $maxPercentageKey = $values->search($values->max());

        // Verificar que el índice exista en las etiquetas
        if ($maxPercentageKey === false || !isset($labels[$maxPercentageKey])) {
            throw new \Exception('No se pudo encontrar la etiqueta correspondiente al valor máximo.');
        }

        // Obtener la etiqueta correspondiente al valor máximo
        $maxLabel = $labels[$maxPercentageKey];

        // Agrega los conteos por tipo de incidencia
        $countsByType = $incidencias->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->fechaIncidencia)->translatedFormat('F');
        })->map(function ($group) {
            return [
                'retraso' => $group->where('tipo', 'Retraso')->count(),
                'perdida' => $group->where('tipo', 'Perdida')->count(),
                'danio' => $group->where('tipo', 'Dañada')->count(),
            ];
        });


        // Renderizar la vista con la gráfica
        $pdf = Pdf::loadView('sistema.reporteIncidencia', compact('chartData', 'incidencias', 'maxLabel', 'countsByType'));

        return $pdf->stream('reporte_incidencias.pdf');

        //return view('sistema.reporteIncidencia', compact('chartData', 'incidencias', 'maxLabel', 'countsByType'));
    }
}
