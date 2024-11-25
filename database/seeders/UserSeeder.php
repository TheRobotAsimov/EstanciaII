<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Empleado;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::insert([
            [
                // id = 1
                'nombre' => 'Admin',
                'apellidos' => 'Admin',
                'genero' => 'Masculino',
                'telefono' => '1234567890',
                'fecnac' => '2000-01-01',
                'email' => 'admin@ejemplo.com',
                'password' => Hash::make('admin'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // id = 2
                'nombre' => 'Juan',
                'apellidos' => 'Pérez',
                'genero' => 'Masculino',
                'telefono' => '1234567891',
                'fecnac' => '1990-02-02',
                'email' => 'juan.perez@ejemplo.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // id = 3
                'nombre' => 'María',
                'apellidos' => 'González',
                'genero' => 'Femenino',
                'telefono' => '1234567892',
                'fecnac' => '1991-03-03',
                'email' => 'maria.gonzalez@ejemplo.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // id = 4
                'nombre' => 'Carlos',
                'apellidos' => 'Rodríguez',
                'genero' => 'Masculino',
                'telefono' => '1234567893',
                'fecnac' => '1992-04-04',
                'email' => 'carlos.rodriguez@ejemplo.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // id = 5
                'nombre' => 'Ana',
                'apellidos' => 'Martínez',
                'genero' => 'Femenino',
                'telefono' => '1234567894',
                'fecnac' => '1993-05-05',
                'email' => 'ana.martinez@ejemplo.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // id = 6
                'nombre' => 'Luis',
                'apellidos' => 'Hernández',
                'genero' => 'Masculino',
                'telefono' => '1234567895',
                'fecnac' => '1994-06-06',
                'email' => 'luis.hernandez@ejemplo.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // id = 7
                'nombre' => 'Laura',
                'apellidos' => 'López',
                'genero' => 'Femenino',
                'telefono' => '1234567896',
                'fecnac' => '1995-07-07',
                'email' => 'laura.lopez@ejemplo.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // id = 8
                'nombre' => 'Jorge',
                'apellidos' => 'García',
                'genero' => 'Masculino',
                'telefono' => '1234567897',
                'fecnac' => '1996-08-08',
                'email' => 'jorge.garcia@ejemplo.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // id = 9
                'nombre' => 'Elena',
                'apellidos' => 'Sánchez',
                'genero' => 'Femenino',
                'telefono' => '1234567898',
                'fecnac' => '1997-09-09',
                'email' => 'elena.sanchez@ejemplo.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // id = 10
                'nombre' => 'Pedro',
                'apellidos' => 'Ramírez',
                'genero' => 'Masculino',
                'telefono' => '1234567899',
                'fecnac' => '1998-10-10',
                'email' => 'pedro.ramirez@ejemplo.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // id = 11
                'nombre' => 'Sofía',
                'apellidos' => 'Torres',
                'genero' => 'Femenino',
                'telefono' => '1234567800',
                'fecnac' => '1999-11-11',
                'email' => 'sofia.torres@ejemplo.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // id = 12
                'nombre' => 'Miguel',
                'apellidos' => 'Vargas',
                'genero' => 'Masculino',
                'telefono' => '1234567801',
                'fecnac' => '2000-12-12',
                'email' => 'miguel.vargas@ejemplo.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // id = 13
                'nombre' => 'Isabel',
                'apellidos' => 'Morales',
                'genero' => 'Femenino',
                'telefono' => '1234567802',
                'fecnac' => '2001-01-01',
                'email' => 'isabel.morales@ejemplo.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // id = 14
                'nombre' => 'Ricardo',
                'apellidos' => 'Ortiz',
                'genero' => 'Masculino',
                'telefono' => '1234567803',
                'fecnac' => '2002-02-02',
                'email' => 'ricardo.ortiz@ejemplo.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // id = 15
                'nombre' => 'Patricia',
                'apellidos' => 'Ramos',
                'genero' => 'Femenino',
                'telefono' => '1234567804',
                'fecnac' => '2003-03-03',
                'email' => 'patricia.ramos@ejemplo.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // id = 16
                'nombre' => 'Fernando',
                'apellidos' => 'Reyes',
                'genero' => 'Masculino',
                'telefono' => '1234567805',
                'fecnac' => '2004-04-04',
                'email' => 'fernando.reyes@ejemplo.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // id = 17
                'nombre' => 'Gabriela',
                'apellidos' => 'Ruiz',
                'genero' => 'Femenino',
                'telefono' => '1234567806',
                'fecnac' => '2005-05-05',
                'email' => 'gabriela.ruiz@ejemplo.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // id = 18
                'nombre' => 'Hugo',
                'apellidos' => 'Soto',
                'genero' => 'Masculino',
                'telefono' => '1234567807',
                'fecnac' => '2006-06-06',
                'email' => 'hugo.soto@ejemplo.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // id = 19
                'nombre' => 'Mónica',
                'apellidos' => 'Vega',
                'genero' => 'Femenino',
                'telefono' => '1234567808',
                'fecnac' => '2007-07-07',
                'email' => 'monica.vega@ejemplo.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // id = 20
                'nombre' => 'Oscar',
                'apellidos' => 'Zamora',
                'genero' => 'Masculino',
                'telefono' => '1234567809',
                'fecnac' => '2008-08-08',
                'email' => 'oscar.zamora@ejemplo.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // id = 21
                'nombre' => 'Paula',
                'apellidos' => 'Álvarez',
                'genero' => 'Femenino',
                'telefono' => '1234567810',
                'fecnac' => '2009-09-09',
                'email' => 'paula.alvarez@ejemplo.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        Empleado::insert([
            [
                'id' => 2,
                'puesto' => 'Desarrollador',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'puesto' => 'Desarrollador',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'puesto' => 'Analista',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'puesto' => 'Analista',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'puesto' => 'Gerente',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'puesto' => 'Gerente',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'puesto' => 'Soporte',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'puesto' => 'Soporte',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 10,
                'puesto' => 'Marketing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 11,
                'puesto' => 'Marketing',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        Cliente::insert([
            [
                'id' => 12,
                'saldo' => 1000,
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 13,
                'saldo' => 500,
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 14,
                'saldo' => 750,
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 15,
                'saldo' => 10,
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 16,
                'saldo' => 0,
                'estado' => 'Inactivo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 17,
                'saldo' => 180,
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 18,
                'saldo' => 980,
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 19,
                'saldo' => 450,
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 20,
                'saldo' => 200,
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 21,
                'saldo' => 690,
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
