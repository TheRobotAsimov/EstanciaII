<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    //
    protected $fillable = [
        'id_empleado',
        'id_c_sub_tipo',
        'monto',
        'fecha',
        'notas',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado');
    }

    public function subtipo()
    {
        return $this->belongsTo(cSubTipo::class, 'id_c_sub_tipo');
    }

}
