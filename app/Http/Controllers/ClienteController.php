<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ClienteController extends Controller
{
    //
    public function verificar(){

        return view('sistema.verifyCliente');
        //return "Verificar";
    }

    public function fraude(){
        return "Fraude";
    }

    public function comprobar(Request $request)
    {
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
                // Aquí puedes procesar la respuesta, por ejemplo, mostrar los datos del cliente
                return view('sistema.resultCliente', compact('data', 'rfc'));
            } else {
                // Si el estado no es SUCCESS, puedes manejar el error aquí
                return back()->withErrors(['rfc' => 'El RFC no es válido o no se encontró información.']);
            }
        } else {
            // Manejar el error si la solicitud a la API falla
            return back()->withErrors(['rfc' => 'Error al conectar con la API de validación.']);
        }
    }
}
