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
        'notas',
    ];

    public function cSubTipo()
    {
        return $this->belongsTo(cSubTipo::class, 'id');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id');
    }
}
