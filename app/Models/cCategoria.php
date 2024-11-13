<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cCategoria extends Model
{
    //
    public function expedientes()
    {
        return $this->hasMany(Expediente::class, 'id_c_categoria');
    }
}
