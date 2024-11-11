<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    //
    public function cSubTipo()
    {
        return $this->belongsTo(cSubTipo::class, 'id');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id');
    }
}
