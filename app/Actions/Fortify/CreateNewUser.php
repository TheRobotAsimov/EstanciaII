<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'nombre' => ['required', 'string', 'max:50'],
            'apellidos' => ['required', 'string', 'max:50'],
            'genero' => ['required', 'string', 'max:50'],
            'telefono' => ['required', 'numeric', 'digits:10'],
            'fecnac' => ['required', 'date', 'before:'.now()->subYears(18)->toDateString()],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $user = User::create([
            'nombre' => $input['nombre'],
            'apellidos' => $input['apellidos'],
            'genero' => $input['genero'],
            'telefono' => $input['telefono'],
            'fecnac' => $input['fecnac'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        // Crear cliente
        $user->cliente()->create([
            'saldo' => 0,
            'estado' => 'Activo',
        ]);

        $user->givePermissionTo('cliente');

        return $user;
    }
}
