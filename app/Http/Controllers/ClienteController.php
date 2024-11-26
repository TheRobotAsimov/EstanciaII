<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Models\Cliente;
use App\Models\Envio;
use Barryvdh\DomPDF\Facade\Pdf;

class ClienteController extends Controller
{
    //
    public function verificar(){

        $cliente = Cliente::where('id', '=', auth()->id())->get();

        return view('sistema.verifyCliente', compact('cliente'));
        //return "Verificar";
    }

    public function fraude()
{

    // Obtener los datos de los clientes, envíos e incidencias
    $clientes = Cliente::with(['usuario', 'envios.incidencias'])
        ->get()
        ->map(function ($cliente) {

            $enviosCount = $cliente->envios->count();
            $incidenciasCount = $cliente->envios->flatMap(function ($envio) {
                // Verifica si las incidencias están cargadas correctamente
                return $envio->incidencias;
            })->count();

            $cliente->envios_count = $enviosCount;
            $cliente->incidencias_count = $incidenciasCount;
            $cliente->ratio = $incidenciasCount / ($enviosCount ?: 1) * 100;
            return $cliente;
        })
        ->sortByDesc('ratio')
        ->take(10);

        // Obtener los tipos de incidencias y su cantidad para cada cliente
        $tiposIncidencias = $clientes->mapWithKeys(function ($cliente) {
            return [
                $cliente->id => $cliente->envios->flatMap(function ($envio) {
                    return $envio->incidencias->map(function ($incidencia) {
                        return $incidencia->tipo;
                    });
                })->countBy()
            ];
        });

        $pdf = Pdf::loadView('sistema.fraude', compact('clientes', 'tiposIncidencias'));

        return $pdf->stream('fraude.pdf');

        //return view('sistema.fraude', compact('clientes', 'tiposIncidencias'));
    }

    public function comprobar(Request $request)
    {
        $cliente = Cliente::where('id', '=', auth()->id())->get();

        // Validar que el RFC es una cadena
        $request->validate([
            'rfc' => 'required|string|max:13',
        ]);

        // Obtener el RFC desde el formulario
        $rfc = $request->input('rfc');

        // Realizar la solicitud a la API externa
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'content-type' => 'application/json',
            'x-api-key' => '1K22Y0C0H2ZPAB-2GCWH1400000W2-Y865-1FHY8XF8G',
        ])->post('https://link.kiban.com/api/v2/sat/pf_data_from_rfc?testCase=success', [
            'rfc' => $rfc,
        ]);

        // Verificar si la respuesta fue exitosa
        if ($response->successful()) {
            $data = $response->json();

            // Verificar si el estado es "SUCCESS"
            if ($data['status'] === 'SUCCESS') {
                // Verificar si los apellidos del cliente aparecen en el nombre completo de la respuesta
                $nombreCompleto = $data['response']['nombreCompleto'];
                $cliente = Cliente::where('id', '=', auth()->id())->first(); // Asegúrate de obtener el primer resultado
                $apellidosC = strtoupper($this->removeAccents($cliente->usuario->apellidos));

                if (strpos($nombreCompleto, $apellidosC) !== false) {
                // Actualizar el estado del cliente
                    $cliente->update(['estado' => 'Validado']);
                    $apellidosC = $apellidosC . ' (coinciden)';
                    return view('sistema.resultCliente', compact('data', 'rfc', 'cliente', 'nombreCompleto', 'apellidosC'))->with('success', 'El RFC es válido y los apellidos coinciden.');
                }
                // Aquí puedes procesar la respuesta, por ejemplo, mostrar los datos del cliente
                return view('sistema.resultCliente', compact('data', 'rfc', 'cliente', 'nombreCompleto', 'apellidosC'))->with('warning', 'El RFC es válido pero los apellidos no coinciden.');
            } else {
                // Si el estado no es SUCCESS, puedes manejar el error aquí
                return back()->withErrors(['rfc' => 'El RFC no es válido o no se encontró información.']);
            }
        } else {
            // Manejar el error si la solicitud a la API falla
            return back()->withErrors(['rfc' => 'RFC incorrecta o no encontrada.']);
        }
    }

    private function removeAccents($string)
    {
        return strtr(utf8_decode($string), utf8_decode('áéíóúÁÉÍÓÚñÑ'), 'aeiouAEIOUnN');
    }
}
