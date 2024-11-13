<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    //
    protected $fillable = [
        'guia',
        'tipo',
        'monto',
        'estado',
        'fechaIncidencia',
        'fechaPago',
        'notas',
    ];
}