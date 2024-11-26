<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Jetstream\Jetstream;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $usuarios = User::where('id', '!=', auth()->id())->get();

        return view('sistema.listUsers', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('sistema.addUser');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validatedData = $request->validate([
            'nombre' => ['required', 'string', 'max:50'],
            'apellidos' => ['required', 'string', 'max:50'],
            'genero' => ['required', 'string', 'max:50'],
            'telefono' => ['required', 'numeric', 'digits:10'],
            'fecnac' => ['required', 'date', 'before:'.now()->subYears(18)->toDateString()],
            'puesto' => ['required', 'string', 'max:45'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],  // Cambia según tus reglas de password
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ]);

        // Crear el usuario
        $user = User::create([
            'nombre' => $validatedData['nombre'],
            'apellidos' => $validatedData['apellidos'],
            'genero' => $validatedData['genero'],
            'telefono' => $validatedData['telefono'],
            'fecnac' => $validatedData['fecnac'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Crear el empleado
        $user->empleado()->create([
            'puesto' => $validatedData['puesto'],
        ]);

        $user->givePermissionTo('empleado');

        // Redireccionar o responder
        return redirect()->route('users.index')->with('mensaje', 'Usuario actualizado correctamente');
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
        $usuario = User::find($id);

        return view('sistema.editUser', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $usuario = User::find($id);

        // Validar los datos de entrada
        $validatedData = $request->validate([
            'nombre' => ['required', 'string', 'max:50'],
            'apellidos' => ['required', 'string', 'max:50'],
            'genero' => ['required', 'string', 'max:50'],
            'telefono' => ['required', 'numeric', 'digits:10'],
            'fecnac' => ['required', 'date', 'before:'.now()->subYears(18)->toDateString()],
        ]);

        // Actualizar el usuario
        $usuario->nombre = $validatedData['nombre'];
        $usuario->apellidos = $validatedData['apellidos'];
        $usuario->genero = $validatedData['genero'];
        $usuario->telefono = $validatedData['telefono'];
        $usuario->fecnac = $validatedData['fecnac'];

        $usuario->save();

        // Redireccionar o responder
        return redirect()->route('users.index')->with('mensaje', 'Usuario actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $usuario = User::find($id);
        $usuario->delete();

        return back()->with('mensaje', 'Usuario eliminado correctamente');
    }
}
