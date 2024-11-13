<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cSubTipo extends Model
{
    //
    public function tipo()
    {
        return $this->belongsTo(cTipo::class, 'id_tipo');
    }

    public function movimientos()
    {
        return $this->hasMany(Movimiento::class, 'id_c_sub_tipo');
    }
}
